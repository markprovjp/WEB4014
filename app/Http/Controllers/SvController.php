<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RuleNhapSV;
class SvController extends Controller
{
    public function sv(){
        return view("nhapsv");
        }
        function sv_store(RuleNhapSV $request){
        echo "Code xử lý lưu thông tin sinh viên";
        }
}
