<?php if (isset($component)) { $__componentOriginale0f1cdd055772eb1d4a99981c240763e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f1cdd055772eb1d4a99981c240763e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('page-title', 'Dashboard'); ?>

    <!-- Breadcrumb Navigation -->
    <nav style="margin-bottom: 24px; padding: 14px 20px; background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%); border: 2px solid #2a3f5f; border-radius: 12px; display: flex; align-items: center; gap: 8px;">
        <svg class="w-5 h-5" style="color: #00d9ff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4v4m4-4v4m4-12l2 3"></path>
        </svg>
        <span style="color: #ffffff; font-weight: 600; font-size: 1.05rem;">Dashboard Overview</span>
        <span style="margin-left: auto; color: #b0bcc4; font-size: 0.9rem;"><?php echo e(now()->format('F d, Y')); ?></span>
    </nav>

    <!-- Top Stats - Bento Grid Section 1 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Today's Sales -->
        <div class="rounded-xl shadow-lg transition-all duration-300 p-6" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); border: 2px solid #00d9ff; position: relative; overflow: hidden;" onmouseover="this.style.boxShadow='0 8px 24px rgba(15, 111, 221, 0.5)'; this.style.transform='translateY(-4px)'" onmouseout="this.style.boxShadow='0 4px 12px rgba(15, 111, 221, 0.3)'; this.style.transform='translateY(0)'">
            <div style="position: absolute; top: -30px; right: -30px; font-size: 100px; opacity: 0.1;">💰</div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-white" style="text-transform: uppercase; letter-spacing: 0.5px;">Today's Sales</h3>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(255, 255, 255, 0.2); border: 2px solid rgba(255, 255, 255, 0.3);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);">₱<?php echo e(number_format($todaysSales, 2)); ?></p>
            <div class="mt-3 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                <p class="text-sm font-semibold" style="color: rgba(255, 255, 255, 0.9);">📦 <?php echo e($todaysOrdersCount); ?> orders today</p>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="rounded-xl shadow-lg transition-all duration-300 p-6" style="background: linear-gradient(135deg, #ff9500 0%, #cc7700 100%); border: 2px solid #ffd700; position: relative; overflow: hidden;" onmouseover="this.style.boxShadow='0 8px 24px rgba(255, 149, 0, 0.5)'; this.style.transform='translateY(-4px)'" onmouseout="this.style.boxShadow='0 4px 12px rgba(255, 149, 0, 0.3)'; this.style.transform='translateY(0)'">
            <div style="position: absolute; top: -30px; right: -30px; font-size: 100px; opacity: 0.15;">⏳</div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-white" style="text-transform: uppercase; letter-spacing: 0.5px;">Pending Orders</h3>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(255, 255, 255, 0.2); border: 2px solid rgba(255, 255, 255, 0.3);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e($pendingOrdersCount); ?></p>
            <div class="mt-3 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                <p class="text-sm font-semibold" style="color: rgba(255, 255, 255, 0.9);">⚠️ Awaiting processing</p>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="rounded-xl shadow-lg transition-all duration-300 p-6" style="background: linear-gradient(135deg, #8b0000 0%, #4a0000 100%); border: 2px solid #ff9999; position: relative; overflow: hidden;" onmouseover="this.style.boxShadow='0 8px 24px rgba(255, 107, 107, 0.5)'; this.style.transform='translateY(-4px)'" onmouseout="this.style.boxShadow='0 4px 12px rgba(255, 107, 107, 0.3)'; this.style.transform='translateY(0)'">
            <div style="position: absolute; top: -30px; right: -30px; font-size: 100px; opacity: 0.15;">📉</div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-white" style="text-transform: uppercase; letter-spacing: 0.5px;">Low Stock Items</h3>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(255, 255, 255, 0.2); border: 2px solid rgba(255, 255, 255, 0.3);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e($lowStockCount); ?></p>
            <div class="mt-3 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                <a href="<?php echo e(route('admin.inventory.index')); ?>" class="text-sm font-semibold transition-all duration-300" style="color: rgba(255, 255, 255, 0.9);" onmouseover="this.style.color='#ffffff'; this.style.textDecoration='underline'" onmouseout="this.style.color='rgba(255, 255, 255, 0.9)'; this.style.textDecoration='none'">View details →</a>
            </div>
        </div>

        <!-- Month's Revenue -->
        <div class="rounded-xl shadow-lg transition-all duration-300 p-6" style="background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%); border: 2px solid #66bb6a; position: relative; overflow: hidden;" onmouseover="this.style.boxShadow='0 8px 24px rgba(76, 175, 80, 0.5)'; this.style.transform='translateY(-4px)'" onmouseout="this.style.boxShadow='0 4px 12px rgba(76, 175, 80, 0.3)'; this.style.transform='translateY(0)'">
            <div style="position: absolute; top: -30px; right: -30px; font-size: 100px; opacity: 0.15;">📊</div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-white" style="text-transform: uppercase; letter-spacing: 0.5px;">Month's Revenue</h3>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(255, 255, 255, 0.2); border: 2px solid rgba(255, 255, 255, 0.3);">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);">₱<?php echo e(number_format($monthsRevenue, 2)); ?></p>
            <div class="mt-3 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                <p class="text-sm font-semibold" style="color: rgba(255, 255, 255, 0.9);">📅 <?php echo e(now()->format('F Y')); ?></p>
            </div>
        </div>
    </div>

    <!-- Revenue Chart & Quick Stats - Bento Grid Section 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Revenue Chart (spans 2 columns) -->
        <div class="lg:col-span-2 rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%); border: 2px solid #2a3f5f;">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); border: 2px solid #00d9ff;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">Revenue Trend (Last 7 Days)</h3>
            </div>
            <div class="h-64 flex items-center justify-center rounded-lg" style="background: rgba(15, 111, 221, 0.05); border: 1px solid rgba(42, 63, 95, 0.5);">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Inventory Overview -->
        <div class="rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%); border: 2px solid #2a3f5f;">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); border: 2px solid #00d9ff;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">Inventory Status</h3>
            </div>
            <div class="space-y-4">
                <!-- Total Products -->
                <div class="flex items-center justify-between p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #2a3f5f;" onmouseover="this.style.borderColor='#0f6fdd'" onmouseout="this.style.borderColor='#2a3f5f'">
                    <span class="text-sm font-semibold" style="color: #b0bcc4;">Total Products</span>
                    <span class="text-2xl font-bold text-white"><?php echo e($totalProducts); ?></span>
                </div>

                <!-- In Stock -->
                <div class="flex items-center justify-between p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%); border: 2px solid #66bb6a;" onmouseover="this.style.boxShadow='0 4px 12px rgba(76, 175, 80, 0.4)'" onmouseout="this.style.boxShadow='none'">
                    <span class="text-sm font-semibold text-white">In Stock</span>
                    <span class="text-2xl font-bold text-white"><?php echo e($inStockProducts); ?></span>
                </div>

                <!-- Out of Stock -->
                <div class="flex items-center justify-between p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #ff6b6b 0%, #cc0000 100%); border: 2px solid #ff9999;" onmouseover="this.style.boxShadow='0 4px 12px rgba(255, 107, 107, 0.4)'" onmouseout="this.style.boxShadow='none'">
                    <span class="text-sm font-semibold text-white">Out of Stock</span>
                    <span class="text-2xl font-bold text-white"><?php echo e($outOfStockProducts); ?></span>
                </div>

                <!-- Stock Health -->
                <div class="mt-4 pt-4" style="border-top: 2px solid #2a3f5f;">
                    <div class="w-full rounded-full h-3" style="background: rgba(42, 63, 95, 0.4);">
                        <div 
                            class="h-3 rounded-full transition-all duration-500" 
                            style="background: linear-gradient(90deg, #0f6fdd 0%, #00d9ff 100%); width: <?php echo e($totalProducts > 0 ? ($inStockProducts / $totalProducts * 100) : 0); ?>%; box-shadow: 0 0 10px rgba(15, 111, 221, 0.5);"
                        ></div>
                    </div>
                    <p class="text-sm mt-3 font-semibold" style="color: #b0bcc4;">
                        📦 <?php echo e($totalProducts > 0 ? round(($inStockProducts / $totalProducts * 100), 1) : 0); ?>% of inventory in stock
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Insights & Low Stock Alert - Bento Grid Section 3 -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Customer Insights -->
        <div class="rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%); border: 2px solid #2a3f5f;">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); border: 2px solid #00d9ff;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">Customer Insights</h3>
            </div>
            <div class="space-y-4">
                <div class="p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); border: 2px solid #00d9ff;" onmouseover="this.style.boxShadow='0 4px 12px rgba(15, 111, 221, 0.4)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-white" style="letter-spacing: 0.3px;">Total Customers</span>
                    </div>
                    <p class="text-3xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e($totalCustomers); ?></p>
                </div>

                <div class="p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%); border: 2px solid #66bb6a;" onmouseover="this.style.boxShadow='0 4px 12px rgba(76, 175, 80, 0.4)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-white" style="letter-spacing: 0.3px;">New This Month</span>
                    </div>
                    <p class="text-3xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e($newCustomersThisMonth); ?></p>
                </div>

                <div class="p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #9c27b0 0%, #6a1b9a 100%); border: 2px solid #ba68c8;" onmouseover="this.style.boxShadow='0 4px 12px rgba(156, 39, 176, 0.4)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-sm font-semibold text-white" style="letter-spacing: 0.3px;">Active (30 days)</span>
                    </div>
                    <p class="text-3xl font-bold text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);"><?php echo e($activeCustomers); ?></p>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert Widget -->
        <div class="lg:col-span-2 rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, #8b0000 0%, #4a0000 100%); border: 2px solid #ff9999;">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(255, 255, 255, 0.2); border: 2px solid rgba(255, 255, 255, 0.3);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">⚠️ Low Stock Alert</h3>
                </div>
                <a href="<?php echo e(route('admin.inventory.index')); ?>" class="text-sm font-semibold px-5 py-2.5 rounded-lg transition-all duration-300" style="background: rgba(255, 255, 255, 0.2); color: white; border: 2px solid rgba(255, 255, 255, 0.3);" onmouseover="this.style.background='rgba(255, 255, 255, 0.3)'; this.style.transform='translateX(4px)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.2)'; this.style.transform='translateX(0)'">Manage Inventory →</a>
            </div>

            <?php if($lowStockProducts->count() > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-64 overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: rgba(255, 255, 255, 0.3) transparent;">
                    <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-3 p-3 rounded-lg transition-all duration-300" style="background: rgba(0, 0, 0, 0.3); border: 2px solid rgba(255, 255, 255, 0.2);" onmouseover="this.style.background='rgba(0, 0, 0, 0.5)'; this.style.borderColor='rgba(255, 255, 255, 0.4)'; this.style.transform='translateX(4px)'" onmouseout="this.style.background='rgba(0, 0, 0, 0.3)'; this.style.borderColor='rgba(255, 255, 255, 0.2)'; this.style.transform='translateX(0)'">
                            <?php if($product->image_path): ?>
                                <img src="<?php echo e(asset('storage/' . $product->image_path)); ?>" alt="<?php echo e($product->name); ?>" class="w-14 h-14 rounded-lg object-cover" style="border: 2px solid rgba(255, 255, 255, 0.3);">
                            <?php else: ?>
                                <div class="w-14 h-14 rounded-lg flex items-center justify-center" style="background: rgba(255, 255, 255, 0.15); border: 2px solid rgba(255, 255, 255, 0.3);">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-white text-sm truncate"><?php echo e($product->name); ?></p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs font-bold px-2.5 py-1 rounded" style="background: rgba(255, 255, 255, 0.25); color: white;"><?php echo e($product->current_stock); ?> left</span>
                                    <span class="text-xs" style="color: rgba(255, 255, 255, 0.7);">Threshold: <?php echo e($product->low_stock_threshold); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto mb-3 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-white font-semibold text-lg">All products are well stocked!</p>
                    <p class="text-sm mt-2" style="color: rgba(255, 255, 255, 0.7);">No low stock alerts at the moment</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Top Selling Products & Recent Orders - Bento Grid Section 4 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Selling Products -->
        <div class="rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%); border: 2px solid #2a3f5f;">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); border: 2px solid #00d9ff;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">📈 Top Selling Products</h3>
                </div>
                <a href="<?php echo e(route('admin.analytics.index')); ?>" class="text-sm font-semibold transition-all duration-300" style="color: #00d9ff;" onmouseover="this.style.color='#ffffff'; this.style.textDecoration='underline'" onmouseout="this.style.color='#00d9ff'; this.style.textDecoration='none'">View all →</a>
            </div>

            <?php if($topProducts->count() > 0): ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->product): ?>
                        <div class="flex items-center gap-4 p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #2a3f5f;" onmouseover="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 4px 12px rgba(15, 111, 221, 0.3)'; this.style.transform='translateX(4px)'" onmouseout="this.style.borderColor='#2a3f5f'; this.style.boxShadow='none'; this.style.transform='translateX(0)'">
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-white text-base truncate"><?php echo e($item->product->name); ?></p>
                                <p class="text-sm mt-1" style="color: #b0bcc4;">📦 <?php echo e($item->order_count); ?> orders</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="font-bold text-lg" style="color: #00d9ff; text-shadow: 0 0 10px rgba(0, 217, 255, 0.3);">₱<?php echo e(number_format($item->revenue, 2)); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <p class="text-lg font-semibold" style="color: #b0bcc4;">No sales yet</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Recent Orders -->
        <div class="rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%); border: 2px solid #2a3f5f;">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); border: 2px solid #00d9ff;">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">📝 Recent Orders</h3>
                </div>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-sm font-semibold transition-all duration-300" style="color: #00d9ff;" onmouseover="this.style.color='#ffffff'; this.style.textDecoration='underline'" onmouseout="this.style.color='#00d9ff'; this.style.textDecoration='none'">View all →</a>
            </div>

            <?php if($recentOrders->count() > 0): ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="block p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #2a3f5f; text-decoration: none;" onmouseover="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 4px 12px rgba(15, 111, 221, 0.3)'; this.style.transform='translateX(4px)'" onmouseout="this.style.borderColor='#2a3f5f'; this.style.boxShadow='none'; this.style.transform='translateX(0)'">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex-1">
                                    <p class="font-semibold text-base" style="color: #00d9ff;"><?php echo e($order->order_number); ?></p>
                                    <p class="text-sm mt-1" style="color: #b0bcc4;">👤 <?php echo e($order->customer->name); ?></p>
                                </div>
                                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['status' => $order->status,'size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order->status),'size' => 'sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                            </div>
                            <div class="flex items-center justify-between text-sm pt-2" style="border-top: 1px solid #2a3f5f;">
                                <p style="color: #b0bcc4;">📅 <?php echo e($order->created_at->diffForHumans()); ?></p>
                                <p class="font-bold text-base" style="color: #00d9ff; text-shadow: 0 0 10px rgba(0, 217, 255, 0.3);">₱<?php echo e(number_format($order->total, 2)); ?></p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <p class="text-lg font-semibold" style="color: #b0bcc4;">No orders yet</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Chart.js Library & Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo $revenueLabels; ?>,
                    datasets: [{
                        label: 'Revenue',
                        data: <?php echo $revenueData; ?>,
                        borderColor: '#0f6fdd',
                        backgroundColor: 'rgba(15, 111, 221, 0.15)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#00d9ff',
                        pointBorderColor: '#0f1419',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#00d9ff',
                        pointHoverBorderColor: '#ffffff',
                        borderWidth: 3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 20, 25, 0.95)',
                            titleColor: '#00d9ff',
                            bodyColor: '#ffffff',
                            borderColor: '#2a3f5f',
                            borderWidth: 2,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Revenue: ₱' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(42, 63, 95, 0.3)',
                                drawBorder: true,
                                borderColor: '#2a3f5f'
                            },
                            ticks: {
                                color: '#b0bcc4',
                                font: {
                                    size: 12,
                                    weight: '600'
                                },
                                callback: function(value) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(42, 63, 95, 0.2)',
                            },
                            ticks: {
                                color: '#b0bcc4',
                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $attributes = $__attributesOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $component = $__componentOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__componentOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>