<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $news = [
            [
                'title' => 'Việt Nam vô địch AFF Cup 2024',
                'description' => 'Đội tuyển Việt Nam giành chiến thắng đầy thuyết phục.',
                'content' => 'Trong trận chung kết AFF Cup 2024, Việt Nam đã đánh bại Thái Lan với tỷ số 2-1...',
                'category_id' => 1, // Thể thao
                'views' => 150,
                'image' => 'aff_cup_2024.jpg',
                'created_at' => now(),
            ],
            [
                'title' => 'Sơn Tùng M-TP ra mắt MV mới',
                'description' => 'MV mới của Sơn Tùng gây bão cộng đồng mạng.',
                'content' => 'MV mới mang tên "Hãy Trao Cho Anh 2" đã thu hút hàng triệu lượt xem chỉ sau 24 giờ...',
                'category_id' => 2, // Âm nhạc
                'views' => 200,
                'image' => 'son_tung_mv.jpg',
                'created_at' => now(),
            ],
            [
                'title' => 'Cách làm bánh mì pate chuẩn vị',
                'description' => 'Học ngay công thức làm bánh mì pate ngon tại nhà.',
                'content' => 'Bánh mì pate là món ăn quen thuộc của người Việt, với nguyên liệu đơn giản...',
                'category_id' => 3, // Ẩm thực
                'views' => 80,
                'image' => 'banh_mi_pate.jpg',
                'created_at' => now(),
            ],
            [
                'title' => 'iPhone 16 ra mắt với thiết kế đột phá',
                'description' => 'Apple công bố iPhone 16 với nhiều cải tiến.',
                'content' => 'iPhone 16 được trang bị chip A18, camera cải tiến và thiết kế không viền...',
                'category_id' => 4, // Công nghệ
                'views' => 300,
                'image' => 'iphone_16.jpg',
                'created_at' => now(),
            ],
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}