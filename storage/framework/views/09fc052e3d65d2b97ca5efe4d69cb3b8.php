<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Shop - ' . config('app.name', 'IGP Hub')); ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap');

        body {
            background: #FFFAF1 !important;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        .shop-hero {
            background: linear-gradient(135deg, #FFFAF1 0%, #FFFFFF 100%);
            border-bottom: 2px solid #F0F0F0;
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
            background: #FFFAF1;
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
    <div style="background: linear-gradient(135deg, rgba(139, 0, 0, 0.9) 0%, rgba(160, 0, 0, 0.9) 100%), url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1200&h=500&fit=crop') center/cover; min-height: 550px; display: flex; align-items: center; justify-content: center; position: relative;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="text-align: center; color: white; z-index: 10;">
            <div class="max-w-4xl mx-auto text-center">
                <p style="font-size: 22px; color: rgba(255, 255, 255, 0.98); text-shadow: 0 3px 8px rgba(0, 0, 0, 0.5); letter-spacing: 0.5px; margin-bottom: 12px;">📦 CICT Student Council Store</p>
                <h1 style="font-size: 62px; font-weight: 900; color: #FFFFFF; text-shadow: 0 4px 16px rgba(0, 0, 0, 0.6); letter-spacing: -2px; margin-bottom: 16px; line-height: 1.2;">Premium Merchandise</h1>
                <p style="font-size: 19px; color: rgba(255, 255, 255, 0.98); max-width: 750px; margin: 0 auto; text-shadow: 0 3px 8px rgba(0, 0, 0, 0.5); line-height: 1.6;">Discover exclusive, high-quality merchandise from ISUFST Dingle Campus CICT Student Council. Every purchase supports student initiatives and campus activities.</p>
            </div>
        </div>
    </div>

    <!-- Products Section Wrapper -->
    <div style="background: #FFFAF1; min-height: auto; width: 100%; padding-top: 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 shop-content">
        <?php if($products->count() > 0): ?>
            <div class="products-header" style="margin-top: 40px;">
                <div class="products-header-left">
                    <h2>Featured Products</h2>
                    <p><?php echo e($products->total()); ?> items available for purchase</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-card reveal-on-scroll" data-reveal-delay="<?php echo e(($loop->index % 4) * 100); ?>">
                        <div class="product-badge">Campus</div>
                        
                        <!-- Stock Indicator Badge -->
                        <?php if($product->current_stock > 0 && $product->current_stock <= $product->low_stock_threshold): ?>
                            <div style="position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; z-index: 10; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4); animation: pulse 2s infinite;">
                                ⚠️ Only <?php echo e($product->current_stock); ?> left!
                            </div>
                        <?php elseif($product->current_stock == 0): ?>
                            <div style="position: absolute; top: 12px; right: 12px; background: linear-gradient(135deg, #dc2626, #991b1b); color: white; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; z-index: 10; box-shadow: 0 2px 8px rgba(220, 38, 38, 0.4);">
                                ❌ Out of Stock
                            </div>
                        <?php endif; ?>
                        
                        <!-- Product Image -->
                        <div class="product-image-container">
                            <?php if($product->image_path): ?>
                                <img src="<?php echo e(asset('storage/' . $product->image_path)); ?>" alt="<?php echo e($product->name); ?>" class="product-image">
                            <?php else: ?>
                                <div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; color: #AAAAAA; font-size: 14px; font-weight: 500;">
                                    No Image
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Product Info -->
                        <div class="product-info">
                            <h3><?php echo e($product->name); ?></h3>
                            <p><?php echo e(Str::limit($product->description, 70)); ?></p>
                            <div class="product-price">
                                <span>₱<?php echo e(number_format($product->base_price, 2)); ?></span>
                            </div>
                            <a href="<?php echo e(route('shop.show', $product->slug)); ?>" class="btn-view-details">View Details</a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <?php if($products->hasPages()): ?>
                <div class="mt-20 flex justify-center mb-12">
                    <div style="background: #FFFFFF; border-radius: 12px; padding: 16px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);">
                        <?php echo e($products->links()); ?>

                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div style="text-align: center; padding: 80px 0;">
                <p class="empty-state-text" style="font-size: 18px; margin-bottom: 10px;">No products available</p>
                <p style="color: #999999; font-size: 14px;">Check back soon for new items!</p>
            </div>
        <?php endif; ?>
    </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\shop\index.blade.php ENDPATH**/ ?>