<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class LoaiSPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loaisp = [
            ['tenLoai' => 'Điện thoại Samsung', 'thuTu' => 1, 'anHien' => 1],
            ['tenLoai' => 'Điện thoại iPhone', 'thuTu' => 2, 'anHien' => 1],
            ['tenLoai' => 'Điện thoại Oppo', 'thuTu' => 3, 'anHien' => 1],
            ['tenLoai' => 'Điện thoại Nokia', 'thuTu' => 4, 'anHien' => 1],
            ['tenLoai' => 'Điện thoại Xiaomi', 'thuTu' => 5, 'anHien' => 1],
            ['tenLoai' => 'Điện thoại Realme', 'thuTu' => 6, 'anHien' => 1],
            ['tenLoai' => 'Điện thoại Vivo', 'thuTu' => 7, 'anHien' => 1],
        ];

        DB::table('loaisp')->insert($loaisp);
    }
}