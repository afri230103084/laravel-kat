<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class StatusController extends Controller
{   
    public function indexMenungguJadwal()
    {
        $orders = Orders::with('customers')->with('order_items.product')
                ->where('orders.status', 'menunggu')
                ->get();

        return view('pos.menunggu_jadwal', [
            'orders' => $orders
        ]);
    }

    public function indexMenungguJadwalA($id)
    {
        $data = Orders::FindOrFail($id);
        $data->status = 'dibuat';
        $data->save();

        return redirect()->route('index-indexMenungguJadwal');
    }

    public function indexMenungguJadwalB($id)
    {
        $data = Orders::FindOrFail($id);
        $data->status = 'batal';
        $data->save();

        return redirect()->route('index-indexMenungguJadwal');
    }

    public function indexPesananDibuat()
    {
        $orders = Orders::with('customers')->with('order_items.product')
                ->where('orders.status', 'dibuat')
                ->get();

        return view('pos.pesanan_dibuat', [
            'orders' => $orders
        ]);
    }

    public function indexPesananDibuatA($id)
    {
        $data = Orders::FindOrFail($id);
        $data->status = 'selesai';
        $data->save();

        return redirect()->route('index-indexPesananDibuat');
    }

    public function indexPesananSelesai()
    {
        $orders = Orders::with('customers')->with('order_items.product')
                ->where('orders.status', 'selesai')
                ->get();

        return view('pos.pesanan_selesai', [
            'orders' => $orders
        ]);
    }

    public function indexPesananSelesaiA($id)
    {
        $data = Orders::FindOrFail($id);
        $data->status = 'diantar';
        $data->save();

        return redirect()->route('index-indexPesananSelesai');
    }

    public function indexPesananSelesaiB($id)
    {
        $data = Orders::FindOrFail($id);
        $data->status = 'transaksi_selesai';
        $data->save();

        return redirect()->route('index-indexPesananSelesai');
    }

    public function indexPesananDiantar()
    {
        $orders = Orders::with('customers')->with('order_items.product')
                ->where('orders.status', 'diantar')
                ->get();

        return view('pos.pesanan_diantar', [
            'orders' => $orders
        ]);
    }

    public function indexPesananDiantarA($id)
    {
        $data = Orders::FindOrFail($id);
        $data->status = 'transaksi_selesai';
        $data->save();

        return redirect()->route('index-indexPesananDiantar');
    }
}
