<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Exception;


class CartItemController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(CartItem::class, 'cartitem');
    }

    public function index()
    {
        try {
            $cartitems = CartItem::paginate(10);
            return response()->json([
                'data' => $cartitems->items(),
                'meta' => [
                    'current_page' => $cartitems->currentPage(),
                    'last_page' => $cartitems->lastPage(),
                    'per_page' => $cartitems->perPage(),
                    'total' => $cartitems->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(CartItem $cartitem)
    {
        try {
            return response()->json($cartitem);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer'
        ]);
            
            $cartitem = CartItem::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $cartitem], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, CartItem $cartitem)
    {
        try {
            $data = $request->validate([
            'cart_id' => 'sometimes|exists:carts,id',
            'product_id' => 'sometimes|exists:products,id',
            'quantity' => 'sometimes|integer'
        ]);
            
            $cartitem->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $cartitem]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(CartItem $cartitem)
    {
        try {
            $cartitem->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
