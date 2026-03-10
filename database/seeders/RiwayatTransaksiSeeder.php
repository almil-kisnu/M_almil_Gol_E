<?php

namespace Database\Seeders;

use App\Models\RiwayatTransaksi;
use Illuminate\Database\Seeder;

class RiwayatTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        RiwayatTransaksi::factory()->count(50)->create();
    }
}
