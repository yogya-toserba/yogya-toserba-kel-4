<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogPostRequests
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('POST')) {
            Log::info('POST Request Detected', [
                'url' => $request->url(),
                'path' => $request->path(),
                'method' => $request->method(),
                'all_data' => $request->all(),
                'session_id' => session()->getId(),
                'csrf_token' => $request->header('X-CSRF-TOKEN') ?: $request->input('_token')
            ]);
        }

        return $next($request);
    }
}
