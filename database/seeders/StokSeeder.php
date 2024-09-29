<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'stok_id' => 1,
                'barang_id' => 1,
                'supplier_id' => 1,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 2,
                'barang_id' => 2,
                'supplier_id' => 1,
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 5
            ],
            [
                'stok_id' => 3,
                'barang_id' => 1,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 1, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 4,
                'barang_id' => 2,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 1, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 5,
                'barang_id' => 3,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 1, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 6,
                'barang_id' => 4,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 2, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 7,
                'barang_id' => 5,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 2, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 8,
                'barang_id' => 6,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 2, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 9,
                'barang_id' => 7,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 2, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 10,
                'barang_id' => 8,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 2, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 11,
                'barang_id' => 9,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 3, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 12,
                'barang_id' => 10,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 3, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 13,
                'barang_id' => 11,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 3, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 14,
                'barang_id' => 12,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 3, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ],
            [
                'stok_id' => 15,
                'barang_id' => 13,  // Barang ID sesuai urutan yang benar
                'supplier_id' => 3, // Supplier ID sesuai urutan yang benar
                'user_id' => 3,
                'stok_tanggal' => '2024-09-11',
                'stok_jumlah' => 4
            ]
        ];

        DB::table('t_stok')->insert($data);
    }
}
