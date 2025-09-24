<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Exception;


class SettingController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Setting::class, 'setting');
    }

    public function index()
    {
        try {
            $settings = Setting::paginate(10);
            return response()->json([
                'data' => $settings->items(),
                'meta' => [
                    'current_page' => $settings->currentPage(),
                    'last_page' => $settings->lastPage(),
                    'per_page' => $settings->perPage(),
                    'total' => $settings->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Setting $setting)
    {
        try {
            return response()->json($setting);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'key' => 'required|string',
            'value' => 'required|string'
        ]);
            
            $setting = Setting::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $setting], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Setting $setting)
    {
        try {
            $data = $request->validate([
            'key' => "sometimes|string",
            'value' => "sometimes|string"
        ]);
            
            $setting->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $setting]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Setting $setting)
    {
        try {
            $setting->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
