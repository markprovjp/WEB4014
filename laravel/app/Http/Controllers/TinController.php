<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function lienHe()
    {
        return view('lienHe');
    }

    public function show($id)
    {
        return view('show', ['id' => $id]);
    }
}
