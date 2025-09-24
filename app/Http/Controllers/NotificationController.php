<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Exception;

class NotificationController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Notification::class, 'notification');
    }


    public function index(Request $request)
    {
        try {
            $user = $request->user();

            if ($user->role_id == 1) {
               
                $notifications = Notification::orderBy('created_at', 'desc')->paginate(10);
            } else {
              
                $notifications = Notification::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            }

            return response()->json([
                'data' => $notifications->items(),
                'meta' => [
                    'current_page' => $notifications->currentPage(),
                    'last_page' => $notifications->lastPage(),
                    'per_page' => $notifications->perPage(),
                    'total' => $notifications->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    
    public function show(Notification $notification)
    {
        return response()->json($notification);
    }

   
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'type'    => 'required|string',
            'message' => 'required|string',
            'read'    => 'sometimes|boolean',
            'url'     => 'sometimes|string|nullable',
            'icon'    => 'sometimes|string|nullable',
            'priority'=> 'sometimes|string|in:low,medium,high',
        ]);

        try {
            $notification = Notification::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $notification], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    
    public function update(Request $request, Notification $notification)
    {
        $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'type'    => 'sometimes|string',
            'message' => 'sometimes|string',
            'read'    => 'sometimes|boolean',
            'url'     => 'sometimes|string|nullable',
            'icon'    => 'sometimes|string|nullable',
            'priority'=> 'sometimes|string|in:low,medium,high',
        ]);

        try {
            $notification->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $notification]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

   
    public function destroy(Notification $notification)
    {
        try {
            $notification->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }

   
    public function unread(Request $request)
    {
        try {
            $user = $request->user();

            if ($user->role_id == 1) {
              
                $notifications = Notification::where('read', false)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            } else {
               
                $notifications = Notification::where('user_id', $user->id)
                    ->where('read', false)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            }

            return response()->json([
                'data' => $notifications->items(),
                'meta' => [
                    'current_page' => $notifications->currentPage(),
                    'last_page' => $notifications->lastPage(),
                    'per_page' => $notifications->perPage(),
                    'total' => $notifications->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

   
    public function markAsRead(Notification $notification)
    {
        try {
            $notification->update(['read' => true]);
            return response()->json(['message' => 'تم تمييز الإشعار كمقروء', 'data' => $notification]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }
}
