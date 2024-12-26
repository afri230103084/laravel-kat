<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function indexMenungguJadwal()
    {
        $orders = Orders::with('customer')->with('order_items.product')
            ->where('orders.status', 'menunggu')
            ->get();

        return view('pos.menunggu_jadwal', [
            'orders' => $orders
        ]);
    }

    public function prosesPesanan(Orders $orders)
    {
        $orders->status = 'dibuat';
        $orders->save();

        return redirect()->route('order.indexMenungguJadwal')->with('success', 'Pesanan telah diproses');
    }

    public function batalkanPesanan(Orders $orders)
    {
        $orders->status = 'batal';
        $orders->save();

        return redirect()->route('order.indexMenungguJadwal')->with('success', 'Pesanan telah dibatalkan');
    }

    public function indexPesananDibuat()
    {
        $orders = Orders::with('customer')->with('order_items.product')
            ->where('orders.status', 'dibuat')
            ->get();

        return view('pos.pesanan_dibuat', [
            'orders' => $orders
        ]);
    }

    public function selesaikanPesanan(Orders $orders)
    {
        $orders->status = 'selesai';
        $orders->save();

        return redirect()->route('order.indexPesananDibuat')->with('success', 'Pesanan telah selesai');
    }

    public function indexPesananSelesai()
    {
        $orders = Orders::with('customer')->with('order_items.product')
            ->where('orders.status', 'selesai')
            ->get();

        return view('pos.pesanan_selesai', [
            'orders' => $orders
        ]);
    }

    public function jadwalkanPengiriman(Orders $orders)
    {
        $orders->status = 'diantar';
        $orders->save();

        return redirect()->route('order.indexPesananSelesai')->with('success', 'Pesanan dijadwalkan untuk pengiriman');
    }

    public function finalizeTransaksi(Request $request, Orders $orders)
    {
        if ($orders->status_pembayaran === 'lunas') {
            $orders->status = 'transaksi_selesai';
            $orders->save();
            return redirect()->route('order.indexPesananSelesai')->with('success', 'Transaksi selesai');
        }

        if ($request->has('jumlah_pembayaran')) {
            $jumlah_pembayaran = $request->input('jumlah_pembayaran');
            $orders->jumlah_dibayar += $jumlah_pembayaran;

            if ($orders->jumlah_dibayar >= $orders->total_harga) {
                $orders->status_pembayaran = 'lunas';
            }
        } else {
            return redirect()->back();
        }

        $orders->status = 'transaksi_selesai';
        $orders->save();

        return redirect()->route('order.indexPesananSelesai')->with('success', 'Transaksi selesai');
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

    public function indexPesananDiantarA(Request $request, $id)
    {
        $data = Orders::findOrFail($id);

        if ($data->status_pembayaran === 'lunas') {
            $data->status = 'transaksi_selesai';
            $data->save();
            return redirect()->route('index-indexPesananSelesai');
        }

        if ($request->has('jumlah_pembayaran')) {
            $jumlah_pembayaran = $request->input('jumlah_pembayaran');
            $data->jumlah_dibayar += $jumlah_pembayaran;

            if ($data->jumlah_dibayar >= $data->total_harga) {
                $data->status_pembayaran = 'lunas';
            }
        } else {
            return redirect()->back();
        }

        $data->status = 'transaksi_selesai';
        $data->save();

        return redirect()->route('index-indexPesananDiantar');
    }
}
