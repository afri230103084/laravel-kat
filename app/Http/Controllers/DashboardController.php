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

        return view('dashboard', compact('totalOrderSelesai', 'totalHargaSelesai', 'totalPengeluaran'));
    }
}
