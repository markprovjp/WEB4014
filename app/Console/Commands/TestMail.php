<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMail extends Command
{
    protected $signature = 'mail:test {email?}';

    protected $description = 'Gửi email kiểm tra để xác minh cấu hình mail';

    public function handle()
    {
        $email = $this->argument('email') ?? $this->ask('Nhập địa chỉ email để gửi email kiểm tra');

        $this->info("Đang gửi email đến $email...");

        try {
            Mail::raw('Đây là email kiểm tra từ ứng dụng Laravel WEB4014', function ($message) use ($email) {
                $message->to($email)
                    ->subject('Kiểm tra cấu hình email WEB4014');
            });

            $this->info('Email đã được gửi thành công!');
        } catch (\Exception $e) {
            $this->error('Gửi email thất bại: ' . $e->getMessage());
        }
    }
}
