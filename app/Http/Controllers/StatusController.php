<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function indexPesananMasuk()
    {
        $orders = Orders::with('customers')->with('order_items')
                ->where('orders.status', 'baru')
                ->get();

                // dd($orders);
        return view('pos.pesanan_masuk', [
            'orders' => $orders
        ]);
    }

    public function indexPesananMasukA($id)
    {
        $data = Orders::FindOrFail($id);
        $data->status = 'menunggu';
        $data->save();

        return redirect()->route('index-indexPesananMasuk');
    }
    
    public function indexMenungguJadwal()
    {
        $orders = Orders::join('customers', 'orders.customer_id','customers.id')
                ->where('orders.status', 'menunggu')
                ->get();

        return view('pos.menunggu_jadwal', compact('orders'));
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
        $orders = Orders::join('customers', 'orders.customer_id','customers.id')
                ->where('orders.status', 'dibuat')
                ->get();

        return view('pos.pesanan_dibuat', compact('orders'));
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
        $orders = Orders::join('customers', 'orders.customer_id','customers.id')
                ->where('orders.status', 'selesai')
                ->get();

        return view('pos.pesanan_selesai', compact('orders'));
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
        $orders = Orders::join('customers', 'orders.customer_id','customers.id')
                ->where('orders.status', 'diantar')
                ->get();

        return view('pos.pesanan_diantar', compact('orders'));
    }

    public function indexPesananDiantarA($id)
    {
        $data = Orders::FindOrFail($id);
        $data->status = 'transaksi_selesai';
        $data->save();

        return redirect()->route('index-indexPesananDiantar');
    }
}
