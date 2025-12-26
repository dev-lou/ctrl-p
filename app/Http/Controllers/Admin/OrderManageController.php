<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderManageController extends Controller
{
    /**
     * Display all customer orders with filtering options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $query = Order::with('user', 'items');

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('order_number', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Apply date filter
        if ($request->filled('date_filter')) {
            $dateFilter = $request->input('date_filter');
            $now = now();
            
            match ($dateFilter) {
                'today' => $query->whereDate('created_at', $now->format('Y-m-d')),
                '3days' => $query->whereBetween('created_at', [$now->copy()->subDays(3), $now]),
                'week' => $query->whereBetween('created_at', [$now->copy()->subWeek(), $now]),
                'month' => $query->whereBetween('created_at', [$now->copy()->subMonth(), $now]),
                default => null,
            };
        }

        $orders = $query->orderBy('created_at', 'asc')->paginate(15);

        return view('admin.orders.index', [
            'orders' => $orders,
            'pageTitle' => 'All Orders'
        ]);
    }

    /**
     * Display pending orders with filtering and search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showPending(Request $request): \Illuminate\View\View
    {
        $query = Order::with('user', 'items')
            ->where('status', 'pending');

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('order_number', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Apply date filter
        if ($request->filled('date_filter')) {
            $dateFilter = $request->input('date_filter');
            $now = now();
            
            match ($dateFilter) {
                'today' => $query->whereDate('created_at', $now->format('Y-m-d')),
                '3days' => $query->whereBetween('created_at', [$now->copy()->subDays(3), $now]),
                'week' => $query->whereBetween('created_at', [$now->copy()->subWeek(), $now]),
                'month' => $query->whereBetween('created_at', [$now->copy()->subMonth(), $now]),
                default => null,
            };
        }

        $orders = $query->orderBy('created_at', 'asc')->paginate(15);

        return view('admin.orders.filtered', [
            'orders' => $orders,
            'status' => 'pending',
            'pageTitle' => 'Pending Orders',
            'count' => $orders->total()
        ]);
    }

    /**
     * Display processing orders with filtering and search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showProcessing(Request $request): \Illuminate\View\View
    {
        $query = Order::with('user', 'items')
            ->where('status', 'processing');

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('order_number', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Apply date filter
        if ($request->filled('date_filter')) {
            $dateFilter = $request->input('date_filter');
            $now = now();
            
            match ($dateFilter) {
                'today' => $query->whereDate('created_at', $now->format('Y-m-d')),
                '3days' => $query->whereBetween('created_at', [$now->copy()->subDays(3), $now]),
                'week' => $query->whereBetween('created_at', [$now->copy()->subWeek(), $now]),
                'month' => $query->whereBetween('created_at', [$now->copy()->subMonth(), $now]),
                default => null,
            };
        }

        $orders = $query->orderBy('created_at', 'asc')->paginate(15);

        return view('admin.orders.filtered', [
            'orders' => $orders,
            'status' => 'processing',
            'pageTitle' => 'Processing Orders',
            'count' => $orders->total()
        ]);
    }

    /**
     * Display completed orders with filtering and search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showCompleted(Request $request): \Illuminate\View\View
    {
        $query = Order::with('user', 'items')
            ->where('status', 'completed');

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('order_number', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Apply date filter
        if ($request->filled('date_filter')) {
            $dateFilter = $request->input('date_filter');
            $now = now();
            
            match ($dateFilter) {
                'today' => $query->whereDate('created_at', $now->format('Y-m-d')),
                '3days' => $query->whereBetween('created_at', [$now->copy()->subDays(3), $now]),
                'week' => $query->whereBetween('created_at', [$now->copy()->subWeek(), $now]),
                'month' => $query->whereBetween('created_at', [$now->copy()->subMonth(), $now]),
                default => null,
            };
        }

        $orders = $query->orderBy('created_at', 'asc')->paginate(15);

        return view('admin.orders.filtered', [
            'orders' => $orders,
            'status' => 'completed',
            'pageTitle' => 'Completed Orders',
            'count' => $orders->total()
        ]);
    }

    /**
     * Display a single order's details.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order): \Illuminate\View\View
    {
        $order->load('user', 'items');
        return view('admin.orders.show', ['order' => $order]);
    }

    /**
     * Delete an order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Order $order): \Illuminate\Http\RedirectResponse
    {
        $orderNumber = $order->order_number;

        AuditLog::logAction(
            'order_delete',
            'Order',
            $order->id,
            [
                'order_number' => $order->order_number,
                'status' => $order->status,
                'total' => $order->total,
            ],
            null
        );

        $order->delete();

        return redirect()->back()
            ->with('success', "Order #{$orderNumber} has been deleted successfully.");
    }

    /**
     * Update an order's status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Order $order): \Illuminate\Http\RedirectResponse
    {
        // Validate status input
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // Update order status
        $order->update(['status' => $newStatus]);

        // If marking as completed, set completed_at timestamp
        if ($newStatus === 'completed' && !$order->completed_at) {
            $order->update(['completed_at' => now()]);
        }

        AuditLog::logAction(
            'order_status',
            'Order',
            $order->id,
            ['status' => $oldStatus],
            ['status' => $newStatus]
        );

        return redirect()->route('admin.orders.show', $order)
            ->with('success', "Order status updated from {$oldStatus} to {$newStatus}.");
    }

    /**
     * Assign a staff member to an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignStaff(Request $request, Order $order): \Illuminate\Http\RedirectResponse
    {
        // Validate staff user ID
        $request->validate([
            'assigned_staff_id' => 'nullable|exists:users,id',
        ]);

        $oldStaffId = $order->assigned_staff_id;
        $staffName = 'Unassigned';
        if ($request->assigned_staff_id) {
            $staff = \App\Models\User::find($request->assigned_staff_id);
            $staffName = $staff ? $staff->name : 'Unknown';
        }

        // Update order assigned staff
        $order->update(['assigned_staff_id' => $request->assigned_staff_id]);

        AuditLog::logAction(
            'order_assign',
            'Order',
            $order->id,
            ['assigned_staff_id' => $oldStaffId],
            ['assigned_staff_id' => $request->assigned_staff_id]
        );

        return redirect()->route('admin.orders.show', $order)
            ->with('success', "Order assigned to {$staffName}.");
    }

    /**
     * Download a customer-uploaded file for an order.
     *
     * @param  \App\Models\Order  $order
     * @param  string  $fileName
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile(Order $order, $fileName): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        // Validate file name to prevent directory traversal
        if (strpos($fileName, '..') !== false || strpos($fileName, '/') !== false) {
            abort(403, 'Invalid file name.');
        }

        // Build the file path
        $filePath = 'orders/' . $order->id . '/' . $fileName;

        // Verify file exists
        if (!Storage::disk('local')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        // Stream the file download
        return Storage::download($filePath, $fileName);
    }
}
