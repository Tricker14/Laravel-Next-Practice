<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class ProductService {
    public function index(){
        $products = Product::all();
        return $products;
    }

    public function show($id){
        $product = Product::find($id);
        if(! $product){
            throw new Exception('Product not found');
        }
        return $product;
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'required',
            'image_url' => 'nullable'
        ]);
        $existingProduct = Product::where('name', $data['name'])->first();
        if($existingProduct){
            throw new Exception('Product with this name already exists');
        }

        if($request->hasFile('image_url')){
            $storedPath = $request->file('image_url')->store('images', 'public');
            $data['image_url'] = $storedPath;
        }
        else{
            $data['image_url'] = null;
        }
        $newProduct = Product::create($data);

        return $newProduct;
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'required',
            'image_url' => 'nullable'
        ]);
        $product->update($data);

        return $product;
    }

    public function destroy($id){
        $product = Product::find($id);
        if(! $product){
            throw new Exception('Product not found');
        }
        $product->delete();
    }
}