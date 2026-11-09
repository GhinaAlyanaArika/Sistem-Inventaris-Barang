<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $appName = Setting::get('app_name', 'SMART INVENTORY SYSTEM');
        $address = Setting::get('address', 'Jl. Merdeka No. 123');
        $phone = Setting::get('phone', '08123456789');
        $operatingHours = Setting::get('operating_hours', '08:00 - 22:00 WIB');
        
        $taxPercentage = Setting::get('tax_percentage', '0');
        $receiptFooter = Setting::get('receipt_footer', 'Terima kasih telah berbelanja di toko kami.');
        $currency = Setting::get('currency', 'Rp');

        return view('settings.index', compact(
            'appName', 'address', 'phone', 'operatingHours', 
            'taxPercentage', 'receiptFooter', 'currency'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'operating_hours' => 'nullable|string',
            'tax_percentage' => 'nullable|numeric|min:0|max:100',
            'receipt_footer' => 'nullable|string',
            'currency' => 'nullable|string|max:10',
        ]);

        $settings = $request->only([
            'app_name', 'address', 'phone', 'operating_hours',
            'tax_percentage', 'receipt_footer', 'currency'
        ]);

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Pengaturan aplikasi berhasil diperbarui!');
    }
}