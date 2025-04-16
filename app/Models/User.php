<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active',
        'avatar',
        'phone',
        'notification_settings',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Kiểm tra xem người dùng có phải là admin hay không
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Mối quan hệ với bình luận
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Lấy mảng cài đặt thông báo
     */
    public function getNotificationSettingsArray()
    {
        if (empty($this->notification_settings)) {
            return [
                'email_news' => true,
                'email_comments' => true,
                'email_account' => true,
                'email_marketing' => false,
            ];
        }

        return json_decode($this->notification_settings, true);
    }
}