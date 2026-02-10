<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('produks.index', compact('produks'));
    }
}
