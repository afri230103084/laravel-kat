<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $produk = Products::all();
        return view('products.index', compact('produk'));
    }

    public function create()
    {
        $categories = Categories::where('status', 'aktif')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'minimal_pesan' => 'required|numeric',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $filePath = null;
        if ($request->hasFile('foto')) {
            $filePath = $request->file('foto')->store('menu-items', 'public');
        }

        Products::create([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'minimal_pesan' => $request->minimal_pesan,
            'status' => $request->status,
            'foto' => $filePath,
        ]);

        return redirect()->route('produk-index');
    }

    public function edit($id)
    {
        $produk = Products::findOrFail($id);
        $categories = Categories::where('status', 'aktif')->get();
        return view('products.edit', compact('produk', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'minimal_pesan' => 'required|numeric',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $produk = Products::findOrFail($id);
        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $filePath = $request->file('foto')->store('menu-items', 'public');
        } else {
            $filePath = $produk->foto;
        }

        $produk->update([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'minimal_pesan' => $request->minimal_pesan,
            'status' => $request->status,
            'foto' => $filePath,
        ]);

        return redirect()->route('produk-index');
    }

    public function destroy($id)
    {
        $produk = Products::findOrFail($id);

        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        $produk->delete();

        return redirect()->route('produk-index');
    }
}
