<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Produk; 

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataProduk = [
            [
                'nama_barang' => 'Laptop Gaming ROG',
                'harga' => 15000000,
            ],
            [
                'nama_barang' => 'Mouse Wireless Logitech',
                'harga' => 350000,
            ],
            [
                'nama_barang' => 'Keyboard Mechanical',
                'harga' => 850000,
            ],
            [
                'nama_barang' => 'Monitor 24 Inch 144Hz',
                'harga' => 2100000,
            ],
            [
                'nama_barang' => 'Headset Steelseries',
                'harga' => 1200000,
            ],
        ];

        // Masukkan data ke tabel 'produks'
        foreach ($dataProduk as $produk) {
            Produk::create($produk);
        }
    }
}