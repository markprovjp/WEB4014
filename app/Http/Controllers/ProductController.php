<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $arr = [
            'status' => 'success',
            'message' => 'Danh sách sản phẩm',
            'data' => ProductResource::collection($products)
        ];  
        return response()->json($arr, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create($request->all());
        $arr = [
            'status' => 'success',
            'message' => 'Sản phẩm được lưu thành công',
            'data' => new ProductResource($product)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $arr = [
            'status' => 'success',
            'message' => 'Chi tiết sản phẩm',
            'data' => new ProductResource($product)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::findOrFail($id);
        $product->update($request->all());
        
        $arr = [
            'status' => 'success',
            'message' => 'Sản phẩm được cập nhật thành công',
            'data' => new ProductResource($product)
        ];
        return response()->json($arr, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $arr = [
            'status' => 'success',
            'message' => 'Sản phẩm đã được xóa thành công',
        ];
        return response()->json($arr, 200);
    }
}
