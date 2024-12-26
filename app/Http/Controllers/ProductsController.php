<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    private function validateProduct(Request $request, $id = null)
    {
        return $request->validate([
            'kategori_id' => 'required|exists:categories,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'minimal_pesan' => 'required|numeric',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => $id ? 'nullable|image|mimes:jpeg,png,jpg' : 'required|image|mimes:jpeg,png,jpg',
        ]);
    }

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
        $validatedData = $this->validateProduct($request);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('menu-items', 'public');
        }

        Products::create($validatedData);

        return redirect()->route('produk-index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Products $produk)
    {
        $categories = Categories::where('status', 'aktif')->get();
        return view('products.edit', compact('produk', 'categories'));
    }

    public function update(Request $request, Products $produk)
    {
        $validatedData = $this->validateProduct($request, $produk->id);

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('menu-items', 'public');
        } else {
            $validatedData['foto'] = $produk->foto;
        }

        $produk->update($validatedData);

        return redirect()->route('produk-index')->with('success', 'Data produk diperbarui.');
    }

    public function destroy(Products $produk)
    {
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        $produk->delete();

        return redirect()->route('produk-index')->with('success', 'Produk dihapus.');
    }
}
