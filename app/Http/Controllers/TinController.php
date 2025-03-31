<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tin;
class TinController extends Controller
{
    public function index()
    {
        $listTin = Tin::all();
        return view('tin/danhsach', ['listTin' => $listTin]);
    }
    public function them()
    {
        return view('tin/them');
    }
    public function luu(Request $request)
    {
        $tin = new Tin();
        $tin->tieuDe = $request->input('tieuDe');
        $tin->tomTat = $request->input('tomtat');
        $tin->ngayDang = now();
        $tin->noiDung = $request->input('noiDung');
        $tin->idLT = 1;
        $tin->xem = 0;
        
        $tin->tinNoiBat = $request->has('tinNoiBat') ? 1 : 0;
        $tin->anHien = $request->has('anHien') ? 1 : 0;
        
        $tin->tags = $request->input('tags', '');
        $tin->lang = $request->input('lang', 'vn');
        
        if ($request->hasFile('urlHinh')) {
            $path = $request->file('urlHinh')->store('images', 'private');
            $tin->urlHinh = $path; 
        }
        
        $tin->save();
        return redirect('/tin/ds')->with('success', 'Thêm mới thành công');
    }
    
    public function xoa($id )
    {
        $tin = Tin::find($id);
        if ($tin) {
            $tin->delete();
            return redirect('/tin/ds')->with('success', 'Xóa thành công');
        } else {
            return redirect('/tin/ds')->with('error', 'Không tìm thấy tin tức');
        }
    }

    public function sua($id = 0)
    {
        $tin = Tin::find($id);
        if ($tin) {
            return view('tin/sua', ['tin' => $tin]);
        } else {
            return redirect('/tin/ds')->with('error', 'Không tìm thấy tin tức');
        }
    }
   
public function capnhat(Request $request, $id = 0)
{
    $tin = Tin::find($id);
    if ($tin) {
        
        $tin->tieuDe = $request->input('tieuDe');
        $tin->tomTat = $request->input('tomtat');
        if ($request->hasFile('urlHinh')) {
            // Store in private directory
            $path = $request->file('urlHinh')->store('images', 'private');
            $tin->urlHinh = $path; 
        }
        $tin->ngayDang = now();
        $tin->noiDung = $request->input('noiDung');
        $tin->idLT = 1;
        $tin->xem = $request->input('xem', 0);
        
        $tin->tinNoiBat = $request->has('tinNoiBat') ? 1 : 0;
        $tin->anHien = $request->has('anHien') ? 1 : 0;
        
        $tin->tags = $request->input('tags', '');
        $tin->lang = $request->input('lang', 'vn');
        
        $tin->save();
        return redirect('/tin/ds')->with('success', 'Cập nhật thành công');
    } else {
        return redirect('/tin/ds')->with('error', 'Không tìm thấy tin tức');
    }
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
