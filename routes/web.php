<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryProductController;
use App\Http\Controllers\Admin\InventoryStockController;
use App\Http\Controllers\Admin\BuyListController;
use App\Http\Controllers\Admin\OrderManageController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\ReceiptPdfController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// ============================================================================
// CUSTOMER ROUTES (Public & Authenticated)
// ============================================================================

// Home Page
Route::get('/', [HomepageController::class, 'index'])->name('home');

// Health check endpoints
//  - /_health: developer-only (local env) — private debug info
//  - /healthz: platform-friendly and safe for production - returns 200/503
if (app()->environment('local')) {
    Route::get('/_health', function () {
        $appKey = (config('app.key')) ? 'present' : 'missing';
        try {
            DB::select('SELECT 1');
            $db = 'ok';
        } catch (\Throwable $e) {
            $db = 'error: '.$e->getMessage();
        }
        return response()->json(['health' => 'ok', 'app_key' => $appKey, 'db' => $db]);
    });
}

// Production-safe healthz endpoint for platform health checks (e.g., Render).
Route::get('/healthz', function () {
    try {
        // quick no-results DB ping
        DB::select('SELECT 1');
        return response()->json(['status' => 'ok', 'db' => 'ok', 'fallback' => null], 200);
    } catch (\Throwable $e) {
        // Do not leak database details, only return degraded status
        logger()->warning('Health check: DB unreachable: ' . $e->getMessage());
        $fallback = null;
        // If we have a server-side key, try to verify the supabase REST is responding
        if (!empty(config('services.supabase.service_role_key'))) {
            try {
                $fallbackService = new \App\Services\SupabaseFallback();
                $test = $fallbackService->getFeaturedProducts(1);
                if ($test && $test->isNotEmpty()) {
                    $fallback = 'supabase_rest';
                }
            } catch (\Throwable $inner) {
                logger()->warning('Health check: Supabase REST fallback failed: ' . $inner->getMessage());
            }
        }

        return response()->json(['status' => 'degraded', 'db' => 'unreachable', 'fallback' => $fallback], 503);
    }
});

// Optional debug endpoint for Gemini diagnostics (secure via token).
// Only enabled when CICT_GEMINI_DEBUG_TOKEN is set in the environment to avoid exposure.
if (!empty(env('CICT_GEMINI_DEBUG_TOKEN'))) {
    Route::get('/_debug/gemini', function (Illuminate\Http\Request $request) {
        $token = env('CICT_GEMINI_DEBUG_TOKEN');
        $provided = $request->header('X-Debug-Token') ?: $request->query('debug_token');
        if ($provided !== $token) {
            abort(403, 'Forbidden');
        }

        $model = config('services.gemini.model');
        $apiKeySet = !empty(config('services.gemini.api_key'));
        $apiUrlBase = 'https://generativelanguage.googleapis.com/v1beta/models';

        $result = [
            'model_config' => $model,
            'api_url_base' => $apiUrlBase,
            'api_key_set' => $apiKeySet,
        ];

        if (!$apiKeySet) {
            return response()->json($result);
        }

        try {
            $res = Illuminate\Support\Facades\Http::withHeaders(['Content-Type' => 'application/json'])
                ->get($apiUrlBase . '?key=' . config('services.gemini.api_key'));

            if (!$res->successful()) {
                $result['models_fetch_status'] = $res->status();
                $result['models_fetch_body'] = $res->json();
                return response()->json($result, 200);
            }

            $data = $res->json();
            $modelNames = array_map(fn($m) => $m['name'] ?? ($m['id'] ?? null), $data['models'] ?? []);
            $result['available_models'] = $modelNames;
            return response()->json($result, 200);
        } catch (\Exception $e) {
            $result['exception'] = $e->getMessage();
            return response()->json($result, 200);
        }

    })->name('debug.gemini');
}

// Shop Routes (Browse Products)
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('shop.show');

// Services Routes
Route::get('/services', function () {
    return view('services.index');
})->name('services.index');

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// Cart Routes (Authenticated Only)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
});

