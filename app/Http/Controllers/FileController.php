<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Exception;

class FileController extends  BaseController
{
    public function __construct()
    {
        // إذا حبيت تستخدم Policies
        $this->authorizeResource(File::class, 'file');
    }

    // عرض جميع الملفات مع Pagination
    public function index()
    {
        try {
            $files = File::paginate(10);
            return response()->json([
                'data' => $files->items(),
                'meta' => [
                    'current_page' => $files->currentPage(),
                    'last_page' => $files->lastPage(),
                    'per_page' => $files->perPage(),
                    'total' => $files->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب الملفات', 'error' => $e->getMessage()], 500);
        }
    }

    // عرض ملف واحد
    public function show(File $file)
    {
        return response()->json($file);
    }

    // إنشاء ملف جديد (رفع ملف فعلي)
    public function store(Request $request)
    {
        $data = $request->validate([
            'fileable_type' => 'required|string',
            'fileable_id'   => 'required|integer',
            'type'          => 'required|string',
            'file'          => 'required|file', // ← الملف نفسه
            'title'         => 'nullable|string'
        ]);

        try {
            // تخزين الملف في مجلد مخصص داخل public storage
            $path = $request->file('file')->store('uploads', 'public');

            // إنشاء السجل في قاعدة البيانات
            $file = File::create([
                'fileable_type' => $data['fileable_type'],
                'fileable_id'   => $data['fileable_id'],
                'type'          => $data['type'],
                'file_path'     => $path,
                'title'         => $data['title'] ?? null,
            ]);

            return response()->json([
                'message' => 'تم رفع الملف بنجاح',
                'data'    => $file
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'فشل في رفع الملف',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // تحديث ملف (تغيير بياناته أو رفع ملف جديد)
    public function update(Request $request, File $file)
    {
        $data = $request->validate([
            'type'  => 'sometimes|string',
            'file'  => 'sometimes|file', // ← إذا حابب ترفع ملف جديد
            'title' => 'nullable|string'
        ]);

        try {
            // إذا رفع ملف جديد نحدث المسار
            if ($request->hasFile('file')) {
                $path = $request->file('file')->store('uploads', 'public');
                $data['file_path'] = $path;
            }

            $file->update($data);

            return response()->json([
                'message' => 'تم تحديث الملف بنجاح',
                'data'    => $file
            ]);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'فشل في التحديث',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // حذف ملف
    public function destroy(File $file)
    {
        try {
            $file->delete();
            return response()->json(['message' => 'تم حذف الملف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
