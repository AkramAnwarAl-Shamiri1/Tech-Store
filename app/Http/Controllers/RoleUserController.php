<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use Illuminate\Http\Request;
use Exception;


class RoleUserController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(RoleUser::class, 'roleuser');
    }

    public function index()
    {
        try {
            $roleusers = RoleUser::paginate(10);
            return response()->json([
                'data' => $roleusers->items(),
                'meta' => [
                    'current_page' => $roleusers->currentPage(),
                    'last_page' => $roleusers->lastPage(),
                    'per_page' => $roleusers->perPage(),
                    'total' => $roleusers->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(RoleUser $roleuser)
    {
        try {
            return response()->json($roleuser);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id'
        ]);
            
            $roleuser = RoleUser::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $roleuser], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, RoleUser $roleuser)
    {
        try {
            $data = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'role_id' => 'sometimes|exists:roles,id'
        ]);
            
            $roleuser->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $roleuser]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(RoleUser $roleuser)
    {
        try {
            $roleuser->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
