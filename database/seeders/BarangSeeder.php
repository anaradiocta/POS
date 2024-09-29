<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id'=>1,
                'kategori_id'=>1,
                'barang_kode'=>'nas',
                'barang_nama'=>'Nasi',
                'harga_beli'=>10000,
                'harga_jual'=>12000
            ],
            [
                'barang_id'=>2,
                'kategori_id'=>1,
                'barang_kode'=>'aym',
                'barang_nama'=>'Ayam',
                'harga_beli'=>8000,
                'harga_jual'=>10000
            ],
            [
                'barang_id'=>3,
                'kategori_id'=>1,
                'barang_kode'=>'saw',
                'barang_nama'=>'Sawi',
                'harga_beli'=>5000,
                'harga_jual'=>7000
            ],
            [
                'barang_id'=>4,
                'kategori_id'=>2,
                'barang_kode'=>'pmg',
                'barang_nama'=>'Promag',
                'harga_beli'=>8000,
                'harga_jual'=>10000
            ],
            [
                'barang_id'=>5,
                'kategori_id'=>2,
                'barang_kode'=>'scr',
                'barang_nama'=>'Sunscreen',
                'harga_beli'=>12000,
                'harga_jual'=>15000
            ],
            [
                'barang_id'=>6,
                'kategori_id'=>2,
                'barang_kode'=>'dlx',
                'barang_nama'=>'Dulcolax',
                'harga_beli'=>8000,
                'harga_jual'=>10000
            ],
            [
                'barang_id'=>7,
                'kategori_id'=>3,
                'barang_kode'=>'myt',
                'barang_nama'=>'Minyak Telon',
                'harga_beli'=>15000,
                'harga_jual'=>19000
            ],
            [
                'barang_id'=>8,
                'kategori_id'=>3,
                'barang_kode'=>'pop',
                'barang_nama'=>'Popok Bayi',
                'harga_beli'=>8000,
                'harga_jual'=>20000
            ],
            [
                'barang_id'=>9,
                'kategori_id'=>3,
                'barang_kode'=>'bdk',
                'barang_nama'=>'Bedak Bayi',
                'harga_beli'=>8000,
                'harga_jual'=>10000
            ],
            [
                'barang_id'=>10,
                'kategori_id'=>4,
                'barang_kode'=>'krs',
                'barang_nama'=>'Kursi Plastik',
                'harga_beli'=>20000,
                'harga_jual'=>22000
            ],
            [
                'barang_id'=>11,
                'kategori_id'=>4,
                'barang_kode'=>'pel',
                'barang_nama'=>'Pel',
                'harga_beli'=>8000,
                'harga_jual'=>10000
            ],
            [
                'barang_id'=>12,
                'kategori_id'=>4,
                'barang_kode'=>'sap',
                'barang_nama'=>'Sapu',
                'harga_beli'=>8000,
                'harga_jual'=>10000
            ],
            [
                'barang_id'=>13,
                'kategori_id'=>5,
                'barang_kode'=>'lmp',
                'barang_nama'=>'Lampu',
                'harga_beli'=>8000,
                'harga_jual'=>10000
            ],
            [
                'barang_id'=>14,
                'kategori_id'=>5,
                'barang_kode'=>'stk',
                'barang_nama'=>'Stop Kontak',
                'harga_beli'=>8000,
                'harga_jual'=>10000
            ],
            [
                'barang_id'=>15,
                'kategori_id'=>5,
                'barang_kode'=>'kbl',
                'barang_nama'=>'Kabel',
                'harga_beli'=>8000,
                'harga_jual'=>10000
            ]
        ];
        DB::table('m_barang')->insert($data);
    }
}
