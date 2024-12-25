<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeesController extends Controller
{
    private function validateEmployee(Request $request, $id = null)
    {
        $uniqueEmail = $id ? 'unique:employees,email,' . $id : 'unique:employees,email';
        
        return $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', $uniqueEmail],
            'telepon' => 'required|string|max:15',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'gaji' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg',
            'no_ktp' => 'nullable|string|max:50',
            'tanggal_masuk' => 'required|date',
        ]);
    }

    public function index()
    {
        $data = Employees::all();
        return view('employees.index', compact('data'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateEmployee($request);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('karyawan', 'public');
        }

        Employees::create($validatedData);

        return redirect()->route('karyawan-index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(Employees $employees)
    {
        return view('employees.edit', compact('employees'));
    }

    public function update(Request $request, Employees $employees)
    {
        $validatedData = $this->validateEmployee($request, $employees->id);

        if ($request->hasFile('foto')) {
            if ($employees->foto) {
                Storage::disk('public')->delete($employees->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('karyawan', 'public');
        }

        $employees->update($validatedData);

        return redirect()->route('karyawan-index')->with('success', 'Data karyawan diperbarui.');
    }

    public function destroy(Employees $employees)
    {
        if ($employees->foto) {
            Storage::disk('public')->delete($employees->foto);
        }
        $employees->delete();
        
        return redirect()->route('karyawan-index')->with('success', 'Karyawan dihapus.');
    }
}
