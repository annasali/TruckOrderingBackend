<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // public function store(Request $request)
    // {
    //     $order = Order::create($request->all());
    //     Notification::send(User::where('is_admin', true)->get(), new NewOrderNotification($order));
    //     return response()->json(['order' => $order], 201);
    // }

    // public function index()
    // {
    //     return response()->json(Order::all());
    // }
    public function show()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'pickup_location' => 'required',
            'delivery_location' => 'required',
            'size' => 'required',
            'weight' => 'required',
            'pickup_time' => 'required|date',
            'delivery_time' => 'required|date',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'pickup_location' => $request->pickup_location,
            'delivery_location' => $request->delivery_location,
            'size' => $request->size,
            'weight' => $request->weight,
            'pickup_time' => $request->pickup_time,
            'delivery_time' => $request->delivery_time,
        ]);
        
        // $order = Order::create($request->all());
        // Notification::send(User::where('is_admin', true)->get(), new NewOrderNotification($order));

        return response()->json($order);
    }

    public function index()
    {
        return response()->json(Order::where('user_id', auth()->id())->get());
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        return response()->json($order);
    }
}
