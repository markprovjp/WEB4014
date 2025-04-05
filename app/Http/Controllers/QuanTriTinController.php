<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuanTriTinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        echo '<h1>Danh sách tin tức</h1>';
    }
}
