<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $arr = [
            'status' => 'success',
            'message' => 'Danh sách loại sản phẩm',
            'data' => CategoryResource::collection($categories)
        ];  
        return response()->json($arr, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ten' => 'required|max:255',
            'mota' => 'required',
            'trangthai' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create($request->all());
        $arr = [
            'status' => 'success',
            'message' => 'Loại sản phẩm được lưu thành công',
            'data' => new CategoryResource($category)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        $arr = [
            'status' => 'success',
            'message' => 'Chi tiết loại sản phẩm',
            'data' => new CategoryResource($category)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'ten' => 'required|max:255',
            'mota' => 'required',
            'trangthai' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::findOrFail($id);
        $category->update($request->all());
        
        $arr = [
            'status' => 'success',
            'message' => 'Loại sản phẩm được cập nhật thành công',
            'data' => new CategoryResource($category)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        $arr = [
            'status' => 'success',
            'message' => 'Loại sản phẩm đã được xóa thành công',
        ];
        return response()->json($arr, 200);
    }
}
