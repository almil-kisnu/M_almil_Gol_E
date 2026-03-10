<?php

namespace App\Http\Controllers;

use App\Models\RiwayatTransaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $transaksi = RiwayatTransaksi::select('id', 'total', 'bayar', 'kembalian', 'tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalTransaksi = RiwayatTransaksi::sum('total');

        return view('admin.dashboard', compact('transaksi', 'totalTransaksi'));
    }
}
