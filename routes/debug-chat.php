<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ChatController;

// Temporary debug route
Route::post('/debug/chat/{roomId}/message', function ($roomId) {
  Log::info('Debug chat message received', [
    'roomId' => $roomId,
    'request_data' => request()->all(),
    'user' => auth()->guard('gudang')->user(),
    'headers' => request()->headers->all()
  ]);

  try {
    $controller = new ChatController();
    $result = $controller->sendMessage(request(), $roomId);

    Log::info('Debug chat message result', [
      'result' => $result->getContent()
    ]);

    return $result;
  } catch (\Exception $e) {
    Log::error('Debug chat message error', [
      'error' => $e->getMessage(),
      'trace' => $e->getTraceAsString()
    ]);

    return response()->json([
      'success' => false,
      'error' => $e->getMessage(),
      'trace' => $e->getTraceAsString()
    ], 500);
  }
})->middleware('auth:gudang');
