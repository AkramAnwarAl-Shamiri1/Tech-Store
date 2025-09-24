<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Exception;


class ShippingMethodController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(ShippingMethod::class, 'shippingmethod');
    }

    public function index()
    {
        try {
            $shippingmethods = ShippingMethod::paginate(10);
            return response()->json([
                'data' => $shippingmethods->items(),
                'meta' => [
                    'current_page' => $shippingmethods->currentPage(),
                    'last_page' => $shippingmethods->lastPage(),
                    'per_page' => $shippingmethods->perPage(),
                    'total' => $shippingmethods->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(ShippingMethod $shippingmethod)
    {
        try {
            return response()->json($shippingmethod);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'name' => 'required|string',
            'cost' => 'required|numeric'
        ]);
            
            $shippingmethod = ShippingMethod::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $shippingmethod], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, ShippingMethod $shippingmethod)
    {
        try {
            $data = $request->validate([
            'name' => "sometimes|string",
            'cost' => 'sometimes|numeric'
        ]);
            
            $shippingmethod->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $shippingmethod]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(ShippingMethod $shippingmethod)
    {
        try {
            $shippingmethod->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
