<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAll(){
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function getOne($id){
        $product = Product::findOrFail($id);
        return response()->json($product, 200);
    }

    public function create(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'required'
        ]);
        $newProduct = Product::create($data);

        return response()->json($newProduct, 201);
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'required'
        ]);
        $product->update($data);

        return response()->json($product);
    }

    public function delete($id){
        try{

        }
        catch(Exception $e){

        }
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json('Delete successfully', 204);
    }
}