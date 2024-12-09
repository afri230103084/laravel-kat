<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Salaries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalariesController extends Controller
{
    public function index()
    {
        $data = DB::table('salaries')
        ->join('employees', 'salaries.employee_id', '=', 'employees.id')
        ->select('salaries.*', 'employees.nama')
        ->get();

        return view('salary.index', compact('data'));
    }

    public function create()
    {
        $karyawans = Employees::all();
        return view('salary.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary_date' => 'required|date',
        ]);

        $employee = Employees::findOrFail($request->employee_id);
        $amount = $employee->gaji;

        Salaries::create([
            'employee_id' => $request->employee_id,
            'amount' => $amount,
            'salary_date' => $request->salary_date,
        ]);

        return redirect()->route('gaji-index');
    }

    public function destroy($id)
    {
        $gaji = Salaries::findOrFail($id);
        $gaji->delete();

        return redirect()->route('gaji-index');
    }
}
