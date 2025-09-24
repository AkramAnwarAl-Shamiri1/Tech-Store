<?php

namespace App\Http\Controllers;

use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;
use Exception;


class PersonalAccessTokenController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(PersonalAccessToken::class, 'personalaccesstoken');
    }

    public function index()
    {
        try {
            $personalaccesstokens = PersonalAccessToken::paginate(10);
            return response()->json([
                'data' => $personalaccesstokens->items(),
                'meta' => [
                    'current_page' => $personalaccesstokens->currentPage(),
                    'last_page' => $personalaccesstokens->lastPage(),
                    'per_page' => $personalaccesstokens->perPage(),
                    'total' => $personalaccesstokens->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(PersonalAccessToken $personalaccesstoken)
    {
        try {
            return response()->json($personalaccesstoken);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'tokenable_id' => 'required|exists:tokenables,id',
            'tokenable_type' => 'required|string',
            'name' => 'required|string',
            'token' => 'required|string',
            'abilities' => 'required|string',
            'last_used_at' => 'required|string'
        ]);
            
            $personalaccesstoken = PersonalAccessToken::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $personalaccesstoken], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, PersonalAccessToken $personalaccesstoken)
    {
        try {
            $data = $request->validate([
            'tokenable_id' => 'sometimes|exists:tokenables,id',
            'tokenable_type' => "sometimes|string",
            'name' => "sometimes|string",
            'token' => "sometimes|string",
            'abilities' => "sometimes|string",
            'last_used_at' => "sometimes|string"
        ]);
            
            $personalaccesstoken->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $personalaccesstoken]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(PersonalAccessToken $personalaccesstoken)
    {
        try {
            $personalaccesstoken->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
