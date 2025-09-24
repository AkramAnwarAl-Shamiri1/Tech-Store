<?php

namespace App\Http\Controllers;

use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Exception;


class OrderStatusHistoryController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(OrderStatusHistory::class, 'orderstatushistory');
    }

    public function index()
    {
        try {
            $orderstatushistorys = OrderStatusHistory::paginate(10);
            return response()->json([
                'data' => $orderstatushistorys->items(),
                'meta' => [
                    'current_page' => $orderstatushistorys->currentPage(),
                    'last_page' => $orderstatushistorys->lastPage(),
                    'per_page' => $orderstatushistorys->perPage(),
                    'total' => $orderstatushistorys->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(OrderStatusHistory $orderstatushistory)
    {
        try {
            return response()->json($orderstatushistory);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|string',
            'changed_at' => 'required|string'
        ]);
            
            $orderstatushistory = OrderStatusHistory::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $orderstatushistory], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, OrderStatusHistory $orderstatushistory)
    {
        try {
            $data = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'status' => "sometimes|string",
            'changed_at' => "sometimes|string"
        ]);
            
            $orderstatushistory->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $orderstatushistory]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(OrderStatusHistory $orderstatushistory)
    {
        try {
            $orderstatushistory->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
