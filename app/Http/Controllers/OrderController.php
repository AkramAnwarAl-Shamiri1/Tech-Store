<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Exception;


class OrderController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    public function index()
    {
        try {
            $orders = Order::paginate(10);
            return response()->json([
                'data' => $orders->items(),
                'meta' => [
                    'current_page' => $orders->currentPage(),
                    'last_page' => $orders->lastPage(),
                    'per_page' => $orders->perPage(),
                    'total' => $orders->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Order $order)
    {
        try {
            return response()->json($order);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'total' => 'required|numeric',
            'status' => 'required|string'
        ]);
            
            $order = Order::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $order], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Order $order)
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'shipping_method_id' => 'sometimes|exists:shipping_methods,id',
            'payment_method_id' => 'sometimes|exists:payment_methods,id',
            'total' => 'sometimes|numeric',
            'status' => "sometimes|string"
        ]);
            
            $order->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $order]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
