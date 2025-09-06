<?php

// Test route untuk debug chat
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/debug-chat/{roomId}', function ($roomId) {
  $user = auth()->guard('gudang')->user();

  return response()->json([
    'auth_status' => auth()->guard('gudang')->check(),
    'user' => $user,
    'room_id' => $roomId,
    'csrf_token' => csrf_token(),
    'chat_room' => \App\Models\ChatRoom::find($roomId),
    'route_exists' => Route::has('gudang.chat.message')
  ]);
})->middleware('auth:gudang');
