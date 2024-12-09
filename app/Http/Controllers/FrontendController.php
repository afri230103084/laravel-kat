<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class FrontendController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function myProfile()
    {
        return view('frontend.profile');
    }

    public function buat_pesanan()
    {
        $product = Products::where('status', 'aktif')->get();
        return view('frontend.buat_pesanan', compact('product'));
    }

    public function buat_pesananStore(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'jenis_pengambilan' => 'required',
            'metode_pembayaran' => 'required',
            'alamat' => 'required',
            'tanggal_acara' => 'required',
            'waktu_acara' => 'required',
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

        $order = Orders::create([
            'customer_id' => $request->customer_id,
            'kode_transaksi' => $kodeTransaksi,
            'jenis_pengambilan' => $request->jenis_pengambilan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $totalHarga,
            'alamat' => $request->alamat,
            'tanggal_acara' => $request->tanggal_acara,
            'waktu_acara' => $request->waktu_acara,
        ]);

        foreach ($request->items as $item) {
            $product = Products::find($item['product_id']);
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $product->harga,
                'subtotal' => $product->harga * $item['jumlah'],
            ]);
        }

        $customer = Customers::find($request->customer_id);

        if (!$customer) {
            Log::error('Pelanggan tidak ditemukan.', ['customer_id' => $request->customer_id]);
            return back()->with('error', 'Pelanggan tidak ditemukan.');
        }

        if ($request->metode_pembayaran === 'transfer') {
            try {
                $params = [
                    'transaction_details' => [
                        'order_id' => $kodeTransaksi,
                        'gross_amount' => $totalHarga,
                    ],
                    'customer_details' => [
                        'first_name' => $customer->nama,
                        'email' => $customer->email,
                        'phone' => $customer->telepon,
                    ],
                    'item_details' => array_map(function ($item) use ($request) {
                        $product = Products::find($item['product_id']);
                        return [
                            'id' => $item['product_id'],  // ID produk
                            'price' => $product->harga,   // Harga produk
                            'quantity' => $item['jumlah'], // Jumlah produk
                            'name' => $product->nama,
                        ];
                    }, $request->items),
                ];

                Log::info('Memulai proses generate Snap Token.', ['params' => $params]);
                $snapToken = Snap::getSnapToken($params);
                Log::info('Snap Token berhasil dibuat.', ['snap_token' => $snapToken]);

                if (!$snapToken) {
                    Log::error('Gagal mendapatkan Snap Token dari Midtrans.');
                    return back()->with('error', 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
                }


                // Ambil URL untuk pembayaran dan redirect ke sana
                $paymentUrl = 'https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $snapToken;

                return redirect()->to($paymentUrl);
            } catch (\Exception $e) {
                Log::error('Gagal mendapatkan Snap Token dari Midtrans.', ['error' => $e->getMessage()]);
                return back()->with('error', 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
            }
        }

        return redirect()->route('frontend-daftar_pesananUser')->with('success', 'Pesanan berhasil dibuat.');
    }


    public function handleWebhook(Request $request)
    {
        Log::info('Midtrans webhook received.', ['data' => $request->all()]);

        $data = $request->all();
        $order = Orders::where('kode_transaksi', $data['order_id'])->first();

        if ($order) {
            $status = $data['transaction_status'];
            $amount = $data['gross_amount'];

            if (in_array($status, ['capture', 'settlement'])) {
                $order->update([
                    'status_pembayaran' => 'lunas',
                    'status' => 'dibuat',
                    'jumlah_dibayar' => $amount,
                ]);
            } elseif (in_array($status, ['cancel', 'expire'])) {
                $order->update(['status' => 'batal']);
            }
        }
    }

    public function daftar_pesananUser()
    {
        Log::info('Halaman daftar pesanan user diakses.', ['customer_id' => auth('customer')->id()]);
        $orders = Orders::where('customer_id', auth('customer')->id())->get();
        return view('frontend.daftar_pesanan', compact('orders'));
    }
}
