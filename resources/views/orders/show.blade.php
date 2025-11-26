<x-app-layout>
    @section('title', 'Order Details - ' . config('app.name', 'IGP Hub'))

    <div style="background: #FFFAF1; min-height: 100vh; width: 100%; margin: 0; padding: 0;">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap');

            body {
                background: #FFFAF1 !important;
                margin: 0 !important;
                padding: 0 !important;
                font-family: 'Inter', sans-serif;
            }

            html {
                background: #FFFAF1 !important;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Poppins', sans-serif;
            }

            .orders-page {
                background: #FFFAF1;
                min-height: 100vh;
                padding-top: 120px;
                padding-bottom: 80px;
            }

            .order-card {
                background: #FFFFFF;
                border: 1px solid rgba(139, 0, 0, 0.08);
                border-radius: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04), 0 1px 4px rgba(0, 0, 0, 0.02);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .order-card:hover {
                box-shadow: 0 12px 32px rgba(139, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.04);
                border-color: rgba(139, 0, 0, 0.15);
            }

            .order-text {
                color: #1a1a1a;
                font-weight: 600;
            }

            .order-total {
                color: #8B0000;
                font-weight: 700;
            }

            .order-item {
                display: flex;
                gap: 20px;
                padding: 20px;
                background: linear-gradient(to bottom, rgba(255, 250, 241, 0.3) 0%, transparent 100%);
                border: 1px solid rgba(139, 0, 0, 0.08);
                border-radius: 16px;
                margin-bottom: 16px;
                transition: all 0.3s ease;
            }

            .order-item:hover {
                border-color: rgba(139, 0, 0, 0.15);
                background: #FFFFFF;
                box-shadow: 0 4px 12px rgba(139, 0, 0, 0.06);
            }

            .order-item:last-child {
                margin-bottom: 0;
            }

            .order-item-image {
                width: 90px;
                height: 90px;
                border-radius: 12px;
                object-fit: cover;
                border: 1px solid rgba(139, 0, 0, 0.1);
                flex-shrink: 0;
            }

            .status-badge {
                display: inline-block;
                padding: 10px 18px;
                border-radius: 10px;
                font-size: 12px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.8px;
            }

            .status-pending {
                background: linear-gradient(135deg, rgba(139, 0, 0, 0.08) 0%, rgba(160, 0, 0, 0.05) 100%);
                color: #8B0000;
                border: 1px solid rgba(139, 0, 0, 0.2);
                box-shadow: 0 2px 8px rgba(139, 0, 0, 0.08);
            }

            .status-completed {
                background: rgba(76, 175, 80, 0.15);
                color: #2E7D32;
                border: 1px solid rgba(76, 175, 80, 0.3);
            }

            .status-cancelled {
                background: rgba(244, 67, 54, 0.15);
                color: #C62828;
                border: 1px solid rgba(244, 67, 54, 0.3);
            }

            .action-btn {
                font-weight: 600;
                padding: 14px 24px;
                border-radius: 12px;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                text-decoration: none;
                display: block;
                text-align: center;
                border: none;
                font-size: 15px;
                letter-spacing: 0.2px;
            }

            .btn-primary {
                background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
                color: #FFFFFF;
                box-shadow: 0 4px 12px rgba(139, 0, 0, 0.25);
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #A00000 0%, #B00000 100%);
                box-shadow: 0 8px 20px rgba(139, 0, 0, 0.35);
                transform: translateY(-2px);
            }

            .btn-secondary {
                background: transparent;
                color: #8B0000;
                border: 1px solid #8B0000;
                box-shadow: none;
            }

            .btn-secondary:hover {
                background: #8B0000;
                color: #FFFFFF;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(139, 0, 0, 0.2);
            }

            .btn-danger {
                background: linear-gradient(135deg, #FF5252 0%, #FF3838 100%);
                color: white;
                box-shadow: 0 4px 12px rgba(255, 82, 82, 0.3);
            }

            .btn-danger:hover {
                background: linear-gradient(135deg, #FF3838 0%, #FF1111 100%);
                box-shadow: 0 6px 16px rgba(255, 82, 82, 0.4);
                transform: translateY(-2px);
            }

            .timeline-item {
                display: flex;
                gap: 20px;
                padding: 20px;
                background: linear-gradient(to bottom, rgba(255, 250, 241, 0.3) 0%, transparent 100%);
                border-radius: 12px;
                margin-bottom: 14px;
                border-left: 3px solid #8B0000;
            }

            .timeline-dot {
                width: 14px;
                height: 14px;
                border-radius: 50%;
                flex-shrink: 0;
                margin-top: 3px;
            }

            .dot-completed {
                background: #4CAF50;
            }

            .dot-pending {
                background: #FFC107;
            }

            .info-label {
                color: #666666;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                font-weight: 700;
                margin-bottom: 8px;
            }

            .pickup-location-card {
                background: linear-gradient(135deg, rgba(139, 0, 0, 0.03) 0%, rgba(255, 215, 0, 0.02) 100%);
                border: 1px solid rgba(139, 0, 0, 0.12);
                color: #1a1a1a;
                box-shadow: 0 4px 16px rgba(139, 0, 0, 0.08);
            }

            .pickup-location-card h3 {
                font-size: 18px;
                font-weight: 800;
                margin-bottom: 12px;
                letter-spacing: -0.5px;
                color: #8B0000;
            }

            .pickup-location-card p {
                font-size: 15px;
                margin: 0;
                line-height: 1.7;
                font-weight: 500;
                color: #666666;
            }

            .pickup-location-card hr {
                border: none;
                border-top: 2px solid #E8E8E8;
                margin: 14px 0;
            }

            .page-header h1 {
                color: #1a1a1a;
                font-size: 2.25rem;
                font-weight: 800;
                margin-bottom: 12px;
                letter-spacing: -0.8px;
            }

            .page-header p {
                color: #666666;
                font-size: 16px;
                font-weight: 500;
                letter-spacing: 0.2px;
            }
        </style>

        <div class="orders-page">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="page-header mb-12">
                    <div class="flex items-center justify-between gap-4 mb-4">
                        <h1>📦 Order #{{ $order->order_number }}</h1>
                        <span class="status-badge status-{{ $order->status === 'completed' ? 'completed' : ($order->status === 'cancelled' ? 'cancelled' : 'pending') }}">{{ ucfirst($order->status) }}</span>
                    </div>
                    <p>Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Order Items -->
                        <div class="order-card p-8">
                            <h2 class="order-text text-2xl font-bold mb-8" style="font-size: 1.75rem; letter-spacing: -0.5px;">📦 Order Items</h2>
                            <div class="space-y-0">
                                @foreach ($order->items as $item)
                                    <div class="order-item">
                                        @if (!empty($item->product->image_url))
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="order-item-image">
                                        @elseif ($item->product->image_path)
                                            <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="order-item-image">
                                        @else
                                            <div class="order-item-image flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <p class="order-text font-bold" style="font-size: 16px; font-weight: 700;">{{ $item->product->name }}</p>
                                            @if ($item->variant)
                                                <p class="text-sm" style="color: #666666; margin-top: 4px;">🎨 {{ $item->variant->name }}</p>
                                            @endif
                                            <p class="text-sm" style="color: #888888; margin-top: 8px; font-weight: 600;">Qty: <span style="color: #1a1a1a; font-weight: 700;">{{ $item->quantity }}</span></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="order-text font-bold" style="font-size: 17px; font-weight: 800;">₱{{ number_format($item->unit_price, 2) }}</p>
                                            <p class="text-sm" style="color: #666666; margin-top: 4px; font-weight: 600;">₱{{ number_format($item->unit_price * $item->quantity, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Service Requests -->
                        @if (!empty($order->serviceRequests) && $order->serviceRequests->count() > 0)
                            <div class="order-card p-8">
                                <h2 class="order-text text-2xl font-bold mb-6" style="font-size: 1.75rem; letter-spacing: -0.5px;">🔧 Service Requests</h2>
                                <div class="space-y-4">
                                    @foreach ($order->serviceRequests ?? [] as $service)
                                        <div class="pb-4 border-b border-gray-200 last:border-0">
                                            <div class="flex justify-between items-start mb-3">
                                                <h3 class="order-text font-bold text-lg">{{ $service->service_type }}</h3>
                                                <span class="status-badge status-{{ $service->status === 'completed' ? 'completed' : 'pending' }}">{{ ucfirst($service->status) }}</span>
                                            </div>
                                            <p class="text-sm" style="color: #666666;">{{ $service->description }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Order Timeline -->
                        <div class="order-card p-8">
                            <h2 class="order-text text-2xl font-bold mb-6" style="font-size: 1.75rem; letter-spacing: -0.5px;">⏱️ Order Timeline</h2>
                            <div class="space-y-0">
                                <div class="timeline-item">
                                    <div class="timeline-dot dot-completed"></div>
                                    <div>
                                        <p class="order-text font-bold" style="font-size: 15px; margin-bottom: 4px;">Order Placed</p>
                                        <p class="text-sm" style="color: #666666;">{{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                                @if ($order->completed_at)
                                    <div class="timeline-item">
                                        <div class="timeline-dot dot-completed"></div>
                                        <div>
                                            <p class="order-text font-bold" style="font-size: 15px; margin-bottom: 4px;">Order Completed</p>
                                            <p class="text-sm" style="color: #666666;">{{ $order->completed_at->format('F d, Y \a\t g:i A') }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="timeline-item">
                                        <div class="timeline-dot dot-pending"></div>
                                        <div>
                                            <p class="order-text font-bold" style="font-size: 15px; margin-bottom: 4px;">Pending Completion</p>
                                            <p class="text-sm" style="color: #666666;">Order is being processed</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Continue Shopping Button Outside Card -->
                        <a href="{{ route('shop.index') }}" class="action-btn btn-secondary" style="width: 100%; text-align: center;">
                            🛍️ Continue Shopping
                        </a>

                        <!-- Order Summary & Information Combined -->
                        <div class="order-card p-8">
                            <h2 class="order-text text-2xl font-bold mb-6" style="font-size: 1.75rem; letter-spacing: -0.5px;">💰 Order Summary</h2>
                            
                            <!-- Order Total Section -->
                            <div class="space-y-4 mb-8 pb-8 border-b-2" style="border-color: #E8E8E8;">
                                <div class="flex justify-between">
                                    <span class="info-label" style="text-transform: none; font-size: 14px;">Subtotal</span>
                                    <span class="order-text font-bold" style="font-weight: 700;">₱{{ number_format($order->subtotal, 2) }}</span>
                                </div>
                            </div>
                            <div class="flex justify-between mb-8">
                                <span class="order-text text-xl font-bold">Total</span>
                                <span class="order-total" style="font-size: 32px; font-weight: 800;">₱{{ number_format($order->total, 2) }}</span>
                            </div>

                            <!-- Actions -->
                            <div class="space-y-3">
                                <a href="{{ route('orders.receipt.pdf', $order) }}" class="action-btn btn-primary">
                                    📄 View Receipt
                                </a>
                                
                                @if ($order->canBeCancelled())
                                    <form id="cancelOrderForm" action="{{ route('orders.cancel', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" class="action-btn btn-danger w-full" onclick="confirmCancelOrder(event)">
                                            ✕ Cancel Order
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Pickup Location -->
                        <div class="order-card p-8 pickup-location-card">
                            <div class="flex items-start gap-3 mb-4">
                                <svg class="w-7 h-7 flex-shrink-0 mt-1" style="color: #8B0000;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <h3 style="margin-bottom: 8px;">📍 Pickup Location</h3>
                                    <p style="margin-bottom: 6px; font-weight: 700; color: #1a1a1a;">CICT Student Council Office</p>
                                    <p style="margin-bottom: 0; font-size: 14px;">ISUFST Dingle Campus</p>
                                </div>
                            </div>
                            
                            <hr style="border: none; border-top: 2px solid #E8E8E8; margin: 16px 0;">
                            
                            <div class="mb-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5" style="color: #8B0000;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p style="margin: 0; font-weight: 700; color: #1a1a1a;">Operating Hours</p>
                                </div>
                                <p style="font-size: 14px; color: #666666; margin-left: 28px;">Monday - Friday</p>
                                <p style="font-size: 16px; font-weight: 700; color: #8B0000; margin-left: 28px;">8:00 AM - 5:00 PM</p>
                            </div>

                            <div class="p-4 rounded-lg" style="background: rgba(218, 165, 32, 0.1); border: 1px solid rgba(218, 165, 32, 0.3);">
                                <p style="font-size: 14px; margin: 0; line-height: 1.6; color: #666666;">
                                    <strong style="color: #1a1a1a;">📌 Pickup Instructions:</strong><br>
                                    Your order will be ready for pickup within 1-2 business days. Please bring a valid student ID when collecting your order. You'll receive a notification when your order is ready.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCancelOrder(event) {
            event.preventDefault();
            
            Swal.fire({
                title: 'Cancel Order?',
                text: 'Are you sure you want to cancel this order? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Cancel Order',
                cancelButtonText: 'No, Keep Order',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('cancelOrderForm').submit();
                }
            });
        }
    </script>
</x-app-layout>
