<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends  BaseController
{
    public function __construct()
    {
       
        //$this->authorizeResource(Product::class, 'product');
    }


    public function index()
    {
        try {
            $products = Product::with(['files', 'category', 'user'])->paginate(10);

            return response()->json([
                'data' => $products->items(),
                'meta' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'فشل في جلب البيانات',
                'error' => $e->getMessage()
            ], 500);
        }
    }

 
    public function show(Product $product)
    {
        try {
            return response()->json($product->load(['files', 'category', 'user']));
        } catch (Exception $e) {
            return response()->json([
                'message' => 'فشل في جلب البيانات',
                'error' => $e->getMessage()
            ], 500);
        }
    }

   
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        try {
            $data = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'user_id' => 'required|exists:users,id',
                'name' => 'required|string',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'sku' => 'nullable|string',
                'files.*' => 'nullable|file|max:51200', 
            ]);

            $product = Product::create($data);

           
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $uploadedFile) {
                    $path = $uploadedFile->store('products', 'public');

                    $product->files()->create([
                        'type' => $uploadedFile->getClientMimeType(),
                        'file_path' => $path,
                        'title' => $uploadedFile->getClientOriginalName(),
                    ]);
                }
            }

            return response()->json([
                'message' => 'تم الإنشاء بنجاح',
                'data' => $product->load('files')
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'فشل في الإنشاء',
                'error' => $e->getMessage()
            ], 500);
        }
    }

   
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        try {
            $data = $request->validate([
                'category_id' => 'sometimes|exists:categories,id',
                'user_id' => 'sometimes|exists:users,id',
                'name' => 'sometimes|string',
                'description' => 'nullable|string',
                'price' => 'sometimes|numeric',
                'stock' => 'sometimes|integer',
                'sku' => 'sometimes|string',
                'files.*' => 'nullable|file|max:51200',
            ]);

            $product->update($data);

           
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $uploadedFile) {
                    $path = $uploadedFile->store('products', 'public');

                    $product->files()->create([
                        'type' => $uploadedFile->getClientMimeType(),
                        'file_path' => $path,
                        'title' => $uploadedFile->getClientOriginalName(),
                    ]);
                }
            }

            return response()->json([
                'message' => 'تم التحديث بنجاح',
                'data' => $product->load('files')
            ]);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'فشل في التحديث',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        try {
         
            foreach ($product->files as $file) {
                Storage::disk('public')->delete($file->file_path);
            }

           
            $product->files()->delete();

            $product->delete();

            return response()->json(['message' => 'تم حذف المنتج والملفات الخاصة به']);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'فشل في الحذف',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
    public function destroyFile(Product $product, $fileId)
    {
        $this->authorize('update', $product);

        try {
            $file = $product->files()->findOrFail($fileId);

            Storage::disk('public')->delete($file->file_path);
            $file->delete();

            return response()->json(['message' => 'تم حذف الملف بنجاح']);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'فشل في حذف الملف',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
