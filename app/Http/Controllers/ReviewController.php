<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Exception;


class ReviewController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Review::class, 'review');
    }

    public function index()
    {
        try {
            $reviews = Review::paginate(10);
            return response()->json([
                'data' => $reviews->items(),
                'meta' => [
                    'current_page' => $reviews->currentPage(),
                    'last_page' => $reviews->lastPage(),
                    'per_page' => $reviews->perPage(),
                    'total' => $reviews->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Review $review)
    {
        try {
            return response()->json($review);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|string',
            'comment' => 'required|string'
        ]);
            
            $review = Review::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $review], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Review $review)
    {
        try {
            $data = $request->validate([
            'product_id' => 'sometimes|exists:products,id',
            'user_id' => 'sometimes|exists:users,id',
            'rating' => "sometimes|string",
            'comment' => "sometimes|string"
        ]);
            
            $review->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $review]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Review $review)
    {
        try {
            $review->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
