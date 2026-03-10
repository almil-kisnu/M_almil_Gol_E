<?php

namespace Database\Factories;

use App\Models\RiwayatTransaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

class RiwayatTransaksiFactory extends Factory
{
    protected $model = RiwayatTransaksi::class;

    public function definition(): array
    {
        $total = fake()->numberBetween(5000, 500000);
        $total = round($total / 500) * 500; // Round to nearest 500
        $bayar = ceil($total / 10000) * 10000; // Round up to nearest 10000
        if ($bayar < $total) $bayar = $total;
        $kembalian = $bayar - $total;

        return [
            'total'     => $total,
            'bayar'     => $bayar,
            'kembalian' => $kembalian,
            'tanggal'   => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
        ];
    }
}
