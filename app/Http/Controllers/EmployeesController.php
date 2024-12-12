<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeesController extends Controller
{
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'telepon' => 'required|string|max:15',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'gaji' => 'required|numeric|min:0',
            'foto' => 'required|image|mimes:jpeg,png,jpg',
            'no_ktp' => 'nullable|string|max:50',
            'tanggal_masuk' => 'required|date',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('karyawan', 'public');
        }

        Employees::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'gaji' => $request->gaji,
            'foto' => $fotoPath,
            'no_ktp' => $request->no_ktp,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('karyawan-index');
    }

    public function edit($id)
    {
        $karyawan = Employees::findOrFail($id);
        return view('employees.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Employees::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $karyawan->id,
            'telepon' => 'required|string|max:15',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'gaji' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'no_ktp' => 'nullable|string|max:50',
            'tanggal_masuk' => 'required|date',
        ]);

        $fotoPath = $karyawan->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('karyawan', 'public');
        }

        $karyawan->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'gaji' => $request->gaji,
            'foto' => $fotoPath,
            'no_ktp' => $request->no_ktp,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('karyawan-index');
    }

    public function destroy($id)
    {
        $karyawan = Employees::findOrFail($id);

        if ($karyawan->foto) {
            Storage::disk('public')->delete($karyawan->foto);
        }

        $karyawan->delete();

        return redirect()->route('karyawan-index');
    }
}
