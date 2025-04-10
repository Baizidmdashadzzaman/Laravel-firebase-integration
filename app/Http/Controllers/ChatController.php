<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class ChatController extends Controller
{
    protected $db;

    public function __construct(FirebaseService $firebase)
    {
        $this->db = $firebase->getDatabase();
    }

    // ✅ Get all chats
    public function index()
    {
        $chats = $this->db->getReference('chats')->getValue();
        return response()->json($chats);
    }

    // ✅ Store a new chat
    public function store(Request $request)
    {
        $chat = $this->db->getReference('chats')->push([
            'sender' => $request->sender,
            'message' => $request->message,
            'timestamp' => now()->timestamp,
        ]);

        return response()->json(['id' => $chat->getKey()]);
    }

    // ✅ Show a single chat
    public function show($id)
    {
        $chat = $this->db->getReference("chats/{$id}")->getValue();
        return response()->json($chat);
    }

    // ✅ Update a chat
    public function update(Request $request, $id)
    {
        $this->db->getReference("chats/{$id}")->update([
            'message' => $request->message
        ]);

        return response()->json(['message' => 'Chat updated']);
    }

    // ✅ Delete a chat
    public function destroy($id)
    {
        $this->db->getReference("chats/{$id}")->remove();
        return response()->json(['message' => 'Chat deleted']);
    }
}

