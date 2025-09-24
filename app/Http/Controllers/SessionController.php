<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Exception;


class SessionController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Session::class, 'session');
    }

    public function index()
    {
        try {
            $sessions = Session::paginate(10);
            return response()->json([
                'data' => $sessions->items(),
                'meta' => [
                    'current_page' => $sessions->currentPage(),
                    'last_page' => $sessions->lastPage(),
                    'per_page' => $sessions->perPage(),
                    'total' => $sessions->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Session $session)
    {
        try {
            return response()->json($session);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ip_address' => 'required|string',
            'user_agent' => 'required|string',
            'payload' => 'required|string',
            'last_activity' => 'required|string'
        ]);
            
            $session = Session::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $session], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Session $session)
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'ip_address' => "sometimes|string",
            'user_agent' => "sometimes|string",
            'payload' => "sometimes|string",
            'last_activity' => "sometimes|string"
        ]);
            
            $session->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $session]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Session $session)
    {
        try {
            $session->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
