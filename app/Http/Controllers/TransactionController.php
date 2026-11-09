<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Item;
use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Menampilkan halaman kasir + barang terpaginasi & isi keranjang dari Session.
     */
    public function index()
    {
        $items = Item::where('stock', '>', 0)->paginate(4);
        $cart = session()->get('cart', []);

        $subtotal = 0;
        foreach ($cart as $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }
        
        // AMBIL NILAI PAJAK DARI DATABASE
        $taxPercentage = Setting::get('tax_percentage', 0);
        $taxAmount = ($subtotal * $taxPercentage) / 100;
        $totalTagihan = $subtotal + $taxAmount;

        $currency = Setting::get('currency', 'Rp');

        return view('transactions.index', compact('items', 'cart', 'subtotal', 'taxPercentage', 'taxAmount', 'totalTagihan', 'currency'));
    }

    /**
     * Menambahkan item ke keranjang (Session).
     */
    public function addToCart(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] + 1 > $item->stock) {
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Stok tidak mencukupi!']);
                }
                return redirect()->back()->with('error', 'Stok barang tidak mencukupi!');
            }
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $item->name,
                "quantity" => 1,
                "price" => $item->price,
                "stock" => $item->stock
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    /**
     * Menghapus item dari keranjang (Session).
     */
    public function removeFromCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    /**
     * Memproses transaksi / pembayaran.
     */
    public function store(Request $request)
    {
        // 1. Ambil Keranjang dari request Frontend JSON (Alpine.js)
        $payloadCart = $request->input('cart');
        $cart = [];
        
        // 2. Normalisasi format keranjang agar sesuai standar
        if (!empty($payloadCart) && is_array($payloadCart)) {
            foreach ($payloadCart as $item) {
                $cart[$item['id']] = [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ];
            }
        } else {
            $cart = session()->get('cart', []);
        }

        if (empty($cart)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['message' => 'Keranjang belanja masih kosong!'], 400);
            }
            return redirect()->back()->with('error', 'Keranjang belanja masih kosong!');
        }

        $payAmount = $request->input('pay_amount') ?? $request->input('paid_amount');

        $subtotal = 0;
        foreach ($cart as $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }

        // HITUNG TOTAL AKHIR BESERTA PAJAK
        $taxPercentage = Setting::get('tax_percentage', 0);
        $taxAmount = ($subtotal * $taxPercentage) / 100;
        $totalAmount = $subtotal + $taxAmount;

        if (!$payAmount || $payAmount < $totalAmount) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['message' => 'Uang pembayaran kurang dari total tagihan!'], 422);
            }
            return redirect()->back()->with('error', 'Uang pembayaran kurang dari total tagihan!');
        }

        DB::beginTransaction();
        try {
            // Validasi stok sebelum diproses
            foreach ($cart as $itemId => $details) {
                $item = Item::lockForUpdate()->find($itemId);
                if (!$item || $item->stock < $details['quantity']) {
                    DB::rollBack();
                    $msg = "Stok barang " . ($item->name ?? 'dimaksud') . " tidak mencukupi!";
                    if ($request->wantsJson() || $request->ajax()) {
                        return response()->json(['message' => $msg], 422);
                    }
                    return redirect()->back()->with('error', $msg);
                }
            }

            $invoiceNumber = 'INV-' . time() . rand(100, 999);
            $changeAmount = $payAmount - $totalAmount;

            $transactionData = [
                'user_id'        => Auth::id() ?? 1,
                'invoice_number' => $invoiceNumber,
                'total_amount'   => $totalAmount,
                'change_amount'  => $changeAmount,
                'pay_amount'     => $payAmount,
                'paid_amount'    => $payAmount,
            ];

            $transaction = Transaction::create($transactionData);

            // Kurangi stok barang
            foreach ($cart as $itemId => $details) {
                $item = Item::findOrFail($itemId);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id'        => $item->id,
                    'quantity'       => $details['quantity'],
                    'price'          => $item->price,
                    'subtotal'       => $item->price * $details['quantity'],
                ]);

                $item->decrement('stock', $details['quantity']);
            }

            // Catat log aktivitas
            if (class_exists('App\Models\ActivityLog') && method_exists('App\Models\ActivityLog', 'log')) {
                ActivityLog::log(
                    'Buat',
                    'Faktur Penjualan',
                    "Memproses transaksi {$transaction->invoice_number} senilai " . Setting::get('currency', 'Rp') . " " . number_format($transaction->total_amount, 0, ',', '.'),
                    $transaction->invoice_number
                );
            }

            DB::commit();
            session()->forget('cart'); // Bersihkan session

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success'        => true,
                    'message'        => "Transaksi {$transaction->invoice_number} berhasil diproses!",
                    'transaction_id' => $transaction->id,
                    'invoice'        => $transaction->invoice_number,
                    'invoice_number' => $transaction->invoice_number,
                    'change'         => $changeAmount,
                    'change_amount'  => $changeAmount
                ]);
            }

            return redirect()->route('transactions.index')->with('success', "Transaksi {$transaction->invoice_number} berhasil diproses!");

        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['message' => 'Gagal memproses transaksi: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail faktur transaksi tertentu.
     */
    public function show($id)
    {
        $transaction = Transaction::with(['user', 'details.item'])->findOrFail($id);
        
        $appName = Setting::get('app_name', 'Smart Inventory');
        $address = Setting::get('address', '');
        $phone = Setting::get('phone', '');
        $receiptFooter = Setting::get('receipt_footer', 'Terima kasih atas kunjungan Anda!');
        $currency = Setting::get('currency', 'Rp');

        return view('transactions.show', compact('transaction', 'appName', 'address', 'phone', 'receiptFooter', 'currency'));
    }
}