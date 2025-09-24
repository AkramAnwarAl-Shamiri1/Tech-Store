<?php

namespace App\Http\Controllers;

use App\Models\StockHistory;
use Illuminate\Http\Request;
use Exception;


class StockHistoryController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(StockHistory::class, 'stockhistory');
    }

    public function index()
    {
        try {
            $stockhistorys = StockHistory::paginate(10);
            return response()->json([
                'data' => $stockhistorys->items(),
                'meta' => [
                    'current_page' => $stockhistorys->currentPage(),
                    'last_page' => $stockhistorys->lastPage(),
                    'per_page' => $stockhistorys->perPage(),
                    'total' => $stockhistorys->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(StockHistory $stockhistory)
    {
        try {
            return response()->json($stockhistory);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'change' => 'required|integer',
            'reason' => 'nullable|string'
        ]);
            
            $stockhistory = StockHistory::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $stockhistory], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, StockHistory $stockhistory)
    {
        try {
            $data = $request->validate([
            'product_id' => 'sometimes|exists:products,id',
            'change' => 'sometimes|integer',
            'reason' => "nullable|string"
        ]);
            
            $stockhistory->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $stockhistory]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(StockHistory $stockhistory)
    {
        try {
            $stockhistory->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
