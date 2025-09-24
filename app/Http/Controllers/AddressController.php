<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Exception;


class AddressController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Address::class, 'address');
    }

    public function index()
    {
        try {
            $addresss = Address::paginate(10);
            return response()->json([
                'data' => $addresss->items(),
                'meta' => [
                    'current_page' => $addresss->currentPage(),
                    'last_page' => $addresss->lastPage(),
                    'per_page' => $addresss->perPage(),
                    'total' => $addresss->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Address $address)
    {
        try {
            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'address_line' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string'
        ]);
            
            $address = Address::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $address], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Address $address)
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'address_line' => "sometimes|string",
            'city' => "sometimes|string",
            'state' => "sometimes|string",
            'postal_code' => "sometimes|string",
            'country' => "sometimes|string"
        ]);
            
            $address->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $address]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Address $address)
    {
        try {
            $address->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
