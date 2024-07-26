<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(){
        $products = $this->productService->index();
        return response()->json($products, 200);
    }

    public function show($id){
        try{
            $product = $this->productService->show($id);
            return response()->json($product, 200);
        }
        catch(Exception $e){
            return response()->json($e->getMessage(), 404);
        }
    }

    public function store(Request $request){
        try{
            $newProduct = $this->productService->store($request);
            return response()->json($newProduct, 201);
        }
        catch(Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id){
        try{
            $product = $this->productService->update($request, $id);
            return response()->json($product);
        }
        catch(Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy($id){
        try{
            $this->productService->destroy($id);
            return response()->json('Delete successfully', 200);
        }
        catch(Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }
}