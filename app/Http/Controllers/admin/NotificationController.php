<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Tambahkan logika untuk menampilkan notifikasi
        return view('admin.notifications.index');
    }

    /**
     * Store a new notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Tambahkan logika untuk menyimpan notifikasi baru
        // ...

        return redirect()->back()->with('success', 'Thông báo tạo thành công');
    }

    /**
     * Remove the specified notification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Tambahkan logika untuk menghapus notifikasi
        // ...

        return redirect()->back()->with('success', 'Thông báo đã xóa thành công');
    }
}