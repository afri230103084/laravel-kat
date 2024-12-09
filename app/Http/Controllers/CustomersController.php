<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
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
        $request->validate([
            'nama' => 'required|string|max:150',
            'telepon' => 'required|string|max:20|unique:customers,telepon',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'provinsi' => 'required|string|max:100',
            'tipe_akun' => 'required|in:individu,perusahaan,instansi',
            'email' => 'required|email|unique:customers,email',
        ]);

        $password = $this->generateSimplePassword($request->nama);

        Customers::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'provinsi' => $request->provinsi,
            'tipe_akun' => $request->tipe_akun,
            'email' => $request->email,
            'password' => Hash::make($password),
            'password_plain' => $password,
        ]);

        return redirect()->route('pelanggan-index');
    }

    protected function generateSimplePassword($nama)
    {
        $firstName = strtok($nama, ' ');
        $randomNumber = rand(100, 999);
        return strtolower($firstName) . $randomNumber;
    }

    public function edit($id)
    {
        $customer = Customers::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'telepon' => 'required|string|max:20|unique:customers,telepon,' . $id,
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'provinsi' => 'required|string|max:100',
            'tipe_akun' => 'required|in:individu,perusahaan,instansi',
            'email' => 'required|email|unique:customers,email,' . $id,
        ]);

        $customer = Customers::findOrFail($id);
        $customer->update([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'provinsi' => $request->provinsi,
            'tipe_akun' => $request->tipe_akun,
            'email' => $request->email,
        ]);

        return redirect()->route('pelanggan-index');
    }

    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();

        return redirect()->route('pelanggan-index');
    }
}