// Checkout Routes (Authenticated Only)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Order Routes (Authenticated Only)
Route::middleware('auth')->group(function () {
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{order}/pdf', [ReceiptPdfController::class, 'show'])->name('orders.receipt.pdf');
});

// Customer Account Routes (via Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/account', function () {
        return redirect('/profile');
    })->name('account.index');
    
    Route::get('/account/orders', [OrderController::class, 'customerOrders'])->name('account.orders');
    Route::get('/account/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
});

// Notification Routes (Authenticated Only)
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread', [NotificationController::class, 'getUnread'])->name('notifications.unread');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

// Review Routes (Authenticated Only)
Route::middleware('auth')->group(function () {
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// ============================================================================
// CHATBOT ROUTES
// ============================================================================
Route::post('/chatbot/message', [ChatbotController::class, 'chat'])->name('chatbot.chat');
Route::get('/chatbot/quick-actions', [ChatbotController::class, 'quickActions'])->name('chatbot.quick-actions');

// ============================================================================
// ADMIN ROUTES (Protected with Auth & Admin Middleware)
// ============================================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ========================================================================
    // Inventory Management Routes
    // ========================================================================
    Route::prefix('inventory')->name('inventory.')->group(function () {
        // Products CRUD
        Route::get('/', [InventoryProductController::class, 'index'])->name('index');
        Route::get('/create', [InventoryProductController::class, 'create'])->name('create');
        Route::post('/', [InventoryProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [InventoryProductController::class, 'edit'])->name('edit');
        Route::patch('/{product}', [InventoryProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [InventoryProductController::class, 'destroy'])->name('destroy');
    });
    
    // ========================================================================
    // Buy List / To-Buy Module
    // ========================================================================
    Route::prefix('buy-list')->name('buy-list.')->group(function () {
        Route::get('/', [BuyListController::class, 'index'])->name('index');
        Route::get('/create', [BuyListController::class, 'create'])->name('create');
        Route::post('/', [BuyListController::class, 'store'])->name('store');
        Route::get('/{buyListItem}/edit', [BuyListController::class, 'edit'])->name('edit');
        Route::patch('/{buyListItem}', [BuyListController::class, 'update'])->name('update');
        Route::delete('/{buyListItem}', [BuyListController::class, 'destroy'])->name('destroy');
        Route::patch('/{buyListItem}/mark-purchased', [BuyListController::class, 'markPurchased'])->name('mark-purchased');
        Route::post('/{buyListItem}/upload-receipt', [BuyListController::class, 'uploadReceipt'])->name('upload-receipt');
    });
    
    // ========================================================================
    // Order Management Routes
    // ========================================================================
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderManageController::class, 'index'])->name('index');
        Route::get('/pending', [OrderManageController::class, 'showPending'])->name('pending');
        Route::get('/processing', [OrderManageController::class, 'showProcessing'])->name('processing');
        Route::get('/completed', [OrderManageController::class, 'showCompleted'])->name('completed');
        Route::get('/{order}', [OrderManageController::class, 'show'])->name('show');
        Route::delete('/{order}', [OrderManageController::class, 'destroy'])->name('destroy');
        Route::patch('/{order}/status', [OrderManageController::class, 'updateStatus'])->name('update-status');
        Route::patch('/{order}/assign-staff', [OrderManageController::class, 'assignStaff'])->name('assign-staff');
        Route::get('/{order}/download-file', [OrderManageController::class, 'downloadFile'])->name('download-file');
    });
    
    // ========================================================================
    // Analytics
    // ========================================================================
    Route::prefix('analytics')->name('analytics.')->group(function () {
        Route::get('/', [AnalyticsController::class, 'index'])->name('index');
        Route::get('/revenue', [AnalyticsController::class, 'getRevenue'])->name('revenue');
        Route::get('/categories', [AnalyticsController::class, 'getCategories'])->name('categories');
        Route::get('/top-products', [AnalyticsController::class, 'getTopProducts'])->name('top-products');
        Route::get('/kpis', [AnalyticsController::class, 'getKpis'])->name('kpis');
        Route::get('/daily-orders', [AnalyticsController::class, 'getDailyOrders'])->name('daily-orders');
        Route::get('/order-status', [AnalyticsController::class, 'getOrderStatus'])->name('order-status');
        Route::get('/top-customers', [AnalyticsController::class, 'getTopCustomers'])->name('top-customers');
        Route::get('/peak-hours', [AnalyticsController::class, 'getPeakHours'])->name('peak-hours');
        Route::get('/weekly-comparison', [AnalyticsController::class, 'getWeeklyComparison'])->name('weekly-comparison');
        Route::get('/conversion-metrics', [AnalyticsController::class, 'getConversionMetrics'])->name('conversion-metrics');
        Route::get('/payment-methods', [AnalyticsController::class, 'getPaymentMethods'])->name('payment-methods');
        Route::get('/inventory-performance', [AnalyticsController::class, 'getInventoryPerformance'])->name('inventory-performance');
        Route::get('/monthly-revenue', [AnalyticsController::class, 'getMonthlyRevenue'])->name('monthly-revenue');
    });

    // Admin Gemini diagnostics (safe, admin-only)
    Route::get('/gemini/diagnose', [\App\Http\Controllers\Admin\GeminiDiagController::class, 'index'])->name('gemini.diagnose');
    
    // ========================================================================
    // Audit Logs
    // ========================================================================
    Route::prefix('audit-logs')->name('audit-logs.')->group(function () {
        Route::get('/', [AuditLogController::class, 'index'])->name('index');
        Route::get('/{auditLog}', [AuditLogController::class, 'show'])->name('show');
    });
    
    // ========================================================================
    // Admin Settings & User Management
    // ========================================================================
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [UserManageController::class, 'settings'])->name('index');
        Route::post('/', [UserManageController::class, 'updateSettings'])->name('update');
    });
    
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserManageController::class, 'index'])->name('index');
        Route::get('/create', [UserManageController::class, 'create'])->name('create');
        Route::post('/', [UserManageController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserManageController::class, 'edit'])->name('edit');
        Route::patch('/{user}', [UserManageController::class, 'update'])->name('update');
        Route::post('/{user}/update-picture', [UserManageController::class, 'updatePicture'])->name('update-picture');
        Route::delete('/{user}', [UserManageController::class, 'destroy'])->name('destroy');
        Route::patch('/{user}/assign-role', [UserManageController::class, 'assignRole'])->name('assign-role');
    });
    
});// ============================================================================
// AUTHENTICATION ROUTES
// ============================================================================
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function () {
    $credentials = request()->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, request()->boolean('remember'))) {
        request()->session()->regenerate();
        
        // Redirect admin users to admin dashboard, others to home
        if (auth()->user()->isAdmin()) {
            return redirect()->intended('/admin/dashboard');
        }
        
        // Regular users go to home page
        return redirect('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
})->name('login.post')->middleware(['guest', 'throttle:5,1']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/register', function () {
    $data = request()->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => [
            'required',
            'min:8',
            'confirmed',
        ],
    ]);

    // store roles as an array so Eloquent casts will persist JSON for us
    $user = \App\Models\User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
        'roles' => ['customer'], // New registrations are customers
    ]);

    Auth::login($user);

    return redirect('/');
})->name('register.post')->middleware(['guest', 'throttle:5,1']);

Route::post('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/');
})->name('logout')->middleware('auth');

Route::get('/profile', function () {
    return view('profile.show');
})->name('profile.show')->middleware('auth');

Route::post('/profile/update-picture', [ProfileController::class, 'updatePicture'])->name('profile.update-picture')->middleware('auth');
Route::post('/profile/update-name', [ProfileController::class, 'updateName'])->name('profile.update-name')->middleware('auth');
Route::post('/profile/update-email', [ProfileController::class, 'updateEmail'])->name('profile.update-email')->middleware('auth');
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password')->middleware('auth');

// ============================================================================
// BREEZE AUTHENTICATION ROUTES (Already Registered by Breeze Package)
// ============================================================================
// Routes for login, register, password reset, email verification are
// automatically included when Laravel Breeze is installed.
