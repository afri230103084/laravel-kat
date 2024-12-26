<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Orders;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrderSelesai = Orders::where('status', 'transaksi_selesai')->count();
        $totalHargaSelesai = Orders::where('status', 'transaksi_selesai')->sum('total_harga');
        $totalPengeluaran = Expense::sum('jumlah');

        $orders = Orders::with('customer')->with('order_items.product')
                ->where('orders.status', 'baru')
                ->get();

        return view('dashboard', [
            'totalOrderSelesai' => $totalOrderSelesai,
            'totalHargaSelesai' => $totalHargaSelesai,
            'totalPengeluaran' => $totalPengeluaran,
            'orders' => $orders,
        ]);
    }

    public function confirmIncomingOrder(Request $request, Orders $order)
    {
        $request->validate([
            'jumlah_dibayar' => 'required|numeric|min:0',
        ]);

        $jumlah_dibayar = $request->input('jumlah_dibayar');
        $order->jumlah_dibayar += $jumlah_dibayar;

        if ($order->jumlah_dibayar >= $order->total_harga) {
            $order->status_pembayaran = 'lunas';
        } else {
            $order->status_pembayaran = 'dp';
        }

        $order->status = 'menunggu';
        $order->save();

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dikonfirmasi.');
    }
}
