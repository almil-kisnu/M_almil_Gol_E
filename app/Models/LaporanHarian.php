<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    use HasFactory;

    protected $table = 'laporan_harian';

    protected $fillable = [
        'tanggal',
        'uang_fisik',
        'uang_digital',
        'selisih',
    ];

    protected $casts = [
        'tanggal'      => 'date',
        'uang_fisik'   => 'decimal:2',
        'uang_digital' => 'decimal:2',
        'selisih'      => 'decimal:2',
    ];
}
