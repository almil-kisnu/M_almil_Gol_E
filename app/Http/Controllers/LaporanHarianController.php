<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanHarianController extends Controller
{
    public function index()
    {
        $laporanHarian = DB::table('laporan_harian')
            ->select('id', 'tanggal', 'uang_fisik', 'uang_digital', 'selisih')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.laporan-harian', compact('laporanHarian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date|unique:laporan_harian,tanggal',
            'uang_fisik' => 'required|numeric|min:0',
        ], [
            'tanggal.required'    => 'Tanggal wajib diisi.',
            'tanggal.date'        => 'Format tanggal tidak valid.',
            'tanggal.unique'      => 'Laporan untuk tanggal ini sudah ada.',
            'uang_fisik.required' => 'Uang fisik wajib diisi.',
            'uang_fisik.numeric'  => 'Uang fisik harus berupa angka.',
            'uang_fisik.min'      => 'Uang fisik tidak boleh kurang dari 0.',
        ]);

        $tanggal = $request->tanggal;

        // Calculate uang_digital = SUM(riwayat_transaksi.total) - SUM(pengeluaran.total) for that date
        $totalTransaksi  = DB::table('riwayat_transaksi')->whereDate('tanggal', $tanggal)->sum('total');
        $totalPengeluaran = DB::table('pengeluaran')->whereDate('tanggal', $tanggal)->sum('total');
        $uangDigital = $totalTransaksi - $totalPengeluaran;

        $uangFisik = $request->uang_fisik;
        $selisih   = $uangFisik - $uangDigital;

        DB::table('laporan_harian')->insert([
            'tanggal'      => $tanggal,
            'uang_fisik'   => $uangFisik,
            'uang_digital' => $uangDigital,
            'selisih'      => $selisih,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()->route('admin.laporan-harian.index')
            ->with('success', 'Laporan harian berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $existing = DB::table('laporan_harian')->where('id', $id)->first();
        if (!$existing) {
            return redirect()->route('admin.laporan-harian.index')
                ->with('error', 'Laporan tidak ditemukan.');
        }

        $request->validate([
            'tanggal'    => 'required|date|unique:laporan_harian,tanggal,' . $id,
            'uang_fisik' => 'required|numeric|min:0',
        ], [
            'tanggal.required'    => 'Tanggal wajib diisi.',
            'tanggal.date'        => 'Format tanggal tidak valid.',
            'tanggal.unique'      => 'Laporan untuk tanggal ini sudah ada.',
            'uang_fisik.required' => 'Uang fisik wajib diisi.',
            'uang_fisik.numeric'  => 'Uang fisik harus berupa angka.',
            'uang_fisik.min'      => 'Uang fisik tidak boleh kurang dari 0.',
        ]);

        $tanggal = $request->tanggal;

        // Recalculate uang_digital
        $totalTransaksi   = DB::table('riwayat_transaksi')->whereDate('tanggal', $tanggal)->sum('total');
        $totalPengeluaran = DB::table('pengeluaran')->whereDate('tanggal', $tanggal)->sum('total');
        $uangDigital = $totalTransaksi - $totalPengeluaran;

        $uangFisik = $request->uang_fisik;
        $selisih   = $uangFisik - $uangDigital;

        DB::table('laporan_harian')->where('id', $id)->update([
            'tanggal'      => $tanggal,
            'uang_fisik'   => $uangFisik,
            'uang_digital' => $uangDigital,
            'selisih'      => $selisih,
            'updated_at'   => now(),
        ]);

        return redirect()->route('admin.laporan-harian.index')
            ->with('success', 'Laporan harian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('laporan_harian')->where('id', $id)->delete();

        return redirect()->route('admin.laporan-harian.index')
            ->with('success', 'Laporan harian berhasil dihapus.');
    }
}
