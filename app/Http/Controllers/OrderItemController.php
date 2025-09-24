<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Exception;


class OrderItemController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(OrderItem::class, 'orderitem');
    }

    public function index()
    {
        try {
            $orderitems = OrderItem::paginate(10);
            return response()->json([
                'data' => $orderitems->items(),
                'meta' => [
                    'current_page' => $orderitems->currentPage(),
                    'last_page' => $orderitems->lastPage(),
                    'per_page' => $orderitems->perPage(),
                    'total' => $orderitems->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(OrderItem $orderitem)
    {
        try {
            return response()->json($orderitem);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric'
        ]);
            
            $orderitem = OrderItem::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $orderitem], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, OrderItem $orderitem)
    {
        try {
            $data = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'product_id' => 'sometimes|exists:products,id',
            'quantity' => 'sometimes|integer',
            'price' => 'sometimes|numeric'
        ]);
            
            $orderitem->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $orderitem]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(OrderItem $orderitem)
    {
        try {
            $orderitem->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
