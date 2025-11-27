<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Support\Facades\DB;

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
    public function render($request, Throwable $e)
    {
        // Handle database errors gracefully
        if ($e instanceof QueryException || $e instanceof PDOException) {
            $msg = $e->getMessage();
            
            // PostgreSQL transaction aborted error (25P02)
            // This happens when a query fails and subsequent queries try to run in the same transaction
            if (str_contains($msg, '25P02') || str_contains($msg, 'transaction is aborted')) {
                logger()->error('PostgreSQL transaction aborted: ' . $msg);
                
                // Try to rollback the aborted transaction
                try {
                    DB::rollBack();
                } catch (\Throwable $rollbackError) {
                    // Ignore rollback errors - connection may already be reset
                }
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'A database error occurred. Please try again.',
                    ], 500);
                }
                
                // Redirect back with error for web requests
                if ($request->hasSession()) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'An error occurred. Please try again.');
                }
                
                return response()->make(
                    $this->renderErrorPage(500, 'Database Error', 'Please try again.'),
                    500
                );
            }
            
            // Network/connection errors
            if (str_contains($msg, 'Network is unreachable') || 
                str_contains($msg, 'SQLSTATE[08006]') || 
                str_contains($msg, 'could not connect') ||
                str_contains($msg, 'Connection refused') ||
                str_contains($msg, 'server closed the connection')) {
                
                logger()->warning('DB connectivity issue: ' . $msg);
                
                if ($request->expectsJson()) {
                    return response()->json(['status' => 'degraded', 'message' => 'DB unreachable'], 503);
                }
                
                // Serve degraded page if exists
                $path = public_path('degraded.html');
                if (file_exists($path)) {
                    return response(file_get_contents($path), 503)
                        ->header('Content-Type', 'text/html');
                }
                
                return response()->make(
                    $this->renderErrorPage(503, 'Service Temporarily Unavailable', 'Please try again later.'),
                    503
                );
            }
        }

        // For production: show clean error pages
        if (app()->environment('production') && !$request->expectsJson()) {
            $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;
            
            // Log the actual error for debugging
            logger()->error('Production error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'url' => $request->fullUrl(),
            ]);
            
            // For admin pages, redirect back with error message
            if ($request->is('admin/*') && $request->hasSession() && $statusCode === 500) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Error: ' . $e->getMessage());
            }
            
            return response()->make(
                $this->renderErrorPage($statusCode, 'Error', 'Something went wrong.'),
                $statusCode
            );
        }

        return parent::render($request, $e);
    }
    
    /**
     * Render a simple error page without Blade compilation.
     */
    private function renderErrorPage(int $code, string $title, string $message): string
    {
        return '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $code . ' - ' . htmlspecialchars($title) . '</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 16px;
            padding: 48px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 400px;
            width: 100%;
        }
        .code { font-size: 72px; font-weight: 700; color: #667eea; margin-bottom: 8px; }
        .title { font-size: 24px; color: #1a202c; margin-bottom: 16px; }
        .message { color: #718096; margin-bottom: 24px; }
        .btn {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s;
        }
        .btn:hover { background: #5a67d8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="code">' . $code . '</div>
        <h1 class="title">' . htmlspecialchars($title) . '</h1>
        <p class="message">' . htmlspecialchars($message) . '</p>
        <a href="/" class="btn">Go Home</a>
    </div>
</body>
</html>';
    }
}

