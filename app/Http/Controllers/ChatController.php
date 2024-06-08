<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatResource;
use App\Http\Trait\MobileResponse;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use MobileResponse;

    // تحديث رسالة دردشة معينة
    public function update(Request $request, $id)
    {
        $chat = Chat::find($id);
        if (!$chat) {
            return $this->fail("Chat with ID $id not found.");
        }

        $chat->update([
            'chat' => $request->chat
        ]);

        return $this->success(new ChatResource($chat));
    }

    // حذف رسالة دردشة معينة
    public function delete($id)
    {
        $chat = Chat::find($id);
        if ($chat) {
            $chat->delete();
            return $this->success("Chat with ID $id successfully deleted.");
        } else {
            return $this->fail("Chat with ID $id not found.");
        }
    }

    // عرض رسالة دردشة معينة باستخدام المعرف
    public function one2($id)
    {
        $chat = Chat::find($id);
        if (!$chat) {
            return $this->fail("Chat with ID $id not found.");
        }

        return $this->success(new ChatResource($chat));
    }

    // عرض رسالة دردشة معينة باستخدام معايير مختلفة (Request)
    public function one(Request $request)
    {
        $id = $request->id;
        $chat = Chat::find($id);
        if (!$chat) {
            return $this->fail("Chat with ID $id not found.");
        }

        return $this->success(new ChatResource($chat));
    }

    // إرسال رسالة جديدة
    public function send(Request $request)
    {
        // التحقق من صحة المدخلات
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'seen' => 'required|string',
            'message' => 'required|string',
            'receiver_id' => 'required|integer',
        ]);

        // إنشاء الرسالة الجديدة
        $chat = Chat::create($validated);

        return $this->success(new ChatResource($chat));
    }

    // عرض جميع رسائل الدردشة
    public function all()
    {
        $chats = Chat::all();
        return $this->success(ChatResource::collection($chats));
    }
}
