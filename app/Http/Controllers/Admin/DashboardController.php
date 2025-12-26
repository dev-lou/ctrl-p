<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\ServiceOption;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with key metrics and Bento Grid layout.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        // Today's date
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        // ========================================================================
        // KEY METRICS
        // ========================================================================

        // Today's Sales
        $todaysSales = Order::query()
            ->whereDate('created_at', $today)
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        // Today's Orders Count
        $todaysOrdersCount = Order::query()
            ->whereDate('created_at', $today)
            ->count();

        // Pending Orders Count
        $pendingOrdersCount = Order::query()
            ->where('status', 'pending')
            ->count();

        // Low Stock Alert Count
        $lowStockCount = Product::query()
            ->whereRaw('current_stock <= low_stock_threshold')
            ->count();

        // Month's Revenue
        $monthsRevenue = Order::query()
            ->whereBetween('created_at', [$startOfMonth, now()])
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        // Total Customers
        $totalCustomers = Order::query()
            ->distinct('user_id')
            ->count('user_id');

        // ========================================================================
        // REVENUE CHART DATA (Last 7 Days)
        // ========================================================================
        $revenueData = [];
        $labels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayLabel = $date->format('M d');
            $labels[] = $dayLabel;
            
            $dayRevenue = Order::query()
                ->whereDate('created_at', $date)
                ->where('status', '!=', 'cancelled')
                ->sum('total');
            
            $revenueData[] = (float)$dayRevenue;
        }

        // ========================================================================
        // TOP SELLING PRODUCTS
        // ========================================================================
        $topProducts = OrderItem::query()
            ->select('product_id', DB::raw('COUNT(*) as order_count'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('product_id')
            ->orderBy('order_count', 'desc')
            ->with('product')
            ->limit(5)
            ->get()
            ->filter(fn ($item) => $item->product !== null);

        // ========================================================================
        // RECENT ORDERS
        // ========================================================================
        $recentOrders = Order::query()
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // ========================================================================
        // INVENTORY STATS
        // ========================================================================
        $totalProducts = Product::active()->count();
        $inStockProducts = Product::active()->where('current_stock', '>', 0)->count();
        $outOfStockProducts = Product::active()->where('current_stock', 0)->count();

        // Low Stock Products (detailed list)
        $lowStockProducts = Product::active()
            ->whereRaw('current_stock <= low_stock_threshold')
            ->where('current_stock', '>', 0)
            ->orderBy('current_stock', 'asc')
            ->limit(10)
            ->get();

        // ========================================================================
        // CUSTOMER INSIGHTS
        // ========================================================================
        // Note: users table stores roles as JSON in the `roles` column (e.g. ["customer"]).
        // Use whereJsonContains to correctly query customers instead of an non-existent `role` column.
        $newCustomersThisMonth = \App\Models\User::query()
            ->whereBetween('created_at', [$startOfMonth, now()])
            ->whereJsonContains('roles', 'customer')
            ->count();

        $activeCustomers = Order::query()
            ->whereBetween('created_at', [Carbon::now()->subDays(30), now()])
            ->distinct('user_id')
            ->count('user_id');

        // ========================================================================
        // SERVICES ANALYTICS
        // ========================================================================
        $servicesTotal = Service::query()->count();
        $servicesActive = Service::query()->where('is_active', true)->count();
        $serviceOptionsCount = ServiceOption::query()->count();

        return view('admin.dashboard', [
            // Metrics
            'todaysSales' => $todaysSales,
            'todaysOrdersCount' => $todaysOrdersCount,
            'pendingOrdersCount' => $pendingOrdersCount,
            'lowStockCount' => $lowStockCount,
            'monthsRevenue' => $monthsRevenue,
            'totalCustomers' => $totalCustomers,
            
            // Charts
            'revenueLabels' => json_encode($labels),
            'revenueData' => json_encode($revenueData),
            
            // Lists
            'topProducts' => $topProducts,
            'recentOrders' => $recentOrders,
            'lowStockProducts' => $lowStockProducts,
            
            // Inventory
            'totalProducts' => $totalProducts,
            'inStockProducts' => $inStockProducts,
            'outOfStockProducts' => $outOfStockProducts,

            // Customer Insights
            'newCustomersThisMonth' => $newCustomersThisMonth,
            'activeCustomers' => $activeCustomers,

            // Services
            'servicesTotal' => $servicesTotal,
            'servicesActive' => $servicesActive,
            'serviceOptionsCount' => $serviceOptionsCount,
        ]);
    }
}

