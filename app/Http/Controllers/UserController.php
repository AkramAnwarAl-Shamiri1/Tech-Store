<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        try {
            $users = User::paginate(10);
            return response()->json([
                'data' => $users->items(),
                'meta' => [
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'per_page' => $users->perPage(),
                    'total' => $users->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(User $user)
    {
        try {
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);
            if(isset($data['password'])) { $data['password'] = Hash::make($data['password']); }
            $user = User::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $user], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $data = $request->validate([
            'name' => "sometimes|string",
            'email' => "sometimes|email|unique:users,email,' . $user->id",
            'password' => 'sometimes|string|min:6',
            'role_id' => 'sometimes|exists:roles,id'
        ]);
            if(isset($data['password'])) { $data['password'] = Hash::make($data['password']); }
            $user->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $user]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
