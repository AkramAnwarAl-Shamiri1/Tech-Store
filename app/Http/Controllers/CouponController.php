<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Exception;


class CouponController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Coupon::class, 'coupon');
    }

    public function index()
    {
        try {
            $coupons = Coupon::paginate(10);
            return response()->json([
                'data' => $coupons->items(),
                'meta' => [
                    'current_page' => $coupons->currentPage(),
                    'last_page' => $coupons->lastPage(),
                    'per_page' => $coupons->perPage(),
                    'total' => $coupons->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Coupon $coupon)
    {
        try {
            return response()->json($coupon);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'code' => 'required|string',
            'discount' => 'required|numeric',
            'expires_at' => 'required|string'
        ]);
            
            $coupon = Coupon::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $coupon], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Coupon $coupon)
    {
        try {
            $data = $request->validate([
            'code' => "sometimes|string",
            'discount' => 'sometimes|numeric',
            'expires_at' => "sometimes|string"
        ]);
            
            $coupon->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $coupon]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
