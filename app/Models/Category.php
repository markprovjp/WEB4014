<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'loaisanpham';
    
    protected $fillable = [
        'ten', 
        'mota', 
        'trangthai'
    ];
    
    // Relationship with products (if needed)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
