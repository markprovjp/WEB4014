<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tin extends Model
{
    protected $table = 'tin';
    // protected $primaryKey = 'id';
    protected $dates = ['ngayDang'];
    protected $fillable = [
        'tieuDe',
        'tomTat',
        'noiDung',
        'ngayDang',
        'xem',
        'idLT',
        'urlHinh',
        'anHien',
        'tags',
        'lang',
        'tinNoiBat',
        
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'nguoitao', 'id');
    }
}
