<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index()
    {
        $orders = Orders::with('customer')
            ->where('status', 'transaksi_selesai')
            ->get();

        return view('sales_report.index', compact('orders'));
    }
}
