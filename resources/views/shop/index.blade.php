<x-app-layout>
    @section('title', 'Shop - ' . config('app.name', 'IGP Hub'))

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap');

        body {
            background: #F8FAFC !important;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* Mobile-First Styles (< 640px) */
        @media (max-width: 639px) {
            /* Red hero section - extends below navbar with more height */
            div[style*="min-height: 550px"] {
                min-height: 320px !important;
                padding: 1.5rem 1rem 2.5rem 1rem !important;
                margin-top: 0 !important;
                padding-top: 5rem !important;
            }
            
            /* Hero text on red background */
            div[style*="min-height: 550px"] p:first-of-type {
                font-size: 0.875rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            div[style*="min-height: 550px"] h1 {
                font-size: 1.75rem !important;
                letter-spacing: -0.5px !important;
                margin-bottom: 0.75rem !important;
                line-height: 1.2 !important;
            }
            
            div[style*="min-height: 550px"] p:last-of-type {
                font-size: 0.8125rem !important;
                line-height: 1.5 !important;
            }
            
            /* White background starts at Featured Products */
            .shop-content {
                background: #FFFFFF !important;
                padding-top: 1.5rem !important;
            }
            
            .products-header {
                margin-top: 0 !important;
            }
            
            /* Mobile Grid: 2 columns */
            .grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.5rem !important;
                padding: 0.5rem !important;
            }
            
            /* Mobile Product Card */
            .product-card {
                border-radius: 0.5rem !important;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
            }
            
            .product-card:hover {
                transform: none !important;
            }
            
            /* Mobile Image: Square 1:1 */
            .product-image-container {
                height: 0 !important;
                padding-bottom: 100% !important;
                position: relative !important;
            }
            
            .product-image {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
            }
            
            /* Mobile Product Info - Compact */
            .product-info {
                padding: 0.5rem !important;
            }
            
            .product-card h3 {
                font-size: 0.7rem !important;
                line-height: 1.1 !important;
                margin-bottom: 0.25rem !important;
                display: -webkit-box !important;
                -webkit-line-clamp: 2 !important;
                -webkit-box-orient: vertical !important;
                overflow: hidden !important;
                font-weight: 600 !important;
            }
            
            .product-card p {
                display: none !important;
            }
            
            /* Mobile Price */
            .product-price {
                font-size: 0.8rem !important;
                margin-bottom: 0.375rem !important;
                font-weight: 800 !important;
            }
            
            /* Mobile Button */
            .btn-view-details {
                padding: 0.5rem !important;
                font-size: 0.75rem !important;
            }
            
            /* Mobile Badges */
            .product-badge {
                font-size: 0.625rem !important;
                padding: 0.25rem 0.5rem !important;
            }
            
            div[style*="position: absolute"][style*="top: 12px"][style*="right: 12px"] {
                font-size: 0.625rem !important;
                padding: 0.25rem 0.5rem !important;
            }
        }

        .shop-hero {
            background: #F7F8FB;
            border-bottom: 2px solid #E5E7EB;
        }

        .shop-hero h1 {
            color: #1a1a1a !important;
            font-weight: 800;
            font-size: 2.8rem;
            margin-bottom: 12px;
        }

        .shop-hero .hero-subtitle {
            color: #8B0000;
            font-weight: 700;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .shop-hero p {
            color: #666666 !important;
            font-size: 1.05rem;
            font-weight: 400;
            line-height: 1.7;
            max-width: 600px;
            margin: 0 auto;
        }

        .shop-content {
            background: #F7F8FB;
        }

        .products-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 2px solid #F0F0F0;
        }

        .products-header-left h2 {
            color: #1a1a1a;
            font-size: 1.8rem;
            margin: 0;
            margin-bottom: 4px;
        }

        .products-header-left p {
            color: #888888;
            margin: 0;
            font-size: 14px;
        }

        .product-card {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
            border-color: #8B0000;
        }

        .product-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(139, 0, 0, 0.3);
        }

        .product-image-container {
            background: linear-gradient(135deg, #F5F5F5 0%, #EEEEEE 100%);
            height: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .product-card h3 {
            color: #1a1a1a !important;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 8px;
            margin-top: 0;
            line-height: 1.4;
        }

        .product-card p {
            color: #888888 !important;
            font-size: 13px;
            line-height: 1.5;
            margin: 0 0 12px 0;
            flex-grow: 1;
        }

        .product-price {
            color: #8B0000 !important;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.4rem;
            margin-bottom: 16px;
            display: flex;
            align-items: baseline;
            gap: 8px;
        }

        .price-label {
            font-size: 11px;
            color: #999999;
            font-weight: 600;
            text-transform: uppercase;
        }

        .btn-view-details {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            border: none;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(139, 0, 0, 0.2);
            text-decoration: none;
            text-align: center;
            display: block;
            cursor: pointer;
        }

        .btn-view-details:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.3);
            background: linear-gradient(135deg, #A00000 0%, #B00000 100%);
        }

        .empty-state-text {
            color: #1a1a1a;
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- Hero Section -->
    <div style="background: linear-gradient(135deg, rgba(139, 0, 0, 0.88) 0%, rgba(160, 0, 0, 0.86) 100%), url('https://img.freepik.com/free-photo/empty-shopping-trolley-left-outside_53876-31323.jpg?semt=ais_hybrid&w=740&q=80') center/cover; min-height: 86vh; display: flex; align-items: center; justify-content: center; position: relative; border-radius: 0 0 32px 32px; box-shadow: inset 0 -90px 160px rgba(0,0,0,0.18); margin-top: -70px; padding-top: 200px; padding-bottom: 150px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="text-align: center; color: white; z-index: 10;">
            <div class="max-w-4xl mx-auto text-center">
                <p style="font-size: 20px; color: rgba(255, 255, 255, 0.92); text-shadow: 0 3px 8px rgba(0, 0, 0, 0.5); letter-spacing: 0.6px; margin-bottom: 10px;">📦 CICT Student Council Store</p>
                <h1 style="font-size: 58px; font-weight: 900; color: #FFFFFF; text-shadow: 0 4px 16px rgba(0, 0, 0, 0.6); letter-spacing: -1.6px; margin-bottom: 14px; line-height: 1.15;">Premium Merchandise</h1>
                <p style="font-size: 19px; color: rgba(255, 255, 255, 0.94); max-width: 760px; margin: 0 auto; text-shadow: 0 3px 8px rgba(0, 0, 0, 0.5); line-height: 1.65;">Exclusive, high-quality campus merch   from shirts to keepsakes. Every purchase powers student initiatives and events.</p>
            </div>
        </div>
    </div>

    <!-- Products Section Wrapper -->
    <div style="background: #F7F8FB; min-height: auto; width: 100%; padding-top: 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 shop-content">
        @if($products->count() > 0)
            <div class="products-header" style="margin-top: 0px;">
                <div class="products-header-left">
                    <h2>Featured Products</h2>
                    <p>{{ $products->total() }} items available for purchase</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                    @php
                        $stock = $product->current_stock;
                        $stockLabel = isset($stock) ? ($stock > 0 ? $stock . ' in stock' : 'Out of stock') : 'Stock info unavailable';
                    @endphp
                    <a href="{{ route('shop.show', $product->slug) }}" class="product-card reveal-on-scroll" data-reveal-delay="{{ ($loop->index % 4) * 100 }}" style="text-decoration: none;">
                        <div class="product-badge">{{ $stockLabel }}</div>
                        
                        <!-- Stock Indicator Badge -->
                        @if($product->current_stock > 0 && $product->current_stock <= $product->low_stock_threshold)
                            <div style="position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; z-index: 10; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4); animation: pulse 2s infinite;">
                                ⚠️ Only {{ $product->current_stock }} left!
                            </div>
                        @elseif($product->current_stock == 0)
                            <div style="position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, #dc2626, #991b1b); color: white; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; z-index: 10; box-shadow: 0 2px 8px rgba(220, 38, 38, 0.4);">
                                ❌ Out of Stock
                            </div>
                        @endif
                        
                        <!-- Product Image -->
                        <div class="product-image-container">
                            @if(!empty($product->image_url))
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                            @elseif(!empty($product->image_path))
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                            @else
                                <div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; color: #AAAAAA; font-size: 14px; font-weight: 500;">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="product-info">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ Str::limit($product->description, 70) }}</p>
                            <div class="product-price">
                                <span>₱{{ number_format($product->base_price, 2) }}</span>
                            </div>
                            <span class="btn-view-details">View Details</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-20 flex justify-center mb-12">
                    <div style="background: #FFFFFF; border-radius: 12px; padding: 16px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 80px 0;">
                <p class="empty-state-text" style="font-size: 18px; margin-bottom: 10px;">No products available</p>
                <p style="color: #999999; font-size: 14px;">Check back soon for new items!</p>
            </div>
        @endif
    </div>
    </div>
</x-app-layout>
