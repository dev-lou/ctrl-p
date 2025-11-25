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
    <?php $__env->startSection('title', 'My Dashboard - ' . config('app.name')); ?>

    <style>
        /* Mobile-First Dashboard Styles */
        .dashboard-container {
            background: #FFFAF1;
            min-height: 100vh;
            padding-top: 120px;
            padding-bottom: 60px;
        }

        .dashboard-card {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 2px solid #F0F0F0;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            border-color: #DAA520;
        }

        .stat-card {
            background: linear-gradient(135deg, #8B0000, #A00000);
            border-radius: 12px;
            padding: 20px;
            color: white;
            text-align: center;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            margin: 8px 0;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .quick-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px;
            background: linear-gradient(135deg, #8B0000, #A00000);
            color: white;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
        }

        .quick-action-btn:hover {
            background: linear-gradient(135deg, #A00000, #C00000);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.4);
            transform: translateY(-2px);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 16px;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: #F9F9F9;
            border-radius: 12px;
            border: 2px solid #E8E8E8;
            transition: all 0.3s ease;
            margin-bottom: 12px;
        }

        .order-item:hover {
            background: #FFFFFF;
            border-color: #8B0000;
        }

        .notification-item {
            padding: 16px;
            background: #F9F9F9;
            border-radius: 12px;
            border-left: 4px solid #DAA520;
            margin-bottom: 12px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-pending {
            background: rgba(234, 179, 8, 0.1);
            color: #ca8a04;
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.75rem;
            }
            
            .section-title {
                font-size: 1.25rem;
            }
        }
    </style>

    <div class="dashboard-container">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold" style="color: #1a1a1a;">
                    Welcome back, <?php echo e(auth()->user()->name); ?>! 👋
                </h1>
                <p class="text-gray-600 mt-2">Here's what's happening with your account</p>
            </div>

            <!-- Stats Grid (Mobile Responsive) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="stat-card">
                    <div class="stat-label">Total Orders</div>
                    <div class="stat-value"><?php echo e($totalOrders); ?></div>
                </div>

                <div class="stat-card" style="background: linear-gradient(135deg, #eab308, #ca8a04);">
                    <div class="stat-label">Pending</div>
                    <div class="stat-value"><?php echo e($pendingOrders); ?></div>
                </div>

                <div class="stat-card" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <div class="stat-label">Completed</div>
                    <div class="stat-value"><?php echo e($completedOrders); ?></div>
                </div>

                <div class="stat-card" style="background: linear-gradient(135deg, #DAA520, #B8860B);">
                    <div class="stat-label">Total Spent</div>
                    <div class="stat-value text-lg">₱<?php echo e(number_format($totalSpent, 0)); ?></div>
                </div>
            </div>

            <!-- Quick Actions (Mobile Friendly) -->
            <div class="dashboard-card mb-8">
                <h2 class="section-title">Quick Actions</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="<?php echo e(route('shop.index')); ?>" class="quick-action-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Browse Shop
                    </a>

                    <a href="<?php echo e(route('account.orders')); ?>" class="quick-action-btn" style="background: linear-gradient(135deg, #eab308, #ca8a04);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        View Orders
                    </a>

                    <a href="<?php echo e(route('notifications.index')); ?>" class="quick-action-btn" style="background: linear-gradient(135deg, #10b981, #059669); position: relative;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Notifications
                        <?php if($unreadNotificationsCount > 0): ?>
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full"><?php echo e($unreadNotificationsCount); ?></span>
                        <?php endif; ?>
                    </a>

                    <a href="<?php echo e(route('profile.edit')); ?>" class="quick-action-btn" style="background: linear-gradient(135deg, #6366f1, #4f46e5);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Edit Profile
                    </a>
                </div>
            </div>

            <!-- Two Column Layout (Stacks on Mobile) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Orders -->
                <div class="dashboard-card">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="section-title mb-0">Recent Orders</h2>
                        <a href="<?php echo e(route('account.orders')); ?>" class="text-sm font-semibold" style="color: #8B0000;">View All →</a>
                    </div>

                    <?php if($recentOrders->count() > 0): ?>
                        <div class="space-y-0">
                            <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('orders.show', $order)); ?>" class="order-item block">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-sm" style="color: #1a1a1a;"><?php echo e($order->order_number); ?></p>
                                        <p class="text-xs text-gray-500 mt-1"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold" style="color: #8B0000;">₱<?php echo e(number_format($order->total, 2)); ?></p>
                                        <span class="status-badge status-<?php echo e($order->status); ?> mt-1"><?php echo e(ucfirst($order->status)); ?></span>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <p class="text-gray-600 font-semibold">No orders yet</p>
                            <a href="<?php echo e(route('shop.index')); ?>" class="inline-block mt-4 px-6 py-2 rounded-lg font-semibold" style="background: linear-gradient(135deg, #8B0000, #A00000); color: white;">Start Shopping</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Recent Notifications -->
                <div class="dashboard-card">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="section-title mb-0">Notifications</h2>
                        <a href="<?php echo e(route('notifications.index')); ?>" class="text-sm font-semibold" style="color: #8B0000;">View All →</a>
                    </div>

                    <?php if($recentNotifications->count() > 0): ?>
                        <div class="space-y-0 max-h-96 overflow-y-auto">
                            <?php $__currentLoopData = $recentNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="notification-item <?php echo e($notification->is_read ? 'opacity-60' : ''); ?>">
                                    <div class="flex items-start gap-3">
                                        <div class="flex-shrink-0">
                                            <?php if($notification->type === 'order'): ?>
                                                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(59, 130, 246, 0.1);">
                                                    <span class="text-xl">📦</span>
                                                </div>
                                            <?php elseif($notification->type === 'stock'): ?>
                                                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(245, 158, 11, 0.1);">
                                                    <span class="text-xl">⚠️</span>
                                                </div>
                                            <?php else: ?>
                                                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(16, 185, 129, 0.1);">
                                                    <span class="text-xl">🔔</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-bold text-sm" style="color: #1a1a1a;"><?php echo e($notification->title); ?></p>
                                            <p class="text-xs text-gray-600 mt-1"><?php echo e($notification->message); ?></p>
                                            <p class="text-xs text-gray-400 mt-2"><?php echo e($notification->created_at->diffForHumans()); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <p class="text-gray-600 font-semibold">No notifications</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\customer\dashboard.blade.php ENDPATH**/ ?>