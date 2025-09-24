<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Exception;


class MessageController extends  BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Message::class, 'message');
    }

    public function index()
    {
        try {
            $messages = Message::paginate(10);
            return response()->json([
                'data' => $messages->items(),
                'meta' => [
                    'current_page' => $messages->currentPage(),
                    'last_page' => $messages->lastPage(),
                    'per_page' => $messages->perPage(),
                    'total' => $messages->total(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Message $message)
    {
        try {
            return response()->json($message);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في جلب البيانات', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
            'sender_id' => 'required|exists:senders,id',
            'receiver_id' => 'required|exists:receivers,id',
            'subject' => 'nullable|string',
            'body' => 'nullable|string'
        ]);
            
            $message = Message::create($data);
            return response()->json(['message' => 'تم الإنشاء بنجاح', 'data' => $message], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الإنشاء', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Message $message)
    {
        try {
            $data = $request->validate([
            'sender_id' => 'sometimes|exists:senders,id',
            'receiver_id' => 'sometimes|exists:receivers,id',
            'subject' => "nullable|string",
            'body' => "nullable|string"
        ]);
            
            $message->update($data);
            return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $message]);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في التحديث', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Message $message)
    {
        try {
            $message->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        } catch (Exception $e) {
            return response()->json(['message' => 'فشل في الحذف', 'error' => $e->getMessage()], 500);
        }
    }
}
