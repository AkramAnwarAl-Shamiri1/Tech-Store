<?php

namespace App\Http\Controllers;

use App\Models\ProductTag;
use Illuminate\Http\Request;
use Exception;


class ProductTagController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(ProductTag::class, 'producttag');
    }

    public function index()
    {
        try {
            $producttags = ProductTag::paginate(10);
            return response()->json([
                'data' => $producttags->items(),
                'meta' => [
                    'current_page' => $producttags->currentPage(),
                    'last_page' => $producttags->lastPage(),
                    'per_page' => $producttags->perPage(),
                    'total' => $producttags->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(ProductTag $producttag)
    {
        try {
            return response()->json($producttag);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'tag' => 'required|string'
        ]);
            
            $producttag = ProductTag::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $producttag], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, ProductTag $producttag)
    {
        try {
            $data = $request->validate([
            'product_id' => 'sometimes|exists:products,id',
            'tag' => "sometimes|string"
        ]);
            
            $producttag->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $producttag]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(ProductTag $producttag)
    {
        try {
            $producttag->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
