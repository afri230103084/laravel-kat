<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Salaries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalariesController extends Controller
{
    private function validateSalary(Request $request)
    {
        return $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary_date' => 'required|date',
        ]);
    }

    public function index()
    {
        $data = Salaries::with('employee')->get();

        return view('salary.index', compact('data'));
    }

    public function create()
    {
        $karyawans = Employees::all();
        return view('salary.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateSalary($request);
        $employee = Employees::findOrFail($validatedData['employee_id']);
        $amount = $employee->gaji;

        Salaries::create([
            'employee_id' => $validatedData['employee_id'],
            'amount' => $amount,
            'salary_date' => $validatedData['salary_date'],
        ]);

        return redirect()->route('gaji-index')->with('success', 'Gaji berhasil ditambahkan.');
    }

    public function destroy(Salaries $salary)
    {
        $salary->delete();

        return redirect()->route('gaji-index')->with('success', 'Gaji berhasil dihapus.');
    }
}
