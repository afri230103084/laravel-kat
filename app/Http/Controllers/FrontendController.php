<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function buat_pesanan()
    {
        $product = Products::where('status', 'aktif')->get();
        return view('frontend.buat_pesanan', compact('product'));
    }

    public function buat_pesananStore(Request $request)
    {
        $request->validate([
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        $order = Orders::create([
            'customer_id' => auth()->id(),
            'total_harga' => 0,
            'status' => 'draft',
            'kode_transaksi' => $this->generateKodeTransaksi(),
        ]);

        $totalHarga = 0;

        foreach ($request->items as $item) {
            $product = Products::findOrFail($item['product_id']);
            $jumlah = max($product->minimal_pesan, $item['jumlah']);
            $subtotal = $product->harga * $jumlah;

            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'jumlah' => $jumlah,
                'harga_satuan' => $product->harga,
                'subtotal' => $subtotal,
            ]);

            $totalHarga += $subtotal;
        }

        $order->update(['total_harga' => $totalHarga]);

        return redirect()->route('frontend-daftar_pesananUser');
    }

    private function generateKodeTransaksi()
    {
        $prefix = 'TRX';
        $date = date('Ymd');
        $random = strtoupper(Str::random(6));
        return $prefix . '-' . $date . '-' . $random;
    }

    public function keranjangBelanja()
    {
        $orders = Orders::where('status', 'draft')
            ->where('customer_id', auth('customer')->id())
            ->get();

        return view('frontend.keranjang_belanja', compact('orders'));
    }

    public function HapusKeranjangBelanja($id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();

        return redirect()->route('frontend-keranjangBelanja');
    }

    public function konfirmasiKeranjang($id)
    {
        $order = Orders::findOrFail($id);
        return view('frontend.konfirmasi_pesanan', compact('order'));
    }

    public function konfirmasiKeranjangStore(Request $request, $id)
    {
        $order = Orders::findOrFail($id);

        $request->validate([
            'tanggal_acara' => 'required|date',
            'waktu_acara' => 'required|date_format:H:i',
            'alamat' => 'required|string',
            'jenis_pengambilan' => 'required|in:diantar,diambil',
            'metode_pembayaran' => 'required|in:transfer',
            'bukti_pembayaran' => 'required|file|mimes:jpg,png,jpeg',
        ]);

        $filePath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $order->update([
            'status' => 'baru',
            'tanggal_acara' => $request->tanggal_acara,
            'waktu_acara' => $request->waktu_acara,
            'alamat' => $request->alamat,
            'catatan' => $request->catatan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $filePath,
            'jenis_pengambilan' => $request->jenis_pengambilan,
        ]);

        return redirect()->route('frontend-keranjangBelanja');
    }

    public function daftar_pesananUser()
    {
        $orders = Orders::whereIn('status', ['baru', 'menunggu', 'dibuat', 'diantar', 'selesai', 'batal', 'transaksi_selesai'])
            ->where('customer_id', auth('customer')->id())
            ->get();
            
        return view('frontend.daftar_pesanan', compact('orders'));
    }

    public function myProfile()
    {
        return view('frontend.profile');
    }
}
