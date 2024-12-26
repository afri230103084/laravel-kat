<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private function validateCategory(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'deskripsi' => 'nullable|string',
        ]);
    }

    public function index()
    {
        $data = Categories::all();
        return view('categories.index', compact('data'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateCategory($request);
        Categories::create($validatedData);

        return redirect()->route('kategori-index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Categories $kategori)
    {
        return view('categories.edit', compact('kategori'));
    }

    public function update(Request $request, Categories $kategori)
    {
        $validatedData = $this->validateCategory($request);
        $kategori->update($validatedData);

        return redirect()->route('kategori-index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Categories $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori-index')->with('success', 'Kategori berhasil dihapus.');
    }
}
