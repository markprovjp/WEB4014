<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class DienThoaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all loaisp ids
        $loaisp_ids = DB::table('loaisp')->pluck('id')->toArray();

        // Base phone details
        $phones = [
            [
                'name' => 'Oppo XA',
                'min_price' => 700000,
                'max_price' => 1000000,
                'description' => 'Điện thoại Oppo XA với nhiều tính năng hiện đại'
            ],
            [
                'name' => 'Iphone xs Max',
                'min_price' => 500000,
                'max_price' => 800000,
                'description' => 'Điện thoại Iphone xs Max với thiết kế sang trọng'
            ],
            [
                'name' => 'Nokia Pro',
                'min_price' => 250000,
                'max_price' => 500000,
                'description' => 'Điện thoại Nokia Pro bền bỉ, đáng tin cậy'
            ]
        ];

        $dienthoai = [];

        for ($i = 0; $i < 300; $i++) {
            // Select a random phone from our base list
            $phoneIndex = $i % 3; // Rotate through the 3 phone types
            $currentPhone = $phones[$phoneIndex];
            
            // Generate variant number
            $variantNum = floor($i / 3) + 1;
            
            // Generate random price within range
            $price = rand($currentPhone['min_price'], $currentPhone['max_price']);
            
            // Random discount price (between 0 and 30% off)
            $discountPercent = rand(0, 30);
            $discountPrice = $price * (1 - ($discountPercent / 100));
            $discountPrice = round($discountPrice, 2);
            
            // Only apply discount sometimes
            if (rand(0, 1) == 0) {
                $discountPrice = 0;
            }
            
            $dienthoai[] = [
                'tenDT' => $currentPhone['name'] . ' ' . $variantNum,
                'moTa' => $currentPhone['description'] . ' - Phiên bản ' . $variantNum,
                'ngayCapNhat' => Carbon::now()->subDays(rand(0, 90))->format('Y-m-d H:i:s'),
                'gia' => $price,
                'giaKM' => $discountPrice,
                'urlHinh' => 'phone_' . $phoneIndex . '_' . $variantNum . '.jpg',
                'soLuongTonKho' => rand(0, 100),
                'hot' => rand(0, 1),
                'anHien' => 1,
                'baiViet' => 'Chi tiết về điện thoại ' . $currentPhone['name'] . ' ' . $variantNum,
                'ghiChu' => 'Ghi chú cho ' . $currentPhone['name'] . ' ' . $variantNum,
                'idLoai' => $loaisp_ids[array_rand($loaisp_ids)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Insert in chunks to avoid potential issues with large inserts
        foreach (array_chunk($dienthoai, 50) as $chunk) {
            DB::table('dienthoai')->insert($chunk);
        }
    }
}