<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $CategoryService;

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }

    public function index(){
        $Categorys = $this->CategoryService->index();
        return response()->json($Categorys, 200);
    }

    public function show($id){
        try{
            $Category = $this->CategoryService->show($id);
            return response()->json($Category, 200);
        }
        catch(Exception $e){
            return response()->json($e->getMessage(), 404);
        }
    }

    public function store(Request $request){
        try{
            $newCategory = $this->CategoryService->store($request);
            return response()->json($newCategory, 201);
        }
        catch(Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, $id){
        try{
            $Category = $this->CategoryService->update($request, $id);
            return response()->json($Category);
        }
        catch(Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy($id){
        try{
            $this->CategoryService->destroy($id);
            return response()->json('Delete successfully', 200);
        }
        catch(Exception $e){
            return response()->json($e->getMessage(), 400);
        }
    }
}
