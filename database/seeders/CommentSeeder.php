<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $comments = [
            [
                'user_id' => 1,
                'news_id' => 1,
                'content' => 'Tuyệt vời! Việt Nam vô địch xứng đáng.',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'news_id' => 2,
                'content' => 'MV này hay quá, Sơn Tùng đỉnh cao!',
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'news_id' => 3,
                'content' => 'Mình thử làm rồi, ngon lắm!',
                'created_at' => now(),
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}