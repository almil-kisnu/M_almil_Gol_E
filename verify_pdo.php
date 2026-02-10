<?php
$host = '127.0.0.1';
$db   = 'laravel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    $stmt = $pdo->query("SELECT count(*) as count FROM produks");
    $count = $stmt->fetch()['count'];
    echo "Total Produk: " . $count . "\n";

    if ($count > 0) {
        $stmt = $pdo->query("SELECT * FROM produks LIMIT 1");
        $row = $stmt->fetch();
        echo "First Product: " . $row['nama_barang'] . " - " . $row['harga'] . "\n";
    } else {
        echo "No products found.\n";
    }

} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
