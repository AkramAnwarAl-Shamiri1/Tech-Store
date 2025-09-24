<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Exception;


class VendorController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Vendor::class, 'vendor');
    }

    public function index()
    {
        try {
            $vendors = Vendor::paginate(10);
            return response()->json([
                'data' => $vendors->items(),
                'meta' => [
                    'current_page' => $vendors->currentPage(),
                    'last_page' => $vendors->lastPage(),
                    'per_page' => $vendors->perPage(),
                    'total' => $vendors->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Vendor $vendor)
    {
        try {
            return response()->json($vendor);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'store_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|string'
        ]);
            
            $vendor = Vendor::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $vendor], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Vendor $vendor)
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'store_name' => "sometimes|string",
            'phone' => "sometimes|string",
            'address' => "sometimes|string",
            'description' => "nullable|string",
            'logo' => "nullable|string"
        ]);
            
            $vendor->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $vendor]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Vendor $vendor)
    {
        try {
            $vendor->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
