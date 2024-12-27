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
        $orders = Orders::with('customer')->with('order_items.product')
            ->where('orders.status', 'diantar')
            ->get();

        return view('pos.pesanan_diantar', [
            'orders' => $orders
        ]);
    }

    public function confirmPesananDiantar(Request $request, Orders $orders)
    {
        if ($orders->status_pembayaran === 'lunas') {
            $orders->update(['status' => 'transaksi_selesai']);
            return redirect()->route('order.indexPesananDiantar')
                ->with('success', 'Pesanan berhasil diselesaikan.');
        }
    
        if ($request->filled('jumlah_pembayaran')) {
            $orders->increment('jumlah_dibayar', $request->jumlah_pembayaran);
    
            if ($orders->jumlah_dibayar >= $orders->total_harga) {
                $orders->update(['status_pembayaran' => 'lunas']);
            }
        } else {
            return redirect()->back();
        }

        $orders->update(['status' => 'transaksi_selesai']);

        return redirect()->route('order.indexPesananDiantar')->with('success', 'Pesanan berhasil diupdate.');
    }
}
