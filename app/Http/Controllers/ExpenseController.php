<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $data = Expense::all();
        return view('expense.index', compact('data'));
    }

    public function create()
    {
        return view('expense.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal_pengeluaran' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        Expense::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
        ]);

        return redirect()->route('pengeluaran-index');
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('expense.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal_pengeluaran' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
        ]);

        return redirect()->route('pengeluaran-index');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('pengeluaran-index');
    }
}
