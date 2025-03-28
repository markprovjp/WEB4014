<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'activation_token',
        'active',
        'role', // Thêm cột role vào đây
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'activation_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
    ];
    
    // Ghi đè phương thức gửi email của Laravel để Việt hóa nội dung
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token));
    }
    
    // Mối quan hệ với comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Thêm phương thức kiểm tra quyền admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}