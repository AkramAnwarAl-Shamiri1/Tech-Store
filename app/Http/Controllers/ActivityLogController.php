<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Exception;


class ActivityLogController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(ActivityLog::class, 'activitylog');
    }

    public function index()
    {
        try {
            $activitylogs = ActivityLog::paginate(10);
            return response()->json([
                'data' => $activitylogs->items(),
                'meta' => [
                    'current_page' => $activitylogs->currentPage(),
                    'last_page' => $activitylogs->lastPage(),
                    'per_page' => $activitylogs->perPage(),
                    'total' => $activitylogs->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(ActivityLog $activitylog)
    {
        try {
            return response()->json($activitylog);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'action' => 'required|string',
            'description' => 'nullable|string'
        ]);
            
            $activitylog = ActivityLog::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $activitylog], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, ActivityLog $activitylog)
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'action' => "sometimes|string",
            'description' => "nullable|string"
        ]);
            
            $activitylog->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $activitylog]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(ActivityLog $activitylog)
    {
        try {
            $activitylog->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
