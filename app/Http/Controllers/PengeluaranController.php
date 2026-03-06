<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{

    public function index()
    {
        $pengeluaran     = Pengeluaran::orderBy('tanggal', 'desc')->get();
        $totalKeseluruhan = $pengeluaran->sum('total');

        return view('admin.pengeluaran', compact('pengeluaran', 'totalKeseluruhan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'total'     => 'required|numeric|min:0',
            'tanggal'   => 'required|date',
        ], [
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max'      => 'Deskripsi maksimal 255 karakter.',
            'total.required'     => 'Total pengeluaran wajib diisi.',
            'total.numeric'      => 'Total harus berupa angka.',
            'total.min'          => 'Total tidak boleh kurang dari 0.',
            'tanggal.required'   => 'Tanggal wajib diisi.',
            'tanggal.date'       => 'Format tanggal tidak valid.',
        ]);

        Pengeluaran::create($request->only('deskripsi', 'total', 'tanggal'));

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }


    public function show(Pengeluaran $pengeluaran)
    {
        return response()->json($pengeluaran);
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'total'     => 'required|numeric|min:0',
            'tanggal'   => 'required|date',
        ], [
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.max'      => 'Deskripsi maksimal 255 karakter.',
            'total.required'     => 'Total pengeluaran wajib diisi.',
            'total.numeric'      => 'Total harus berupa angka.',
            'total.min'          => 'Total tidak boleh kurang dari 0.',
            'tanggal.required'   => 'Tanggal wajib diisi.',
            'tanggal.date'       => 'Format tanggal tidak valid.',
        ]);

        $pengeluaran->update($request->only('deskripsi', 'total', 'tanggal'));

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }


    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil dihapus.');
    }
}
