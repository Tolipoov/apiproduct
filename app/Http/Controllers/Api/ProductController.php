<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully.',
            'data' => $products
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'quantity' => 'required|numeric',
            'price' => 'required|decimal:0,2',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $validator->errors(),  
                    'data' => $validator->errors()
                ], 201
            );
        }

         $inputData = array(
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description
         );
         $product = Product::create($inputData); 
         return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
            'data' => $product
         ], 204);
  
    }   

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|unique:products,name',
            'quantity' => 'required|numeric',
            'price' => 'required|decimal:0,2',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $validator->errors(),  
                    'data' => $validator->errors()
                ], 201
            );
        }

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

         return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data' => $product
         ], 205);
  
    }   

    public function delete(Request $request){
        $product = Product::find($request->id);
        $product->delete();
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.',
            'data' => $product
        ], 200);
    }
}
