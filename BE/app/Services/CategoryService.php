<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Exception;

class CategoryService {
    public function index(){
        $Categorys = Category::all();
        return $Categorys;
    }

    public function show($id){
        $Category = Category::find($id);
        if(! $Category){
            throw new Exception('Category not found');
        }
        return $Category;
    }


    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
        ]);
        $existingCategory = Category::where('name', $data['name'])->first();
        if($existingCategory){
            throw new Exception('Category with this name already exists');
        }

        $newCategory = Category::create($data);

        return $newCategory;
    }

    public function update(Request $request, $id){
        $Category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required'
        ]);
        $Category->update($data);

        return $Category;
    }

    public function destroy($id){
        $Category = Category::find($id);
        if(! $Category){
            throw new Exception('Category not found');
        }
        $Category->delete();
    }
}