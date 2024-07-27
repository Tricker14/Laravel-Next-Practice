<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class OrderService {
    public function index(){
        $Orders = Order::all();
        return $Orders;
    }

    public function show($id){
        $Order = Order::find($id);
        if(! $Order){
            throw new Exception('Order not found');
        }
        return $Order;
    }


    public function store(Request $request){
        $data = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'address' => 'required',
            'total_amount' => 'required',
            'notes' => 'required',
        ]);
        $existingOrder = Order::where('product_id', $data['product_id'])->first();
        if($existingOrder){
            throw new Exception('Invalid order');
        }

        $newOrder = Order::create($data);

        return $newOrder;
    }

    public function update(Request $request, $id){
        $Order = Order::findOrFail($id);

        $data = $request->validate([
            'name' => 'required'
        ]);
        $Order->update($data);

        return $Order;
    }

    public function destroy($id){
        $Order = Order::find($id);
        if(! $Order){
            throw new Exception('Order not found');
        }
        $Order->delete();
    }
}