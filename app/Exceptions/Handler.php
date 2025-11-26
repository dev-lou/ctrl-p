<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Database\QueryException;
use PDOException;

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
     * Render an exception into an HTTP response (serverless-friendly).
     */
    public function render($request, Throwable $e)
    {
        // If the database is unreachable (network/connection error) always
        // render a non-sensitive 503 page instead of throwing a 500.
        if ($e instanceof QueryException || $e instanceof PDOException) {
            $msg = $e->getMessage();
            if (str_contains($msg, 'Network is unreachable') || str_contains($msg, 'SQLSTATE[08006]') || str_contains($msg, 'could not connect')) {
                logger()->warning('DB connectivity issue handled by global exception: ' . $msg);
                if ($request->expectsJson()) {
                    return response()->json(['status' => 'degraded', 'message' => 'DB unreachable'], 503);
                }
                // Serve a minimal error page or our degraded.html if present
                $path = storage_path('app/public/degraded.html');
                if (file_exists($path)) {
                    $content = file_get_contents($path);
                    return response($content, 503)->header('Content-Type', 'text/html');
                }
                return response()->view('errors.db-unavailable', [], 503);
            }
        }
        // For Vercel serverless: avoid Blade view compilation errors
        if (app()->environment('production') && $request->expectsJson() === false) {
            $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;
            // Always show the exception message here for debugging (temporary)
            $message = $e->getMessage() . ' [' . get_class($e) . ']';
            $trace = collect($e->getTrace())->take(5)->map(function ($t) {
                return (isset($t['file']) ? $t['file'] . ':' . ($t['line'] ?? '') : '') . ' ' . ($t['function'] ?? '');
            })->implode("\n");
            
            // Return simple HTML response instead of compiled Blade view
            return response()->make(
                '<!DOCTYPE html>
                <html>
                <head>
                    <title>Error ' . $statusCode . '</title>
                    <style>
                        body { font-family: sans-serif; text-align: center; padding: 50px; }
                        h1 { font-size: 48px; margin: 0; }
                        p { color: #666; }
                    </style>
                </head>
                <body>
                    <h1>' . $statusCode . '</h1>
                    <p>' . htmlspecialchars($message) . '</p>
                    <pre style="text-align:left; white-space:pre-wrap; color:#333; background:#f5f5f5; padding:10px; border-radius:6px;">' . htmlspecialchars($trace) . '</pre>
                    <p><a href="/">← Back to Home</a></p>
                </body>
                </html>',
                $statusCode
            );
        }

        return parent::render($request, $e);
    }
}

