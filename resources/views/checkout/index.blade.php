<x-app-layout :title="'Checkout - CICT Merch'">
    <div style="background: #F5F7FB; min-height: 100vh; width: 100%; padding-top: 80px;">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap');

        body {
            background: #FFFFFF !important;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* Page Header */
        .checkout-header {
            text-align: center;
            margin-bottom: 16px;
        }

        .checkout-header h1 {
            color: #1a1a1a;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .pickup-info {
            text-align: center;
            margin-bottom: 16px;
        }

        .pickup-info .hours {
            color: #8B0000;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .pickup-info .location {
            color: #666666;
            font-size: 14px;
            font-weight: 600;
        }

        .checkout-header-badge {
            display: inline-block;
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        /* Checkout Cards */
        .checkout-card {
            background: #FFFFFF;
            border: 1px solid #E7EAF0;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .checkout-card:hover {
            box-shadow: 0 16px 46px rgba(15, 23, 42, 0.12);
            border-color: #d8dde8;
        }

        .checkout-card h2 {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 28px;
            letter-spacing: -0.5px;
        }

        /* Form Styling */
        .form-label {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: block;
            margin-bottom: 10px;
        }

        .form-input {
            background: #FFFFFF;
            color: #1a1a1a;
            border: 2px solid #E8E8E8;
            border-radius: 8px;
            padding: 14px 16px;
            font-size: 15px;
            line-height: 1.6;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            font-weight: 500;
        }

        .form-input:focus {
            outline: none;
            border-color: #8B0000;
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.15);
            background: #FFFFFF;
        }

        .form-input:disabled {
            background: #F9F9F9;
            color: #1a1a1a;
            border-color: #E8E8E8;
            cursor: not-allowed;
            font-weight: 600;
        }

        .form-input::placeholder {
            color: #999999 !important;
            font-weight: 400;
        }

        textarea.form-input {
            resize: vertical;
            font-family: 'Inter', sans-serif;
            min-height: 120px;
        }

        /* Buttons */
        .checkout-btn {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            font-weight: 700;
            padding: 16px 24px;
            border-radius: 8px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.25);
            font-size: 16px;
            letter-spacing: 0.3px;
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #A00000 0%, #8B0000 100%);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.4);
            transform: translateY(-2px);
            border-color: transparent;
        }

        .checkout-btn:active {
            transform: translateY(0);
        }

        .back-btn {
            background: transparent;
            color: #8B0000;
            border: 2px solid #8B0000;
            font-weight: 700;
            padding: 14px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            letter-spacing: 0.3px;
        }

        .back-btn:hover {
            background: #8B0000;
            color: #FFFFFF;
            border-color: #8B0000;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.2);
        }

        /* Order Items */
        .order-item {
            display: flex;
            gap: 16px;
            padding: 18px;
            background: #F9F9F9;
            border: 2px solid #E8E8E8;
            border-radius: 10px;
            margin-bottom: 14px;
            transition: all 0.3s ease;
        }

        .order-item:hover {
            background: #FFFFFF;
            border-color: #8B0000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .order-item-image {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #E8E8E8;
            flex-shrink: 0;
            background: linear-gradient(135deg, #F5F5F5 0%, #EEEEEE 100%);
        }

        .order-item-details {
            flex-grow: 1;
        }

        .order-item-name {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .order-item-variant {
            color: #666666;
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .order-item-qty {
            color: #888888;
            font-size: 14px;
            font-weight: 600;
        }

        .order-item-price {
            color: #8B0000;
            font-weight: 800;
            font-size: 17px;
        }

        /* Order Summary Card */
        .order-summary-card {
            background: #FFFFFF;
            border: 1px solid #E7EAF0;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.1);
        }

        .order-summary-card h2 {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 28px;
            letter-spacing: -0.5px;
        }

        /* Summary Rows */
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            font-size: 15px;
            border-bottom: 1px solid #E8E8E8;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-label {
            color: #666666;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .summary-value {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 16px;
        }

        .summary-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
            font-size: 18px;
            font-weight: 700;
            border: 2px solid #E8E8E8;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 24px;
            background: #F9F9F9;
        }

        .summary-total-label {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 0.2px;
        }

        .summary-total-value {
            color: #8B0000;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .divider {
            border-color: #F0F0F0;
            border-top: 1px solid #F0F0F0;
            margin: 16px 0;
        }

        /* Trust Badges */
        .trust-badge {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #F0F0F0;
        }

        .trust-badge:last-child {
            border-bottom: none;
        }

        .trust-badge-icon {
            color: #8B0000;
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .trust-badge-text {
            color: #888888;
            font-size: 14px;
            line-height: 1.5;
        }

        .trust-badge-text strong {
            color: #1a1a1a;
            font-weight: 700;
        }

        /* Error Text */
        .error-text {
            color: #FF5252;
            font-size: 14px;
            margin-top: 6px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* Free Badge */
        .free-badge {
            color: #4CAF50;
            font-weight: 700;
        }

        .checkout-shell {
            background: #FFFFFF;
            border: 1px solid #E7EAF0;
            border-radius: 16px;
            box-shadow: 0 16px 48px rgba(15, 23, 42, 0.08);
            padding: 32px;
        }

        .checkout-steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 18px 0 10px;
        }

        .checkout-step {
            background: #FFFFFF;
            border: 1px solid #E7EAF0;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
            font-weight: 700;
            font-size: 13px;
            color: #1a1a1a;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
        }

        .checkout-step.active {
            border-color: #8B0000;
            box-shadow: 0 10px 26px rgba(139, 0, 0, 0.15);
            color: #8B0000;
        }

        @media (max-width: 768px) {
            .order-item-image {
                width: 80px;
                height: 80px;
            }

            .checkout-header h1 {
                font-size: 1.8rem;
            }
            /* Ensure the order summary card is not sticky on mobile to prevent awkward overlays */
            .order-summary-card {
                position: static !important;
                top: auto !important;
                width: 100% !important;
                margin-bottom: 16px !important;
            }
        }
    </style>

    <div style="background: transparent; min-height: 100vh; width: 100%;">
        <div class="py-4 mt-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="checkout-header">
                    <h1>💳 Checkout</h1>
                    <div class="pickup-info">
                        <div class="hours">⏰ Monday - Friday: 8:00 AM - 5:00 PM</div>
                        <div class="location">CICT Student Council Office, ISUFST Dingle Campus</div>
                    </div>
                    <div class="checkout-header-badge">
                        Complete your order securely
                    </div>

                    <div class="checkout-steps">
                        <div class="checkout-step">Cart</div>
                        <div class="checkout-step active">Checkout</div>
                        <div class="checkout-step">Confirmation</div>
                    </div>
                </div>

                <div class="checkout-shell">
                <form method="POST" action="{{ route('checkout.store') }}">
                    @csrf
                    {{-- Fallback: post the cart JSON with the form in case server session is lost between requests --}}
                    <input type="hidden" name="cart_payload" value='@json(session("cart"))'>
                    <input type="hidden" name="cart_count" value="{{ count(session('cart', [])) }}">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Checkout Form -->
                        <div class="lg:col-span-2">
                            <!-- Order Review Section -->
                            <div class="checkout-card p-8">
                                <h2>📋 Order Summary</h2>
                                <div class="space-y-3">
                                    @foreach ($items as $item)
                                        <div class="order-item">
                                            @if ($item['product']->image_path)
                                                <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}" class="order-item-image">
                                            @else
                                                <div class="order-item-image flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="order-item-details">
                                                <div class="order-item-name">{{ $item['product']->name }}</div>
                                                @if ($item['variant'])
                                                    <div class="order-item-variant">🎨 {{ $item['variant']->name }}</div>
                                                @endif
                                                <div class="order-item-qty">Qty: {{ $item['quantity'] }}</div>
                                                <div style="color: #666666; font-size: 14px; font-weight: 600; margin-top: 4px;">Unit Price: ₱{{ number_format($item['price'], 2) }}</div>
                                            </div>
                                            <div style="text-align: right; display: flex; flex-direction: column; justify-content: center;">
                                                <div style="color: #888888; font-size: 13px; margin-bottom: 4px;">Subtotal</div>
                                                <div class="order-item-price">₱{{ number_format($item['total'], 2) }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Sidebar -->
                        <div class="lg:col-span-1">
                        <!-- Back to Cart Button Outside Card -->
                        <a href="{{ route('cart.index') }}" class="back-btn" style="width: 100%; text-align: center; margin-bottom: 16px; display: flex; align-items: center; justify-content: center;">
                            ← Back to Cart
                        </a>

                        <div class="order-summary-card p-8 sticky top-28 h-fit">
                            <h2>💰 Order Total</h2>

                            <div class="space-y-4 mb-4 pb-4 divider">
                                <div class="summary-row">
                                    <span class="summary-label">Subtotal</span>
                                    <span class="summary-value">₱{{ number_format($subtotal, 2) }}</span>
                                </div>
                            </div>

                            <div class="summary-total-row pb-4">
                                <span class="summary-total-label">Total</span>
                                <span class="summary-total-value">₱{{ number_format($subtotal, 2) }}</span>
                            </div>
                        </div>

                        <!-- Complete Purchase Button Under Card -->
                        <button 
                            type="submit" 
                            class="checkout-btn mt-4" 
                            style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 16px;"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Complete Purchase</span>
                        </button>
                        </div>
                    </div>
                </form>
                </div>
        </div>
    </div>
    </div>
</x-app-layout>
