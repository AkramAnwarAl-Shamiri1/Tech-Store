<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Exception;


class PaymentController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Payment::class, 'payment');
    }

    public function index()
    {
        try {
            $payments = Payment::paginate(10);
            return response()->json([
                'data' => $payments->items(),
                'meta' => [
                    'current_page' => $payments->currentPage(),
                    'last_page' => $payments->lastPage(),
                    'per_page' => $payments->perPage(),
                    'total' => $payments->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Payment $payment)
    {
        try {
            return response()->json($payment);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'status' => 'required|string'
        ]);
            
            $payment = Payment::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $payment], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Payment $payment)
    {
        try {
            $data = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'amount' => 'sometimes|numeric',
            'status' => "sometimes|string"
        ]);
            
            $payment->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $payment]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Payment $payment)
    {
        try {
            $payment->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
