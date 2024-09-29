<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
                'supplier_id'=>1,
                'supplier_kode'=>'yol',
                'supplier_nama'=>'Yolanda Supplier',
                'supplier_alamat'=>'Jln Hamidrusdi No.102',
            ],
            [
                'supplier_id'=>2,
                'supplier_kode'=>'snd',
                'supplier_nama'=>'Sendi Supplier',
                'supplier_alamat'=>'Jln Buring No.54',
            ],
            [
                'supplier_id'=>3,
                'supplier_kode'=>'liy',
                'supplier_nama'=>'Liya Supplier',
                'supplier_alamat'=>'Jln Tuban no 65',
            ]
        ];
        DB::table('m_supplier')->insert($data);
    }
}
