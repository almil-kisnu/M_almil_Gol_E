<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{

    public function index()
    {
        $pengeluaran     = DB::table('pengeluaran')
            ->select('id', 'deskripsi', 'total', 'tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();
        $totalKeseluruhan = DB::table('pengeluaran')->sum('total');

        return view('admin.pengeluaran', compact('pengeluaran', 'totalKeseluruhan'));
    }

    //insert data pengeluaran
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

        DB::table('pengeluaran')->insert([
            'deskripsi' => $request->deskripsi,
            'total'     => $request->total,
            'tanggal'   => $request->tanggal,
        ]);

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }


    //menampilkan data pengeluaran berdasarkan id
    public function show($id)
    {
        $pengeluaran = DB::table('pengeluaran')->where('id', $id)->first();
        if (!$pengeluaran) {
            return response()->json(['message' => 'Data pengeluaran tidak ditemukan.'], 404);
        }
        return response()->json($pengeluaran);
    }

    //update data pengeluaran berdasarkan id
    public function update(Request $request, $id)
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

        DB::table('pengeluaran')->where('id', $id)->update([
            'deskripsi' => $request->deskripsi,
            'total'     => $request->total,
            'tanggal'   => $request->tanggal,
        ]);

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }


    //delete data pengeluaran berdasarkan id
    public function destroy($id)
    {
        DB::table('pengeluaran')->where('id', $id)->delete();

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil dihapus.');
    }
}
