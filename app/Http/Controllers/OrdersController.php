<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    public function create()
    {
        $product = Products::where('status', 'aktif')->get();
        $customer = Customers::all();

        return view('pos.create', compact('product', 'customer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'jenis_pengambilan' => 'required|in:diantar,diambil',
            'metode_pembayaran' => 'required|in:cash,transfer',
            'alamat' => 'required|string',
            'tanggal_acara' => 'required|date',
            'waktu_acara' => 'required|date_format:H:i',
            'jumlah_dibayar' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        $kodeTransaksi = 'PS' . strtoupper(Str::random(8));
    
        $totalHarga = 0;
        foreach ($request->items as $item) {
            $product = Products::find($item['product_id']);
            $totalHarga += $product->harga * $item['jumlah'];
        }
    
        $statusPembayaran = $request->jumlah_dibayar >= $totalHarga ? 'lunas' : 'dp';
        $buktiPembayaranPath = null;
    
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }
    
        $order = Orders::create([
            'customer_id' => $request->customer_id,
            'kode_transaksi' => $kodeTransaksi,
            'status' => 'menunggu',
            'jenis_pengambilan' => $request->jenis_pengambilan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $statusPembayaran,
            'total_harga' => $totalHarga,
            'alamat' => $request->alamat,
            'tanggal_acara' => $request->tanggal_acara,
            'waktu_acara' => $request->waktu_acara,
            'catatan' => $request->catatan,
            'jumlah_dibayar' => $request->jumlah_dibayar,
            'bukti_pembayaran' => $buktiPembayaranPath,
        ]);
    
        foreach ($request->items as $item) {
            $product = Products::findOrFail($item['product_id']);

            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $product->harga,
                'subtotal' => $product->harga * $item['jumlah'],
            ]);
        }
    
        return redirect()->route('dashboard');
    }
}
