<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Exception;


class CartController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Cart::class, 'cart');
    }

    public function index()
    {
        try {
            $carts = Cart::paginate(10);
            return response()->json([
                'data' => $carts->items(),
                'meta' => [
                    'current_page' => $carts->currentPage(),
                    'last_page' => $carts->lastPage(),
                    'per_page' => $carts->perPage(),
                    'total' => $carts->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Cart $cart)
    {
        try {
            return response()->json($cart);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
            
            $cart = Cart::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $cart], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Cart $cart)
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id'
        ]);
            
            $cart->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $cart]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Cart $cart)
    {
        try {
            $cart->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
