<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
  /**
   * The list of the inputs that are never flashed to the session on validation exceptions.
   *
   * @var array<int, string>
   */
  protected $dontFlash = [
    'current_password',
    'password',
    'password_confirmation',
  ];

  /**
   * Register the exception handling callbacks for the application.
   */
  public function register(): void
  {
    $this->reportable(function (Throwable $e) {
      //
    });
  }

  /**
   * Render an exception into an HTTP response.
   */
  public function render($request, Throwable $exception)
  {
    // Handle CSRF token mismatch
    if ($exception instanceof TokenMismatchException) {
      if ($request->expectsJson()) {
        return response()->json(['message' => 'Page expired. Please refresh and try again.'], 419);
      }
      
      return redirect()->back()
        ->withInput($request->except('password', '_token'))
        ->with('error', 'Page expired. Please try again.');
    }

    // Handle 404 errors
    if ($exception instanceof NotFoundHttpException) {
      return response()->view('errors.404', [], 404);
    }

    // Handle 403 errors
    if ($exception instanceof AccessDeniedHttpException) {
      return response()->view('errors.403', [], 403);
    }

    // Handle 405 errors
    if ($exception instanceof MethodNotAllowedHttpException) {
      return response()->view('errors.405', [], 405);
    }

    // Handle 500 errors and other HTTP exceptions
    if ($exception instanceof HttpException) {
      $statusCode = $exception->getStatusCode();

      if ($statusCode == 500) {
        return response()->view('errors.500', [], 500);
      }

      // Handle other status codes if needed
      if (view()->exists("errors.{$statusCode}")) {
        return response()->view("errors.{$statusCode}", [], $statusCode);
      }
    }

    return parent::render($request, $exception);
  }
}
