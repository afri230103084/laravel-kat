<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    private function validateExpense(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|numeric',
            'tanggal_pengeluaran' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);
    }

    public function index()
    {
        $data = Expense::paginate(15);
        return view('expense.index', compact('data'));
    }

    public function create()
    {
        return view('expense.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateExpense($request);
        Expense::create($validatedData);

        return redirect()->route('pengeluaran-index')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function edit(Expense $expense)
    {
        return view('expense.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validatedData = $this->validateExpense($request);
        $expense->update($validatedData);

        return redirect()->route('pengeluaran-index')->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('pengeluaran-index')->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
