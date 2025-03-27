<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TinController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function chiTiet($id =  0)
    {
        $tin = DB::table('tin')->where('id', $id)->first();
        $data = [
            'id' => $id,
            'title' => 'Tin tức số ' . $id,
            'content' => 'Nội dung tin tức số ' . $id,
        ];
        return view('chitiet', $data);
    }

    public function tinTrongLoai($idLT = 0)
    {
        $listTin = DB::table('tin')->where('idLT', $idLT)->get();
        $data = [
            'idLT' => $idLT,
            'listTin' => $listTin,
        ];
        return view('tintrongloai', $data);
    }
}
