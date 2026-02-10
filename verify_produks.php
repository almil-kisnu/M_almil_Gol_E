<?php

use App\Models\Produk;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $count = Produk::count();
    echo "Total Produk: " . $count . PHP_EOL;

    if ($count > 0) {
        $first = Produk::first();
        echo "Example: " . $first->nama_barang . " - " . $first->harga . PHP_EOL;
    } else {
        echo "No products found." . PHP_EOL;
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
