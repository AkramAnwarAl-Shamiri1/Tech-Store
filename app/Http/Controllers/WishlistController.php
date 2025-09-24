<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Exception;


class WishlistController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Wishlist::class, 'wishlist');
    }

    public function index()
    {
        try {
            $wishlists = Wishlist::paginate(10);
            return response()->json([
                'data' => $wishlists->items(),
                'meta' => [
                    'current_page' => $wishlists->currentPage(),
                    'last_page' => $wishlists->lastPage(),
                    'per_page' => $wishlists->perPage(),
                    'total' => $wishlists->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Wishlist $wishlist)
    {
        try {
            return response()->json($wishlist);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id'
        ]);
            
            $wishlist = Wishlist::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $wishlist], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Wishlist $wishlist)
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'product_id' => 'sometimes|exists:products,id'
        ]);
            
            $wishlist->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $wishlist]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Wishlist $wishlist)
    {
        try {
            $wishlist->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
