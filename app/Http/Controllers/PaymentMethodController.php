<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Exception;


class PaymentMethodController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(PaymentMethod::class, 'paymentmethod');
    }

    public function index()
    {
        try {
            $paymentmethods = PaymentMethod::paginate(10);
            return response()->json([
                'data' => $paymentmethods->items(),
                'meta' => [
                    'current_page' => $paymentmethods->currentPage(),
                    'last_page' => $paymentmethods->lastPage(),
                    'per_page' => $paymentmethods->perPage(),
                    'total' => $paymentmethods->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(PaymentMethod $paymentmethod)
    {
        try {
            return response()->json($paymentmethod);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'name' => 'required|string'
        ]);
            
            $paymentmethod = PaymentMethod::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $paymentmethod], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, PaymentMethod $paymentmethod)
    {
        try {
            $data = $request->validate([
            'name' => "sometimes|string"
        ]);
            
            $paymentmethod->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $paymentmethod]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(PaymentMethod $paymentmethod)
    {
        try {
            $paymentmethod->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
