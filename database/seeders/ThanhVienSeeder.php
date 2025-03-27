<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class ThanhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Arrays for random name generation
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Huỳnh', 'Phan', 'Vũ', 'Võ', 'Đặng'];
        $tenDem = ['Văn', 'Thị', 'Đức', 'Hữu', 'Quang', 'Minh', 'Thanh', 'Ngọc', 'Kim', 'Tuấn'];
        $ten = ['Hải', 'Hà', 'Nam', 'Long', 'Hưng', 'Dũng', 'Phong', 'Thái', 'Sơn', 'Tùng'];

        $thanhvien = [];

        for ($i = 0; $i < 100; $i++) {
            // Generate random name
            $randomHo = $ho[array_rand($ho)];
            $randomTenDem = $tenDem[array_rand($tenDem)];
            $randomTen = $ten[array_rand($ten)];
            $hoTen = "$randomHo $randomTenDem $randomTen";
            
            // Generate random email
            $emailName = strtolower(
                preg_replace('/[^a-zA-Z0-9]/', '', 
                iconv('UTF-8', 'ASCII//TRANSLIT', $randomTen)) . 
                preg_replace('/[^a-zA-Z0-9]/', '', 
                iconv('UTF-8', 'ASCII//TRANSLIT', $randomHo)) . 
                rand(1, 999)
            );
            $email = $emailName . '@gmail.com';
            
            $thanhvien[] = [
                'hoTen' => $hoTen,
                'password' => Hash::make('hehe'),
                'email' => $email,
                'randomKey' => rand(0, 1) ? null : bin2hex(random_bytes(50)),
                'active' => rand(0, 1),
                'idGroup' => rand(0, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert in chunks to avoid potential issues with large inserts
        foreach (array_chunk($thanhvien, 50) as $chunk) {
            DB::table('thanhvien')->insert($chunk);
        }
    }
}
/* php artisan db:seed --class=LoaiSPSeeder
php artisan db:seed --class=DienThoaiSeeder
php artisan db:seed --class=ThanhVienSeeder */