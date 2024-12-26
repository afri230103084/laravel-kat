<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    private function validateCustomer(Request $request, $customer = null)
    {
        return $request->validate([
            'nama' => 'required|string|max:150',
            'telepon' => 'required|string|max:20|unique:customers,telepon,' . ($customer ? $customer->id : ''),
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'provinsi' => 'required|string|max:100',
            'tipe_akun' => 'required|in:individu,perusahaan,instansi',
            'email' => 'required|email|unique:customers,email,' . ($customer ? $customer->id : ''),
        ]);
    }

    public function index()
    {
        $data = Customers::all();
        return view('customers.index', compact('data'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateCustomer($request);

        $password = $validatedData['telepon'];

        Customers::create([
            'nama' => $validatedData['nama'],
            'telepon' => $validatedData['telepon'],
            'alamat' => $validatedData['alamat'],
            'kota' => $validatedData['kota'],
            'kode_pos' => $validatedData['kode_pos'],
            'provinsi' => $validatedData['provinsi'],
            'tipe_akun' => $validatedData['tipe_akun'],
            'email' => $validatedData['email'],
            'password' => Hash::make($password),
            'password_plain' => $password,
        ]);

        return redirect()->route('pelanggan-index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(Customers $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customers $customer)
    {
        $validatedData = $this->validateCustomer($request, $customer);
        $customer->update($validatedData);

        return redirect()->route('pelanggan-index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return redirect()->route('pelanggan-index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
