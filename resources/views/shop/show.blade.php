<x-app-layout>
    @section('title', $product->name . ' - ' . config('app.name', 'IGP Hub'))

    <div style="background: #FFFAF1; min-height: 100vh; width: 100%;">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap');

        body {
            background: #FFFAF1 !important;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* Breadcrumb */
        .breadcrumb-nav {
            background: #FFFFFF;
            border-bottom: 1px solid #F0F0F0;
            padding: 12px 0;
            margin-top: 110px;
            padding-top: 12px;
        }

        .breadcrumb-nav a {
            color: #8B0000;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s;
        }

        .breadcrumb-nav a:hover {
            color: #A00000;
        }

        /* Main Content */
        .product-container {
            background: #FFFAF1;
            min-height: 100vh;
            padding: 48px 0;
        }

        .product-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: start;
        }

        @media (max-width: 1024px) {
            .product-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        /* Product Image */
        .product-image-wrapper {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 12px;
            overflow: hidden;
            aspect-ratio: 1;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #F5F5F5 0%, #EEEEEE 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #AAAAAA;
            font-size: 14px;
            font-weight: 500;
        }

        /* Product Details */
        .product-details h1 {
            color: #1a1a1a;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .product-meta {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .stock-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stock-badge.in-stock {
            background: #D4EDDA;
            color: #155724;
        }

        .stock-badge.low-stock {
            background: #FFF3CD;
            color: #856404;
        }

        .stock-badge.out-of-stock {
            background: #F8D7DA;
            color: #721C24;
        }

        .price-section {
            border-bottom: 1px solid #E8DCC8;
            padding-bottom: 24px;
            margin-bottom: 24px;
        }

        .product-price {
            font-size: 2.5rem;
            font-weight: 800;
            color: #8B0000;
            margin-bottom: 8px;
        }

        .product-description {
            color: #666666;
            line-height: 1.8;
            font-size: 16px;
            margin-bottom: 32px;
        }

        /* Variant Selection */
        .variant-section {
            margin-bottom: 32px;
        }

        .variant-label {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            display: block;
        }

        .variant-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 12px;
        }

        .variant-option {
            display: none;
        }

        .variant-option-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            background: #FFFFFF;
            border: 2px solid #E8DCC8;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            min-height: 60px;
            font-weight: 600;
            color: #666666;
            font-size: 14px;
        }

        .variant-option:checked + .variant-option-label {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            border-color: #8B0000;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.2);
        }

        .variant-option-label:hover {
            border-color: #8B0000;
        }

        /* Quantity Selector */
        .quantity-section {
            display: flex;
            gap: 16px;
            align-items: center;
            margin-bottom: 32px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #E8DCC8;
            border-radius: 8px;
            overflow: hidden;
            background: #FFFFFF;
        }

        .quantity-btn {
            background: transparent;
            border: none;
            padding: 12px 16px;
            color: #8B0000;
            font-weight: 700;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .quantity-btn:hover {
            background: #F9F9F9;
        }

        .quantity-input {
            width: 60px;
            border: none;
            text-align: center;
            background: transparent;
            font-weight: 700;
            font-size: 16px;
            color: #1a1a1a;
        }

        .quantity-info {
            font-size: 14px;
            color: #666666;
            font-weight: 500;
        }

        /* Add to Cart Button */
        .add-to-cart-btn {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            padding: 16px 32px;
            border-radius: 10px;
            border: none;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(139, 0, 0, 0.2);
            display: block;
            width: 100%;
            text-decoration: none;
            text-align: center;
        }

        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.3);
        }

        /* Benefits/Guarantee Section */
        .benefits-box {
            background: linear-gradient(135deg, #FFFAF1 0%, #FFFFFF 100%);
            border: 1px solid #F0F0F0;
            border-radius: 12px;
            padding: 24px;
            margin-top: 28px;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 16px;
        }

        .benefit-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 16px;
            background: #FFFFFF;
            border: 1px solid #E8DCC8;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .benefit-item:hover {
            border-color: #8B0000;
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .benefit-icon {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            font-weight: 700;
            font-size: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(139, 0, 0, 0.2);
        }

        .benefit-text {
            color: #666666;
            font-size: 12px;
            line-height: 1.5;
            font-weight: 500;
        }

        .benefit-text strong {
            color: #1a1a1a;
            display: block;
            margin-bottom: 4px;
            font-weight: 700;
            font-size: 13px;
        }

        /* Related Products */
        .related-section {
            border-top: 1px solid #E8DCC8;
            padding-top: 48px;
            margin-top: 48px;
        }

        .related-title {
            color: #1a1a1a;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 32px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 24px;
        }

        .related-card {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-color: #8B0000;
        }

        .related-image {
            background: linear-gradient(135deg, #F5F5F5 0%, #EEEEEE 100%);
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .related-info {
            padding: 16px;
        }

        .related-name {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .related-price {
            color: #8B0000;
            font-weight: 700;
            font-size: 16px;
        }
    </style>

    <!-- Breadcrumb -->
    <div class="breadcrumb-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav style="display: flex; gap: 8px; align-items: center; font-size: 14px;">
                <a href="{{ route('home') }}">Home</a>
                <span style="color: #CCC;">/</span>
                <a href="{{ route('shop.index') }}">Shop</a>
                <span style="color: #CCC;">/</span>
                <span style="color: #666666;">{{ $product->name }}</span>
            </nav>
        </div>
    </div>

    <!-- Product Details -->
    <div class="product-container">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="product-grid">
                <!-- Product Image -->
                <div class="product-image-wrapper">
                    @if(!empty($product->image_url))
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @elseif($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div class="product-image-placeholder">No Image</div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="product-details">
                    <h1>{{ $product->name }}</h1>

                    <!-- Meta Info -->
                    <div class="product-meta">
                        @php
                            // Check product current_stock, not just variants
                            $currentStock = $product->current_stock;
                        @endphp
                        @if ($currentStock > $product->low_stock_threshold)
                            <span class="stock-badge in-stock">In Stock</span>
                        @elseif ($currentStock > 0)
                            <span class="stock-badge low-stock">Low Stock</span>
                        @else
                            <span class="stock-badge out-of-stock">Out of Stock</span>
                        @endif
                    </div>

                    <!-- Price -->
                    <div class="price-section">
                        <div class="product-price" id="display-price">₱{{ number_format($product->base_price, 2) }}</div>
                        <div style="color: #888888; font-size: 14px; display: flex; align-items: center; gap: 12px; margin-top: 8px;">
                            <span>Total Stock: <span style="font-weight: 700; color: #1a1a1a;">{{ $currentStock }} units</span></span>
                            @if ($currentStock > 0 && $currentStock <= $product->low_stock_threshold)
                                <span style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; box-shadow: 0 2px 6px rgba(245, 158, 11, 0.3); animation: pulse 2s infinite;">
                                    ⚠️ Only {{ $currentStock }} left!
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="product-description">{{ $product->description ?? 'Premium quality product with excellent craftsmanship.' }}</p>

                    <!-- Variants -->
                    @if($product->variants->count() > 0)
                        <div class="variant-section">
                            <label class="variant-label">Select {{ $product->variants->count() > 1 ? ($product->name === 'Custom T-Shirt' ? 'Size' : 'Capacity') : 'Option' }}</label>
                            <div class="variant-options">
                                @foreach($product->variants as $index => $variant)
                                    <input type="radio" name="variant_id" id="variant_{{ $variant->id }}" value="{{ $variant->id }}" class="variant-option" {{ $index === 0 ? 'checked' : '' }} data-price="{{ $variant->getFinalPrice() }}" data-stock="{{ $variant->stock_quantity }}">
                                    <label for="variant_{{ $variant->id }}" class="variant-option-label">{{ $variant->name }}</label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Quantity & Add to Cart -->
                    <form id="add-to-cart-form" method="POST" action="{{ route('cart.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if($product->variants->count() > 0)
                            <input type="hidden" name="variant_id" id="selected_variant" value="{{ $product->variants->first()->id }}">
                        @endif

                        <div class="quantity-section">
                            <div>
                                <label style="display: block; font-weight: 700; font-size: 14px; color: #1a1a1a; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Quantity</label>
                                <div class="quantity-control">
                                    <button type="button" class="quantity-btn" onclick="decreaseQty()">−</button>
                                    <input type="number" name="quantity" id="quantity_input" min="1" value="1" class="quantity-input" readonly>
                                    <button type="button" class="quantity-btn" onclick="increaseQty()">+</button>
                                </div>
                            </div>
                            <div class="quantity-info">
                                Max: <span id="max_qty">{{ $product->current_stock }}</span> available
                            </div>
                        </div>

                        @if($product->current_stock > 0)
                            @auth
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            @else
                                <a href="{{ route('login') }}" class="add-to-cart-btn">Sign In to Purchase</a>
                            @endauth
                        @else
                            <div style="background: #F8D7DA; border: 1px solid #F5C6CB; color: #721C24; padding: 16px; border-radius: 10px; text-align: center; font-weight: 600;">
                                Out of Stock
                            </div>
                        @endif
                    </form>

                    <!-- Benefits & Guarantees -->
                    <div class="benefits-box">
                        <div class="benefits-grid">
                            <div class="benefit-item">
                                <div class="benefit-icon">✓</div>
                                <div class="benefit-text">
                                    <strong>Quality Assured</strong>
                                    100% satisfaction guaranteed
                                </div>
                            </div>
                            <div class="benefit-item">
                                <div class="benefit-icon">💳</div>
                                <div class="benefit-text">
                                    <strong>Easy Payment</strong>
                                    Multiple payment methods
                                </div>
                            </div>
                            <div class="benefit-item">
                                <div class="benefit-icon">🎯</div>
                                <div class="benefit-text">
                                    <strong>Student Support</strong>
                                    Support the student council
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="related-section">
                    <h2 class="related-title">Related Products</h2>
                    <div class="related-grid">
                        @foreach($relatedProducts as $related)
                            <a href="{{ route('shop.show', $related->slug) }}" class="related-card">
                                <div class="related-image">
                                    @if($related->image_path)
                                        <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="related-info">
                                    <div class="related-name">{{ $related->name }}</div>
                                    <div class="related-price">₱{{ number_format($related->base_price, 2) }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- SweetAlert2 for small centered 'Added to cart' feedback -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function decreaseQty() {
            const input = document.getElementById('quantity_input');
            if (input.value > 1) input.value--;
        }

        function increaseQty() {
            const input = document.getElementById('quantity_input');
            const maxQty = parseInt(document.getElementById('max_qty').textContent);
            if (parseInt(input.value) < maxQty) input.value++;
        }

        // Function to format price
        function formatPrice(price) {
            return '₱' + parseFloat(price).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }

        // Update variant selection and stock when variant changes
        document.querySelectorAll('input[name="variant_id"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('selected_variant').value = this.value;
                
                // Get variant data
                const variantStock = parseInt(this.getAttribute('data-stock'));
                const variantPrice = parseFloat(this.getAttribute('data-price'));
                
                // Update price with smooth animation
                const priceElement = document.getElementById('display-price');
                priceElement.style.opacity = '0.5';
                priceElement.style.transform = 'scale(0.95)';
                priceElement.style.transition = 'all 0.3s ease-out';
                
                setTimeout(() => {
                    priceElement.textContent = formatPrice(variantPrice);
                    priceElement.style.opacity = '1';
                    priceElement.style.transform = 'scale(1)';
                }, 150);
                
                // Update max quantity based on selected variant's stock
                document.getElementById('max_qty').textContent = variantStock;
                document.getElementById('quantity_input').value = 1;
                
                // Update add to cart button visibility
                const addBtn = document.querySelector('.add-to-cart-btn');
                const outOfStockMsg = document.querySelector('[style*="F8D7DA"]');
                if (variantStock > 0) {
                    if (addBtn) addBtn.style.display = 'block';
                    if (outOfStockMsg) outOfStockMsg.style.display = 'none';
                } else {
                    if (addBtn) addBtn.style.display = 'none';
                    if (outOfStockMsg) outOfStockMsg.style.display = 'block';
                }
            });
        });

        // Show a small centered success alert when user presses "Add to Cart".
        document.addEventListener('DOMContentLoaded', function () {
            const cartForm = document.getElementById('add-to-cart-form');
            if (!cartForm) return;

            cartForm.addEventListener('submit', function (e) {
                // Prevent navigating away immediately so user sees the feedback
                e.preventDefault();

                Swal.fire({
                    icon: 'success',
                    title: 'Added to cart',
                    showConfirmButton: false,
                    timer: 900,
                    position: 'center',
                    width: 260,
                    padding: '0.8rem 1rem',
                });

                // Submit after the timer so the alert is visible briefly
                setTimeout(() => cartForm.submit(), 900);
            });
        });
    </script>

    <!-- Reviews Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="product-card p-8 mb-8">
            <h2 class="text-3xl font-bold mb-8" style="color: #1a1a1a; font-family: 'Poppins', sans-serif;">⭐ Customer Reviews</h2>
            
            @if($reviews->count() > 0)
                <!-- Review Summary -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 pb-12" style="border-bottom: 2px solid #E8E8E8;">
                    <!-- Average Rating -->
                    <div class="text-center">
                        <div class="text-6xl font-bold mb-2" style="color: #8B0000;">{{ number_format($averageRating, 1) }}</div>
                        <div class="flex justify-center gap-1 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6" fill="{{ $i <= round($averageRating) ? '#DAA520' : '#E8E8E8' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm text-gray-600 font-semibold">Based on {{ $reviews->count() }} {{ Str::plural('review', $reviews->count()) }}</p>
                    </div>

                    <!-- Rating Breakdown -->
                    <div class="md:col-span-2">
                        @foreach([5, 4, 3, 2, 1] as $star)
                            @php
                                $count = $ratingBreakdown[$star] ?? 0;
                                $percentage = $reviews->count() > 0 ? ($count / $reviews->count()) * 100 : 0;
                            @endphp
                            <div class="flex items-center gap-3 mb-2">
                                <div class="flex items-center gap-1 w-16">
                                    <span class="text-sm font-bold">{{ $star }}</span>
                                    <svg class="w-4 h-4" fill="#DAA520" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="h-3 rounded-full" style="background: #E8E8E8;">
                                        <div class="h-3 rounded-full transition-all duration-500" style="width: {{ $percentage }}%; background: linear-gradient(135deg, #DAA520, #FFD700);"></div>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-gray-600 w-12 text-right">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Review Form (Only for verified purchases) -->
            @auth
                @if($canReview)
                    <div class="mb-12 p-6 rounded-xl" style="background: rgba(218, 165, 32, 0.05); border: 2px solid rgba(218, 165, 32, 0.2);">
                        <h3 class="text-xl font-bold mb-4" style="color: #1a1a1a;">Write a Review</h3>
                        <form method="POST" action="{{ route('reviews.store', $product) }}" x-data="{ rating: 0 }">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="rating" x-model="rating">

                            <!-- Star Rating Selector -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" style="color: #1a1a1a;">Your Rating</label>
                                <div class="flex gap-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button 
                                            type="button"
                                            @click="rating = {{ $i }}"
                                            class="transition-transform hover:scale-110"
                                        >
                                            <svg 
                                                class="w-10 h-10 cursor-pointer transition-colors" 
                                                :fill="rating >= {{ $i }} ? '#DAA520' : '#E8E8E8'"
                                                viewBox="0 0 20 20"
                                            >
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </button>
                                    @endfor
                                </div>
                                @error('rating')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Comment -->
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" style="color: #1a1a1a;">Your Review</label>
                                <textarea 
                                    name="comment" 
                                    rows="4" 
                                    class="w-full px-4 py-3 rounded-lg border-2 focus:outline-none focus:border-opacity-100 transition-colors"
                                    style="border-color: #E8E8E8; background: #FFFFFF;"
                                    placeholder="Share your experience with this product..."
                                    required
                                ></textarea>
                                @error('comment')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button 
                                type="submit" 
                                class="px-6 py-3 rounded-lg font-bold text-white transition-all duration-300"
                                style="background: linear-gradient(135deg, #8B0000, #A00000); box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);"
                                onmouseover="this.style.background='linear-gradient(135deg, #A00000, #C00000)'; this.style.boxShadow='0 6px 16px rgba(139, 0, 0, 0.4)';"
                                onmouseout="this.style.background='linear-gradient(135deg, #8B0000, #A00000)'; this.style.boxShadow='0 4px 12px rgba(139, 0, 0, 0.3)';"
                            >
                                Submit Review
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

            <!-- Reviews List -->
            @if($reviews->count() > 0)
                <div class="space-y-6">
                    @foreach($reviews as $review)
                        <div class="p-6 rounded-xl" style="background: #F9F9F9; border: 2px solid #E8E8E8;">
                            <div class="flex items-start gap-4">
                                <!-- User Avatar -->
                                <div class="flex-shrink-0">
                                    @if($review->user->profile_picture)
                                        <img src="{{ asset('storage/' . $review->user->profile_picture) }}" alt="{{ $review->user->name }}" class="w-12 h-12 rounded-full object-cover border-2" style="border-color: #DAA520;">
                                    @else
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold" style="background: linear-gradient(135deg, #DAA520, #FFD700);">
                                            {{ substr($review->user->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <!-- Header -->
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <h4 class="font-bold text-base" style="color: #1a1a1a;">{{ $review->user->name }}</h4>
                                            <div class="flex items-center gap-2 mt-1">
                                                <div class="flex gap-0.5">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4" fill="{{ $i <= $review->rating ? '#DAA520' : '#E8E8E8' }}" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                @if($review->verified_purchase)
                                                    <span class="text-xs font-semibold px-2 py-0.5 rounded" style="background: rgba(16, 185, 129, 0.1); color: #10B981;">✓ Verified Purchase</span>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>

                                    <!-- Comment -->
                                    <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>

                                    <!-- Actions (if user owns review) -->
                                    @auth
                                        @if($review->user_id === auth()->id())
                                            <div class="flex gap-3 mt-3">
                                                <button 
                                                    type="button"
                                                    onclick="if(confirm('Delete this review?')) document.getElementById('delete-review-{{ $review->id }}').submit();"
                                                    class="text-sm font-semibold text-red-600 hover:text-red-700 transition-colors"
                                                >
                                                    Delete
                                                </button>
                                                <form id="delete-review-{{ $review->id }}" method="POST" action="{{ route('reviews.destroy', $review) }}" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($reviews->hasPages())
                    <div class="mt-8">
                        {{ $reviews->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    <h3 class="text-xl font-bold mb-2" style="color: #666;">No reviews yet</h3>
                    <p class="text-gray-600">Be the first to review this product!</p>
                </div>
            @endif
        </div>
    </div>

    </div>
</x-app-layout>
