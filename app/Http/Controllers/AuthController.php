<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function loginProcess(Request $request)
    {
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('frontend-myProfile');
        } elseif (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('dashboard');
        } else{
            return redirect()->back();
        }
    }

    public function logoutProcess(Request $request)
    {
        if (Auth::guard('customer')->check()){
            Auth::guard('customer')->logout();
        } elseif (Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }

        return redirect('/');
    }

    public function registerPage()
    {
        return view('register');
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email',
            'password' => 'required|string|min:8',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'kode_pos' => 'required|string|max:10',
            'provinsi' => 'required|string|max:100',
            'tipe_akun' => 'required|in:individu,perusahaan,instansi'
        ]);

        Customers::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'provinsi' => $request->provinsi,
            'tipe_akun' => $request->tipe_akun,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'password_plain' => $request->input('password'),
        ]);

        return redirect()->route('login');
    }
}
