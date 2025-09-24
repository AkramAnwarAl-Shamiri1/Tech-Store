<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Exception;


class CategoryController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    public function index()
    {
        try {
            $categorys = Category::paginate(10);
            return response()->json([
                'data' => $categorys->items(),
                'meta' => [
                    'current_page' => $categorys->currentPage(),
                    'last_page' => $categorys->lastPage(),
                    'per_page' => $categorys->perPage(),
                    'total' => $categorys->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Category $category)
    {
        try {
            return response()->json($category);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'nullable|string',
            'description' => 'nullable|string'
        ]);
            
            $category = Category::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $category], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Category $category)
    {
        try {
            $data = $request->validate([
            'name' => "sometimes|string",
            'slug' => "nullable|string",
            'description' => "nullable|string"
        ]);
            
            $category->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $category]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
