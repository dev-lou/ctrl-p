<x-admin-layout>
    @section('page-title', 'Order Details')

    <!-- Header with Back Button -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.orders.index') }}" class="text-xl font-bold" style="color: #b0bcc4;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#b0bcc4'">← Orders</a>
                <h2 class="text-2xl font-bold" style="color: #ffffff;">Order #{{ $order->order_number }}</h2>
            </div>
            <p class="mt-2" style="color: #b0bcc4;">{{ $order->created_at->format('F d, Y h:i A') }}</p>
        </div>
        <div class="flex items-center gap-4">
            @php
                $statusColor = match($order->status) {
                    'completed' => '#4caf50',
                    'cancelled' => '#f44336',
                    'processing' => '#ff9500',
                    default => '#b0bcc4'
                };
                $statusTextColor = in_array($order->status, ['completed', 'cancelled']) ? 'white' : '#0f1419';
            @endphp
            <span class="px-4 py-2 rounded-full text-sm font-bold" style="background-color: {{ $statusColor }}; color: {{ $statusTextColor }};">{{ ucfirst($order->status) }}</span>
            
            <!-- Delete Button Only -->
            <button type="button" onclick="deleteOrder({{ $order->id }})" class="px-4 py-2 rounded-lg font-semibold text-sm transition-all inline-flex items-center gap-2" style="background-color: #f44336; color: white; border: 2px solid #f44336;" onmouseover="this.style.backgroundColor='#ff6b6b'; this.style.boxShadow='0 4px 6px -1px rgba(244,67,54,0.4)'" onmouseout="this.style.backgroundColor='#f44336'; this.style.boxShadow=''">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Delete
            </button>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Items -->
            <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                    <h3 class="text-lg font-bold" style="color: #ffffff;">Order Items</h3>
                </div>
                <div class="p-6">
                    @forelse ($order->items as $item)
                        <div class="flex justify-between items-center pb-4 mb-4" style="border-bottom: 2px solid #b0bcc4;">
                            <div>
                                <p class="font-semibold" style="color: #ffffff;">{{ optional($item->product)->name ?? $item->product_name ?? 'Product' }}</p>
                                <p class="text-sm" style="color: #b0bcc4;">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <p class="font-semibold" style="color: #ffffff;">₱{{ number_format($item->unit_price * $item->quantity, 2) }}</p>
                        </div>
                    @empty
                        <p style="color: #b0bcc4;">No items in this order</p>
                    @endforelse
                </div>
            </div>

            <!-- Order Status Management -->
            <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                    <h3 class="text-lg font-bold" style="color: #ffffff;">Update Status</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="w-full rounded-lg px-4 py-2" style="border: 2px solid #b0bcc4; background-color: #0f1419; color: #b0bcc4;">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }} style="background-color: #0f1419; color: #b0bcc4;">Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }} style="background-color: #0f1419; color: #b0bcc4;">Processing</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }} style="background-color: #0f1419; color: #b0bcc4;">Completed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }} style="background-color: #0f1419; color: #b0bcc4;">Cancelled</option>
                        </select>
                        <button type="submit" class="w-full px-6 py-3 rounded-lg font-bold transition-colors" style="background-color: #0f6fdd; color: #ffffff; border: 2px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#1a7fff'" onmouseout="this.style.backgroundColor='#0f6fdd'">Update Status</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column - Order Summary -->
        <div class="lg:col-span-1">
            <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                    <h3 class="text-lg font-bold" style="color: #ffffff;">Order Summary</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between" style="border-bottom: 2px solid #b0bcc4; padding-bottom: 12px;">
                        <span style="color: #b0bcc4;">Subtotal</span>
                        <span style="color: #ffffff; font-weight: bold;">₱{{ number_format($order->subtotal ?? $order->total, 2) }}</span>
                    </div>
                    <div class="flex justify-between" style="border-bottom: 2px solid #b0bcc4; padding-bottom: 12px;">
                        <span style="color: #b0bcc4;">Tax</span>
                        <span style="color: #ffffff; font-weight: bold;">₱{{ number_format($order->tax ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between pt-4" style="border-top: 2px solid #b0bcc4;">
                        <span style="color: #ffffff; font-weight: bold; font-size: 18px;">Total</span>
                        <span style="color: #ffffff; font-weight: bold; font-size: 18px;">₱{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="rounded-lg shadow-lg overflow-hidden mt-6" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                    <h3 class="text-lg font-bold" style="color: #ffffff;">Customer Info</h3>
                </div>
                <div class="p-6 space-y-3">
                    <div>
                        <p style="color: #b0bcc4; font-size: 12px;">Name</p>
                        <p style="color: #ffffff; font-weight: bold;">{{ $order->user->name ?? 'Unknown' }}</p>
                    </div>
                    <div style="border-top: 2px solid #b0bcc4; padding-top: 12px;">
                        <p style="color: #b0bcc4; font-size: 12px;">Email</p>
                        <p style="color: #ffffff; font-weight: bold;">{{ $order->user->email ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<script>
    function deleteOrder(orderId) {
        Swal.fire({
            title: 'Delete Order?',
            text: 'This action cannot be undone. The order will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f44336',
            cancelButtonColor: '#666',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            background: '#0f1419',
            color: '#ffffff',
            titleColor: '#ffffff',
            iconColor: '#ff9500',
            didOpen: () => {
                document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Create form and submit delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/orders/${orderId}`;
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                
                // Show loading state
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait while the order is being deleted.',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                        document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                    },
                    background: '#0f1419',
                    color: '#ffffff',
                    titleColor: '#ffffff',
                    iconColor: '#b0bcc4'
                });
                
                // Add event listener for successful submission
                form.addEventListener('submit', function() {
                    setTimeout(() => {
                        Swal.fire({
                            title: 'Delete Successful!',
                            text: 'The order has been deleted successfully.',
                            icon: 'success',
                            confirmButtonColor: '#4caf50',
                            background: '#0f1419',
                            color: '#ffffff',
                            titleColor: '#4caf50',
                            iconColor: '#4caf50',
                            didOpen: () => {
                                document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                            },
                            didClose: () => {
                                // Redirect to orders list after alert closes
                                window.location.href = '{{ route("admin.orders.index") }}';
                            }
                        });
                    }, 500);
                });
                
                form.submit();
            }
        });
    }
</script>
