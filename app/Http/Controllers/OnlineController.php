<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class OnlineController extends Controller
{
    public function beranda()
    {
        return view('landing_page.beranda');
    }

    public function about()
    {
        return view('landing_page.about');
    }

    public function kategori()
    {
        $categories = Categories::where('status', 'aktif')->orderBy('created_at', 'desc')->get();
        return view('landing_page.kategori', compact('categories'));
    }

    public function menu()
    {
        $products = Products::where('status', 'aktif')->get();

        return view('landing_page.menu', compact('products'));
    }
}
