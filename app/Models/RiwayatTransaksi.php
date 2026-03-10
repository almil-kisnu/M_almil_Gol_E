<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_transaksi';

    protected $fillable = [
        'total',
        'bayar',
        'kembalian',
        'tanggal',
    ];

    protected $casts = [
        'tanggal'   => 'date',
        'total'     => 'decimal:2',
        'bayar'     => 'decimal:2',
        'kembalian' => 'decimal:2',
    ];
}
