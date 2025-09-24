<?php

namespace App\Http\Controllers;

use App\Models\OrderCoupon;
use Illuminate\Http\Request;
use Exception;


class OrderCouponController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(OrderCoupon::class, 'ordercoupon');
    }

    public function index()
    {
        try {
            $ordercoupons = OrderCoupon::paginate(10);
            return response()->json([
                'data' => $ordercoupons->items(),
                'meta' => [
                    'current_page' => $ordercoupons->currentPage(),
                    'last_page' => $ordercoupons->lastPage(),
                    'per_page' => $ordercoupons->perPage(),
                    'total' => $ordercoupons->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(OrderCoupon $ordercoupon)
    {
        try {
            return response()->json($ordercoupon);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'coupon_id' => 'required|exists:coupons,id'
        ]);
            
            $ordercoupon = OrderCoupon::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $ordercoupon], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, OrderCoupon $ordercoupon)
    {
        try {
            $data = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'coupon_id' => 'sometimes|exists:coupons,id'
        ]);
            
            $ordercoupon->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $ordercoupon]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(OrderCoupon $ordercoupon)
    {
        try {
            $ordercoupon->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
