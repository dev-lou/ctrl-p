<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => ['title' => 'Shopping Cart - CICT Merch']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Shopping Cart - CICT Merch')]); ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap');

        body {
            background: #FFFAF1 !important;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        .animated-gradient-cart {
            background: #FFFAF1;
            min-height: 100vh;
            padding-top: 120px;
            padding-bottom: 80px;
        }

        /* Page Header */
        .cart-header {
            margin-bottom: 32px;
        }

        .cart-header h1 {
            color: #1a1a1a;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .cart-header-badge {
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

        /* Cart Item Card */
        .cart-item-card {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .cart-item-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
            border-color: #8B0000;
        }

        .product-image-container {
            flex-shrink-0;
            width: 120px;
            height: 120px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #F0F0F0;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #F5F5F5 0%, #EEEEEE 100%);
        }

        .product-image-container:hover {
            border-color: #8B0000;
        }

        .product-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #F5F5F5 0%, #EEEEEE 100%);
        }

        /* Order Summary Card */
        .order-summary-card {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            backdrop-filter: none;
        }

        /* Success Message */
        .success-message {
            background: #D4EDDA;
            border: 1px solid #C3E6CB;
            border-radius: 10px;
            color: #155724;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .success-message svg {
            color: #155724;
        }

        /* Quantity Controls */
        .qty-controls {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .qty-controls:focus-within {
            border-color: #8B0000;
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
        }

        .qty-btn {
            padding: 10px 14px;
            font-weight: 700;
            color: #8B0000;
            cursor: pointer;
            transition: all 0.2s ease;
            background: transparent;
            border: none;
            font-size: 18px;
        }

        .qty-btn:hover {
            background: #F0F0F0;
            color: #A00000;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            font-weight: 700;
            color: #1a1a1a;
            background: transparent;
            border: none;
            padding: 6px 0;
        }

        .qty-input:focus {
            outline: none;
        }

        .quantity-info {
            font-size: 14px;
            color: #888888;
            font-weight: 500;
        }

        /* Remove Button */
        .remove-btn {
            color: white;
            background: linear-gradient(135deg, #FF5252 0%, #FF3838 100%);
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 8px rgba(255, 82, 82, 0.3);
            font-size: 15px;
            letter-spacing: 0.3px;
        }

        .remove-btn:hover {
            background: linear-gradient(135deg, #FF3838 0%, #E63946 100%);
            box-shadow: 0 6px 16px rgba(255, 82, 82, 0.4);
            transform: translateY(-2px);
        }

        .remove-btn:active {
            transform: translateY(0);
        }

        /* Continue Shopping Button */
        .continue-shopping-btn {
            background: linear-gradient(135deg, #F5F5F5 0%, #EEEEEE 100%);
            color: #8B0000;
            border: 2px solid #8B0000;
            padding: 12px 24px;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
        }

        .continue-shopping-btn:hover {
            background: linear-gradient(135deg, #FFFFFF 0%, #F5F5F5 100%);
            color: #A00000;
            border-color: #A00000;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.2);
        }

        /* Checkout Button */
        .checkout-btn {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            padding: 14px 24px;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 16px;
            box-shadow: 0 2px 8px rgba(139, 0, 0, 0.2);
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #A00000 0%, #8B0000 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.3);
        }

        /* Empty Cart State */
        .empty-cart-icon {
            color: rgba(218, 165, 32, 0.3);
        }

        .empty-cart-message {
            color: #1a1a1a;
        }

        .empty-cart-subtitle {
            color: #888888;
        }

        /* Text Colors */
        .cart-text {
            color: #1a1a1a;
            font-weight: 600;
        }

        .cart-label {
            color: #888888;
            font-weight: 500;
        }

        .cart-total {
            color: #8B0000;
            font-weight: 700;
        }

        .product-name-link {
            color: #8B0000;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .product-name-link:hover {
            color: #A00000;
        }

        /* Summary Labels */
        .summary-label {
            color: #888888;
            font-weight: 600;
            font-size: 14px;
        }

        .summary-value {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 16px;
        }

        .summary-total-label {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 16px;
        }

        .summary-total-value {
            color: #8B0000;
            font-weight: 800;
            font-size: 28px;
        }

        /* Divider */
        .divider {
            border-color: #F0F0F0;
        }

        @media (max-width: 768px) {
            .product-image-container {
                width: 100px;
                height: 100px;
            }
            
            /* Sticky checkout button on mobile */
            .mobile-sticky-checkout {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: #FFFFFF;
                padding: 16px;
                box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
                z-index: 50;
                border-top: 2px solid rgba(139, 0, 0, 0.1);
            }

            .mobile-checkout-content {
                max-width: 100%;
                margin: 0 auto;
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .mobile-total-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 8px;
            }
        }

        .touch-target {
            min-height: 44px;
            min-width: 44px;
        }

        /* Smooth animations */
        .fade-in-scale {
            animation: fadeInScale 0.3s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0.7;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .price-pulse {
            animation: pricePulse 0.5s ease-out;
        }

        @keyframes pricePulse {
            0% {
                color: #8B0000;
            }
            50% {
                color: #FFD700;
            }
            100% {
                color: #8B0000;
            }
        }

        .smooth-transition {
            transition: all 0.3s ease-in-out;
        }
    </style>

    <style>
        .small-swal .swal2-popup {
            font-size: 14px !important;
        }
        .small-swal .swal2-title {
            font-size: 16px !important;
        }
        .small-swal .swal2-html-container {
            font-size: 14px !important;
        }
    </style>
    
    <div class="animated-gradient-cart">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="cart-header">
                <h1>🛒 Shopping Cart</h1>
                <div class="cart-header-badge" style="display:flex; align-items:center; gap:8px;">
                    <?php
                        $totalQty = 0;
                        foreach ($items as $it) { $totalQty += $it['quantity'] ?? 1; }
                    ?>
                    <span class="cart-count-badge"><?php echo e($totalQty); ?></span>
                    <div style="font-weight:600; font-size:14px; color:var(--text-dark);"><?php echo e($totalQty === 1 ? 'item' : 'items'); ?> in your cart</div>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="success-message mb-8 rounded-lg p-6 flex items-start gap-4">
                    <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p style="margin: 0; font-weight: 600;"><?php echo e(session('success')); ?></p>
                </div>
            <?php endif; ?>

            <?php if(count($items) > 0): ?>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Desktop Table View (Hidden on Mobile) -->
                    <div class="hidden md:block lg:col-span-2">
                        <div class="cart-item-card overflow-hidden">
                            <table class="w-full">
                                <thead style="background: linear-gradient(135deg, #F5F5F5 0%, #EEEEEE 100%); border-bottom: 2px solid rgba(139, 0, 0, 0.1);">
                                    <tr>
                                        <th class="px-6 py-4 text-left summary-label" style="font-size: 13px;">Product</th>
                                        <th class="px-6 py-4 text-left summary-label" style="font-size: 13px;">Price</th>
                                        <th class="px-6 py-4 text-center summary-label" style="font-size: 13px;">Quantity</th>
                                        <th class="px-6 py-4 text-right summary-label" style="font-size: 13px;">Subtotal</th>
                                        <th class="px-6 py-4 text-center summary-label" style="font-size: 13px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="border-bottom: 1px solid #F0F0F0; transition: all 0.2s ease;" onmouseover="this.style.background='#FFFAF1'" onmouseout="this.style.background='#FFFFFF'">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-4">
                                                    <div class="product-image-container" style="width: 80px; height: 80px;">
                                                        <?php if($item['product']->image_path): ?>
                                                            <img src="<?php echo e(asset('storage/' . $item['product']->image_path)); ?>" alt="<?php echo e($item['product']->name); ?>">
                                                        <?php else: ?>
                                                            <div class="product-placeholder">
                                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                                </svg>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <a href="<?php echo e(route('shop.show', $item['product'])); ?>" class="product-name-link text-base font-bold">
                                                            <?php echo e($item['product']->name); ?>

                                                        </a>
                                                        <?php if($item['variant']): ?>
                                                            <p class="cart-label text-xs mt-1">🎨 <?php echo e($item['variant']->name); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="cart-text text-base font-semibold">₱<?php echo e(number_format($item['price'], 2)); ?></span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex justify-center">
                                                    <div class="qty-controls">
                                                        <button type="button" class="qty-btn" onclick="decreaseQty('<?php echo e($item['key']); ?>')">−</button>
                                                        <input type="number" class="qty-input qty-value-<?php echo e($item['key']); ?>" value="<?php echo e($item['quantity']); ?>" min="1" readonly>
                                                        <button type="button" class="qty-btn" onclick="increaseQty('<?php echo e($item['key']); ?>')">+</button>
                                                    </div>
                                                    <input type="hidden" class="price-value-<?php echo e($item['key']); ?>" value="<?php echo e($item['price']); ?>">
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <span class="cart-total text-lg font-bold">₱<?php echo e(number_format($item['total'], 2)); ?></span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <form id="remove-form-<?php echo e($item['key']); ?>" method="POST" action="<?php echo e(route('cart.destroy', $item['key'])); ?>" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="remove-btn text-xs px-4 py-2" onclick="confirmRemove('<?php echo e($item['key']); ?>')">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Mobile Card View (Hidden on Desktop) -->
                    <div class="md:hidden lg:col-span-2 space-y-4 pb-32">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="cart-item-card p-4">
                                <div class="flex gap-4 items-start">
                                    <div class="product-image-container" style="width: 80px; height: 80px;">
                                        <?php if($item['product']->image_path): ?>
                                            <img src="<?php echo e(asset('storage/' . $item['product']->image_path)); ?>" alt="<?php echo e($item['product']->name); ?>">
                                        <?php else: ?>
                                            <div class="product-placeholder">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="flex-grow min-w-0">
                                        <h3 class="text-sm font-bold cart-text mb-1">
                                            <a href="<?php echo e(route('shop.show', $item['product'])); ?>" class="product-name-link">
                                                <?php echo e($item['product']->name); ?>

                                            </a>
                                        </h3>
                                        <?php if($item['variant']): ?>
                                            <p class="cart-label text-xs mb-3">🎨 <?php echo e($item['variant']->name); ?></p>
                                        <?php endif; ?>

                                        <div class="grid grid-cols-2 gap-3 mb-3 pb-3 border-b divider">
                                            <div>
                                                <p class="summary-label text-xs mb-1">Price</p>
                                                <p class="cart-text text-sm font-semibold">₱<?php echo e(number_format($item['price'], 2)); ?></p>
                                            </div>
                                            <div>
                                                <p class="summary-label text-xs mb-1">Subtotal</p>
                                                <p class="cart-total text-sm font-bold">₱<?php echo e(number_format($item['total'], 2)); ?></p>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between gap-2">
                                            <div class="qty-controls">
                                                <button type="button" class="qty-btn touch-target" onclick="decreaseQty('<?php echo e($item['key']); ?>')">−</button>
                                                <input type="number" class="qty-input qty-value-<?php echo e($item['key']); ?>" value="<?php echo e($item['quantity']); ?>" min="1" readonly>
                                                <button type="button" class="qty-btn touch-target" onclick="increaseQty('<?php echo e($item['key']); ?>')">+</button>
                                            </div>
                                            <input type="hidden" class="price-value-<?php echo e($item['key']); ?>" value="<?php echo e($item['price']); ?>">
                                            
                                            <form id="remove-form-<?php echo e($item['key']); ?>" method="POST" action="<?php echo e(route('cart.destroy', $item['key'])); ?>" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" class="remove-btn text-xs px-3 py-2 touch-target" onclick="confirmRemove('<?php echo e($item['key']); ?>')">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Cart Items -->
                    <div class="hidden">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="cart-item-card p-6">
                                    <div class="flex gap-6 items-start">
                                        <!-- Product Image -->
                                        <div class="product-image-container">
                                            <?php if($item['product']->image_path): ?>
                                                <img src="<?php echo e(asset('storage/' . $item['product']->image_path)); ?>" alt="<?php echo e($item['product']->name); ?>">
                                            <?php else: ?>
                                                <div class="product-placeholder">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-grow min-w-0">
                                            <!-- Name & Variant -->
                                            <div class="mb-4">
                                                <h3 class="text-base md:text-lg font-bold cart-text mb-2">
                                                    <a href="<?php echo e(route('shop.show', $item['product'])); ?>" class="product-name-link">
                                                        <?php echo e($item['product']->name); ?>

                                                    </a>
                                                </h3>
                                                <?php if($item['variant']): ?>
                                                    <p class="cart-label text-sm">
                                                        🎨 <?php echo e($item['variant']->name); ?>

                                                    </p>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Price & Quantity Row -->
                                            <div class="grid grid-cols-2 gap-4 mb-4 pb-4 border-b divider">
                                                <div>
                                                    <p class="summary-label mb-1">Unit Price</p>
                                                    <p class="cart-text text-lg">₱<?php echo e(number_format($item['price'], 2)); ?></p>
                                                </div>
                                                <div>
                                                    <p class="summary-label mb-1">Subtotal</p>
                                                    <p class="cart-total text-lg font-bold">₱<?php echo e(number_format($item['total'], 2)); ?></p>
                                                </div>
                                            </div>

                                            <!-- Quantity & Remove Controls -->
                                            <div class="flex items-center gap-4 flex-wrap">
                                                <div class="flex items-center gap-3">
                                                    <label class="summary-label">Qty:</label>
                                                    <div class="qty-controls">
                                                        <button type="button" class="qty-btn" onclick="decreaseQty('<?php echo e($item['key']); ?>')">−</button>
                                                        <input type="number" class="qty-input qty-value-<?php echo e($item['key']); ?>" value="<?php echo e($item['quantity']); ?>" min="1" readonly>
                                                        <button type="button" class="qty-btn" onclick="increaseQty('<?php echo e($item['key']); ?>')">+</button>
                                                    </div>
                                                    <input type="hidden" class="price-value-<?php echo e($item['key']); ?>" value="<?php echo e($item['price']); ?>">
                                                </div>

                                                <form id="remove-form-<?php echo e($item['key']); ?>" method="POST" action="<?php echo e(route('cart.destroy', $item['key'])); ?>" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="remove-btn" onclick="confirmRemove('<?php echo e($item['key']); ?>')">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    <!-- Order Summary Sidebar (Desktop) -->
                    <div class="lg:col-span-1 hidden md:block">
                        <!-- Continue Shopping Button -->
                        <div class="mb-4">
                            <a href="<?php echo e(route('shop.index')); ?>" class="continue-shopping-btn w-full text-center block py-3 text-base font-semibold transition-all duration-300">
                                ← Continue Shopping
                            </a>
                        </div>

                        <!-- Pickup Location Card -->
                        <div class="mb-4 p-6 rounded-xl" style="background: rgba(218, 165, 32, 0.1); border: 2px solid rgba(218, 165, 32, 0.3);">
                            <div class="flex items-start gap-3 mb-3">
                                <svg class="w-6 h-6 flex-shrink-0 mt-1" style="color: #DAA520;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-bold text-black text-base mb-1">📍 Pickup Location</h3>
                                    <p class="text-sm font-semibold text-gray-800">CICT Student Council Office</p>
                                    <p class="text-xs text-gray-600 mt-1">ISFUST Dingle Campus</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-600 mt-3 pt-3" style="border-top: 1px solid rgba(218, 165, 32, 0.2);">
                                <svg class="w-4 h-4" style="color: #DAA520;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium">Mon-Fri: 8:00 AM - 5:00 PM</span>
                            </div>
                        </div>

                        <div class="order-summary-card p-8 sticky top-32">
                            <h2 class="text-2xl font-bold mb-2 cart-text">💳 Order Summary</h2>
                            <p class="cart-label text-sm mb-6">CICT Council Merchandise</p>

                            <div class="space-y-4 mb-6 pb-6 border-b divider">
                                <div class="flex justify-between items-center">
                                    <span class="summary-label">Subtotal</span>
                                    <span class="summary-value">₱<?php echo e(number_format($subtotal, 2)); ?></span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-8 pb-8 border-b divider">
                                <span class="summary-total-label">Total</span>
                                <span class="summary-total-value">₱<?php echo e(number_format($total, 2)); ?></span>
                            </div>

                            <?php if(auth()->guard()->check()): ?>
                                <button onclick="window.location='<?php echo e(route('checkout.index')); ?>'" class="checkout-btn mb-4">
                                    🛒 Proceed to Checkout
                                </button>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="checkout-btn mb-4 text-center" style="display: flex; align-items: center; justify-content: center;">
                                    🔐 Sign In to Continue
                                </a>
                            <?php endif; ?>

                            <div class="mt-6 p-4 bg-gradient-to-r from-orange-50 to-amber-50 border border-orange-200 rounded-lg">
                                <p class="cart-label text-xs md:text-sm text-center">
                                    📍 Pickup Only<br>
                                    <span class="text-xs text-orange-700 mt-1 block">Please arrange pickup at the <br>CICT Student Council Office</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Sticky Checkout Button -->
                    <div class="md:hidden mobile-sticky-checkout">
                        <div class="mobile-checkout-content">
                            <div class="mobile-total-row">
                                <span class="summary-total-label text-base">Total:</span>
                                <span class="summary-total-value text-2xl">₱<?php echo e(number_format($total, 2)); ?></span>
                            </div>
                            <?php if(auth()->guard()->check()): ?>
                                <button onclick="window.location='<?php echo e(route('checkout.index')); ?>'" class="checkout-btn touch-target">
                                    🛒 Proceed to Checkout
                                </button>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="checkout-btn text-center touch-target" style="display: flex; align-items: center; justify-content: center;">
                                    🔐 Sign In to Continue
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('shop.index')); ?>" class="continue-shopping-btn w-full text-center block py-2 text-sm touch-target">
                                ← Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Empty Cart State -->
                <div class="flex items-center justify-center" style="min-height: 60vh;">
                    <div class="order-summary-card p-12 md:p-16 text-center max-w-2xl w-full">
                        <div class="mb-8">
                            <svg class="w-20 h-20 mx-auto empty-cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 20a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                        </div>
                        <h2 class="empty-cart-message text-2xl md:text-3xl font-bold mb-3">Your Cart is Empty</h2>
                        <p class="empty-cart-subtitle text-base mb-8">Let's add some amazing merchandise to your cart!</p>
                        <div class="flex flex-col gap-3 items-center justify-center">
                            <a href="<?php echo e(route('shop.index')); ?>" class="checkout-btn px-8 py-3" style="width: 100%; display: block; text-decoration: none;">
                                🛍️ Start Shopping Now
                            </a>
                            <form method="POST" action="<?php echo e(route('cart.clear')); ?>" style="display: block; width: 100%;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="continue-shopping-btn w-full py-3" title="Clear any cart session data">
                                    🔄 Clear Cart Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- SweetAlert2 for small centered remove confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Cart items data
        const allPrices = {
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                '<?php echo e($item['key']); ?>': {
                    price: <?php echo e($item['price']); ?>,
                    quantity: <?php echo e($item['quantity']); ?>

                },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        };

        function increaseQty(key) {
            const qtyInput = document.querySelector(`.qty-value-${key}`);
            let newQty = parseInt(qtyInput.value) + 1;
            qtyInput.value = newQty;
            saveQtyToSession(key, newQty);
            updatePrice(key, newQty);
        }

        function decreaseQty(key) {
            const qtyInput = document.querySelector(`.qty-value-${key}`);
            let newQty = parseInt(qtyInput.value) - 1;
            if (newQty < 1) return;
            qtyInput.value = newQty;
            saveQtyToSession(key, newQty);
            updatePrice(key, newQty);
        }

        function saveQtyToSession(key, newQty) {
            // Send AJAX request to update cart in session
            fetch(`/cart/${key}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: newQty })
            })
            .catch(error => console.error('Error saving quantity:', error));
        }

        function updatePrice(key, newQty) {
            // Update item subtotal
            const priceValue = parseFloat(document.querySelector(`.price-value-${key}`).value);
            const subtotal = priceValue * newQty;
            
            // Find and update the subtotal element for this item
            const card = document.querySelector(`.qty-value-${key}`).closest('.cart-item-card');
            const subtotalEl = card.querySelector('.cart-total');
            if (subtotalEl) {
                subtotalEl.classList.add('price-pulse', 'smooth-transition');
                subtotalEl.textContent = '₱' + subtotal.toFixed(2);
                setTimeout(() => subtotalEl.classList.remove('price-pulse'), 500);
            }

            // Calculate and update cart totals
            updateCartTotals();
        }

        function updateCartTotals() {
            let total = 0;
            
            // Calculate total from all items in the current view
            document.querySelectorAll('.cart-item-card').forEach(card => {
                const cartTotalEl = card.querySelector('.cart-total');
                if (cartTotalEl) {
                    const amount = parseFloat(cartTotalEl.textContent.replace('₱', ''));
                    total += amount;
                }
            });

            // Update Order Summary
            const subtotalElement = document.querySelector('.summary-value');
            if (subtotalElement) {
                subtotalElement.classList.add('price-pulse', 'smooth-transition');
                subtotalElement.textContent = '₱' + total.toFixed(2);
                setTimeout(() => subtotalElement.classList.remove('price-pulse'), 500);
            }

            const totalElement = document.querySelector('.summary-total-value');
            if (totalElement) {
                totalElement.classList.add('price-pulse', 'smooth-transition');
                totalElement.textContent = '₱' + total.toFixed(2);
                setTimeout(() => totalElement.classList.remove('price-pulse'), 500);
            }
        }
    </script>

    <script>
        function confirmRemove(key) {
            Swal.fire({
                title: 'Remove item?',
                text: 'Remove this item from your cart?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, remove',
                cancelButtonText: 'Cancel',
                width: 300,
                padding: '1rem',
                customClass: {
                    popup: 'small-swal'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('remove-form-' + key).submit();
                }
            });
        }
    </script>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\cart\index.blade.php ENDPATH**/ ?>