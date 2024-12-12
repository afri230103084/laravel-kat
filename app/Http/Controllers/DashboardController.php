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

        $orders = Orders::with('customers')->with('order_items.product')
                ->where('orders.status', 'baru')
                ->get();

        return view('dashboard', [
            'totalOrderSelesai' => $totalOrderSelesai,
            'totalHargaSelesai' => $totalHargaSelesai,
            'totalPengeluaran' => $totalPengeluaran,
            'orders' => $orders,
        ]);
    }

    public function indexPesananMasukA($id)
    {
        $data = Orders::FindOrFail($id);
        $data->status = 'menunggu';
        $data->save();

        return redirect()->route('dashboard');
    }
}
