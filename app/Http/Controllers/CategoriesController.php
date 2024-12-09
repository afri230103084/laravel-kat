<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'deskripsi' => 'nullable|string',
        ]);

        Categories::create([
            'nama' => $request->nama,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori-index');
    }

    public function edit($id)
    {
        $kategori = Categories::findOrFail($id);
        return view('categories.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = Categories::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori-index');
    }

    public function destroy($id)
    {
        $kategori = Categories::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori-index');
    }
}
