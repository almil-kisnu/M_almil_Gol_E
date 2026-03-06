<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // --- DUMMY DATA ---

        $stats = [
            ['label' => 'Total Pengguna',   'value' => '12,840',  'change' => '+8.2%',  'trend' => 'up',   'icon' => 'users',        'color' => 'blue'],
            ['label' => 'Total Produk',     'value' => '3,456',   'change' => '+3.1%',  'trend' => 'up',   'icon' => 'box',          'color' => 'purple'],
            ['label' => 'Pendapatan',        'value' => 'Rp 98,4M','change' => '+14.5%', 'trend' => 'up',   'icon' => 'dollar-sign',  'color' => 'green'],
            ['label' => 'Pesanan Baru',      'value' => '1,284',   'change' => '-2.3%',  'trend' => 'down', 'icon' => 'shopping-cart','color' => 'orange'],
        ];

        $orders = [
            ['id' => '#ORD-00124', 'customer' => 'Ahmad Fauzi',      'product' => 'Laptop Pro X15',     'amount' => 'Rp 18.500.000', 'status' => 'Selesai',    'date' => '26 Feb 2026'],
            ['id' => '#ORD-00123', 'customer' => 'Siti Rahayu',      'product' => 'Mechanical Keyboard', 'amount' => 'Rp 850.000',   'status' => 'Dikirim',    'date' => '26 Feb 2026'],
            ['id' => '#ORD-00122', 'customer' => 'Budi Santoso',     'product' => 'Monitor 4K 27"',      'amount' => 'Rp 5.200.000', 'status' => 'Diproses',   'date' => '25 Feb 2026'],
            ['id' => '#ORD-00121', 'customer' => 'Dewi Lestari',     'product' => 'Wireless Mouse',      'amount' => 'Rp 320.000',   'status' => 'Selesai',    'date' => '25 Feb 2026'],
            ['id' => '#ORD-00120', 'customer' => 'Rizki Pratama',    'product' => 'USB-C Hub 7-in-1',    'amount' => 'Rp 480.000',   'status' => 'Dibatalkan', 'date' => '24 Feb 2026'],
            ['id' => '#ORD-00119', 'customer' => 'Nina Wulandari',   'product' => 'SSD 1TB NVMe',        'amount' => 'Rp 1.200.000', 'status' => 'Dikirim',    'date' => '24 Feb 2026'],
            ['id' => '#ORD-00118', 'customer' => 'Hendra Gunawan',   'product' => 'RAM DDR5 32GB',       'amount' => 'Rp 1.850.000', 'status' => 'Selesai',    'date' => '23 Feb 2026'],
        ];

        $topProducts = [
            ['name' => 'Laptop Pro X15',      'sold' => 428, 'revenue' => 'Rp 79,2M', 'stock' => 54,  'pct' => 92],
            ['name' => 'Monitor 4K 27"',      'sold' => 312, 'revenue' => 'Rp 62,4M', 'stock' => 120, 'pct' => 75],
            ['name' => 'Mechanical Keyboard', 'sold' => 284, 'revenue' => 'Rp 24,1M', 'stock' => 87,  'pct' => 68],
            ['name' => 'Wireless Mouse',      'sold' => 215, 'revenue' => 'Rp 6,9M',  'stock' => 210, 'pct' => 51],
            ['name' => 'SSD 1TB NVMe',        'sold' => 198, 'revenue' => 'Rp 23,8M', 'stock' => 65,  'pct' => 47],
        ];

        $recentUsers = [
            ['name' => 'Ahmad Fauzi',    'email' => 'ahmad.fauzi@email.com',    'role' => 'Admin',    'joined' => '26 Feb 2026', 'status' => 'Aktif'],
            ['name' => 'Siti Rahayu',   'email' => 'siti.rahayu@email.com',    'role' => 'Editor',   'joined' => '25 Feb 2026', 'status' => 'Aktif'],
            ['name' => 'Budi Santoso',  'email' => 'budi.santoso@email.com',   'role' => 'Viewer',   'joined' => '24 Feb 2026', 'status' => 'Nonaktif'],
            ['name' => 'Dewi Lestari',  'email' => 'dewi.lestari@email.com',   'role' => 'Editor',   'joined' => '23 Feb 2026', 'status' => 'Aktif'],
            ['name' => 'Rizki Pratama', 'email' => 'rizki.pratama@email.com',  'role' => 'Viewer',   'joined' => '22 Feb 2026', 'status' => 'Aktif'],
        ];

        $activities = [
            ['user' => 'Ahmad Fauzi',    'action' => 'menambahkan produk baru',       'target' => 'Laptop Pro X15',      'time' => '5 menit lalu',  'icon' => 'plus-circle',  'color' => 'green'],
            ['user' => 'Siti Rahayu',   'action' => 'memperbarui stok',              'target' => 'Monitor 4K 27"',      'time' => '18 menit lalu', 'icon' => 'edit',          'color' => 'blue'],
            ['user' => 'System',         'action' => 'backup database berhasil',      'target' => 'db_produk.sql',       'time' => '1 jam lalu',    'icon' => 'database',      'color' => 'purple'],
            ['user' => 'Budi Santoso',  'action' => 'menghapus pesanan',             'target' => '#ORD-00105',          'time' => '2 jam lalu',    'icon' => 'trash-2',       'color' => 'red'],
            ['user' => 'Dewi Lestari',  'action' => 'mengekspor laporan',            'target' => 'laporan_feb_2026.xlsx','time' => '3 jam lalu',   'icon' => 'download',      'color' => 'orange'],
            ['user' => 'System',         'action' => 'email notifikasi terkirim',     'target' => '284 pengguna',        'time' => '5 jam lalu',    'icon' => 'mail',          'color' => 'teal'],
        ];

        // Monthly revenue data (for chart)
        $chartRevenue = [28, 45, 38, 52, 61, 47, 70, 83, 76, 91, 88, 98];
        $chartOrders  = [120, 180, 155, 210, 248, 195, 280, 320, 295, 360, 340, 385];
        $chartMonths  = ['Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des','Jan','Feb'];

        return view('admin.dashboard', compact(
            'stats', 'orders', 'topProducts', 'recentUsers', 'activities',
            'chartRevenue', 'chartOrders', 'chartMonths'
        ));
    }
}
