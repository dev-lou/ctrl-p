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
    <div style="background: #FFFAF1; min-height: 100vh; width: 100%; margin: 0; padding: 0;">
        <style>
            body {
                background: #FFFAF1 !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            html {
                background: #FFFAF1 !important;
            }

            .animated-gradient-orders {
                background: #FFFAF1;
                min-height: 100vh;
                padding-top: 120px;
                padding-bottom: 80px;
            }

            .orders-list-card {
                background: #FFFFFF;
                border: 1px solid rgba(139, 0, 0, 0.08);
                border-radius: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04), 0 1px 4px rgba(0, 0, 0, 0.02);
                transition: all cubic-bezier(0.4, 0, 0.2, 1) 0.3s;
                overflow: hidden;
            }

            .orders-list-card:hover {
                box-shadow: 0 12px 32px rgba(139, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.04);
                transform: translateY(-2px);
                border-color: rgba(139, 0, 0, 0.15);
            }

            .order-header-text {
                color: #1a1a1a;
                font-weight: 800;
                letter-spacing: -0.5px;
            }

            .order-value-text {
                color: #8B0000;
                font-weight: 800;
            }

            .order-label {
                color: #888888;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                font-weight: 600;
            }

            .status-badge {
                display: inline-block;
                padding: 8px 16px;
                border-radius: 8px;
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                border: 1px solid;
            }

            .status-pending {
                background: linear-gradient(135deg, #FFE5E5 0%, #FFD4D4 100%);
                color: #8B0000;
                border-color: #8B0000;
            }

            .status-completed {
                background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);
                color: #2E7D32;
                border-color: #4CAF50;
            }

            .status-cancelled {
                background: linear-gradient(135deg, #FFEBEE 0%, #FFCDD2 100%);
                color: #C62828;
                border-color: #F44336;
            }

            .action-btn {
                font-weight: 600;
                padding: 12px 20px;
                border-radius: 10px;
                cursor: pointer;
                transition: all cubic-bezier(0.4, 0, 0.2, 1) 0.3s;
                text-decoration: none;
                display: inline-block;
                border: none;
                font-size: 14px;
                letter-spacing: 0.2px;
                min-height: 44px;
            }

            .touch-target {
                min-height: 44px;
                min-width: 44px;
            }

            .btn-primary {
                background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
                color: #FFFFFF;
                box-shadow: 0 4px 12px rgba(139, 0, 0, 0.2);
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #A00000 0%, #C00000 100%);
                box-shadow: 0 6px 16px rgba(139, 0, 0, 0.4);
                transform: translateY(-2px);
            }

            .btn-secondary {
                background: #FFFFFF;
                color: #8B0000;
                border: 1px solid #8B0000;
                box-shadow: 0 2px 8px rgba(139, 0, 0, 0.08);
            }

            .btn-secondary:hover {
                background: #8B0000;
                color: #FFFFFF;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(139, 0, 0, 0.25);
            }

            .btn-danger {
                background: #FFFFFF;
                color: #DC2626;
                border: 1px solid #DC2626;
                box-shadow: 0 2px 8px rgba(220, 38, 38, 0.08);
            }

            .btn-danger:hover {
                background: #DC2626;
                color: #FFFFFF;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
            }

            .btn-delete {
                background: #FFFFFF;
                color: #991B1B;
                border: 1px solid #991B1B;
                box-shadow: 0 2px 8px rgba(153, 27, 27, 0.08);
            }

            .btn-delete:hover {
                background: #991B1B;
                color: #FFFFFF;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(153, 27, 27, 0.25);
            }

            .empty-state-icon {
                color: #8B0000;
                opacity: 0.7;
            }

            .pagination-wrapper {
                margin-top: 32px;
            }

            .header-section {
                padding-bottom: 40px;
            }

            .header-section h1 {
                color: #1a1a1a;
                font-weight: 800;
                margin-bottom: 20px;
                letter-spacing: -1px;
            }

            .header-section p {
                color: #666666;
                font-weight: 600;
                font-size: 16px;
            }

            .header-badge {
                background: linear-gradient(135deg, rgba(139, 0, 0, 0.05) 0%, rgba(255, 215, 0, 0.03) 100%);
                border: 1px solid rgba(139, 0, 0, 0.12);
                color: #8B0000;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(139, 0, 0, 0.06);
            }

            .order-divider {
                border-color: #F0F0F0;
            }

            .grid-info {
                background: linear-gradient(135deg, rgba(255, 250, 241, 0.5) 0%, rgba(255, 245, 230, 0.5) 100%);
                border-radius: 12px;
                padding: 16px;
                border: 1px solid rgba(139, 0, 0, 0.08);
                transition: all 0.3s ease;
            }

            .grid-info:hover {
                background: linear-gradient(135deg, rgba(255, 245, 230, 0.6) 0%, rgba(255, 234, 212, 0.6) 100%);
                transform: translateY(-1px);
                box-shadow: 0 2px 8px rgba(139, 0, 0, 0.06);
            }
        </style>

        <div class="animated-gradient-orders">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="header-section mb-12">
                    <h1 class="text-4xl md:text-5xl font-black mb-4">📦 My Orders</h1>
                    <div class="header-badge inline-block px-6 py-3">
                        <p class="font-bold text-base">View and manage your order history</p>
                    </div>
                </div>

                <!-- Orders List -->
                <?php if($orders->count() > 0): ?>
                    <!-- Desktop Table View (Hidden on Mobile) -->
                    <div class="hidden md:block orders-list-card overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead style="background: linear-gradient(135deg, #F5F5F5 0%, #EEEEEE 100%); border-bottom: 2px solid rgba(139, 0, 0, 0.1);">
                                    <tr>
                                        <th class="px-6 py-4 text-left order-label" style="font-size: 13px;">Order #</th>
                                        <th class="px-6 py-4 text-left order-label" style="font-size: 13px;">Date</th>
                                        <th class="px-6 py-4 text-left order-label" style="font-size: 13px;">Items</th>
                                        <th class="px-6 py-4 text-left order-label" style="font-size: 13px;">Total</th>
                                        <th class="px-6 py-4 text-left order-label" style="font-size: 13px;">Status</th>
                                        <th class="px-6 py-4 text-center order-label" style="font-size: 13px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="border-bottom: 1px solid #F0F0F0; transition: all 0.2s ease;" onmouseover="this.style.background='#FFFAF1'" onmouseout="this.style.background='#FFFFFF'">
                                            <td class="px-6 py-5">
                                                <span class="order-header-text text-base font-bold">
                                                    #<?php echo e(str_pad($order->id, 6, '0', STR_PAD_LEFT)); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="order-label text-sm"><?php echo e($order->created_at->format('M d, Y')); ?></div>
                                                <div class="order-label text-xs"><?php echo e($order->created_at->format('g:i A')); ?></div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span class="order-value-text text-base font-bold"><?php echo e($order->items->count()); ?></span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span class="order-value-text text-lg font-bold">₱<?php echo e(number_format($order->total, 2)); ?></span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span class="status-badge status-<?php echo e($order->status === 'completed' ? 'completed' : ($order->status === 'cancelled' ? 'cancelled' : 'pending')); ?>">
                                                    <?php echo e(ucfirst($order->status)); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="flex gap-2 justify-center flex-wrap">
                                                    <a href="<?php echo e(route('orders.show', $order)); ?>" class="action-btn btn-primary text-xs px-3 py-2" style="min-width: 100px;">
                                                        👁️ View
                                                    </a>
                                                    <a href="<?php echo e(route('orders.receipt.pdf', $order)); ?>" class="action-btn btn-secondary text-xs px-3 py-2" style="min-width: 100px;">
                                                        📄 Receipt
                                                    </a>
                                                    <?php if($order->canBeCancelled()): ?>
                                                        <form method="POST" action="<?php echo e(route('orders.cancel', $order)); ?>" class="inline" onsubmit="confirmCancel(event, this);">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="action-btn btn-danger text-xs px-3 py-2" style="min-width: 100px;">
                                                                ✕ Cancel
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <form method="POST" action="<?php echo e(route('orders.destroy', $order)); ?>" class="inline" onsubmit="confirmDelete(event, this);">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="action-btn btn-delete text-xs px-3 py-2" style="min-width: 100px;">
                                                            🗑️ Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Mobile Card View (Hidden on Desktop) -->
                    <div class="md:hidden space-y-4 pb-24">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="orders-list-card p-6">
                                <div class="flex items-start justify-between gap-4 mb-6 pb-4 border-b order-divider">
                                    <div>
                                        <h3 class="order-header-text text-lg font-bold mb-1">
                                            Order #<?php echo e(str_pad($order->id, 6, '0', STR_PAD_LEFT)); ?>

                                        </h3>
                                        <p class="order-label text-xs"><?php echo e($order->created_at->format('M d, Y \a\t g:i A')); ?></p>
                                    </div>
                                    <span class="status-badge status-<?php echo e($order->status === 'completed' ? 'completed' : ($order->status === 'cancelled' ? 'cancelled' : 'pending')); ?>" style="font-size: 10px; padding: 6px 12px;">
                                        <?php echo e(ucfirst($order->status)); ?>

                                    </span>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="grid-info">
                                        <p class="order-label mb-1 text-xs">Items</p>
                                        <p class="order-value-text text-lg font-bold"><?php echo e($order->items->count()); ?></p>
                                    </div>
                                    <div class="grid-info">
                                        <p class="order-label mb-1 text-xs">Total</p>
                                        <p class="order-value-text text-lg font-bold">₱<?php echo e(number_format($order->total, 2)); ?></p>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <a href="<?php echo e(route('orders.show', $order)); ?>" class="action-btn btn-primary text-center touch-target">
                                        👁️ View Details
                                    </a>
                                    <div class="grid grid-cols-2 gap-2">
                                        <a href="<?php echo e(route('orders.receipt.pdf', $order)); ?>" class="action-btn btn-secondary text-center text-xs touch-target">
                                            📄 Receipt
                                        </a>
                                        <?php if($order->canBeCancelled()): ?>
                                            <form method="POST" action="<?php echo e(route('orders.cancel', $order)); ?>" class="inline" onsubmit="confirmCancel(event, this);">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <button type="submit" class="action-btn btn-danger text-xs w-full touch-target">
                                                    ✕ Cancel
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <form method="POST" action="<?php echo e(route('orders.destroy', $order)); ?>" class="inline" onsubmit="confirmDelete(event, this);">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="action-btn btn-delete text-xs w-full touch-target">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Pagination -->
                    <?php if($orders->hasPages()): ?>
                        <div class="pagination-wrapper">
                            <?php echo e($orders->links()); ?>

                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="orders-list-card p-12 md:p-16 text-center">
                        <svg class="mx-auto h-16 w-16 empty-state-icon mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p class="order-label mb-6 text-base">You haven't placed any orders yet.</p>
                        <a href="<?php echo e(route('shop.index')); ?>" class="action-btn btn-primary inline-block">
                            🛍️ Start Shopping
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCancel(event, form) {
            event.preventDefault();
            
            Swal.fire({
                title: 'Cancel Order?',
                text: 'Are you sure you want to cancel this order? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Cancel Order',
                cancelButtonText: 'No, Keep It',
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6B7280',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function confirmDelete(event, form) {
            event.preventDefault();
            
            Swal.fire({
                title: 'Delete Order?',
                text: 'This will permanently delete this order from your history. This action cannot be undone.',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete Order',
                cancelButtonText: 'No, Keep It',
                confirmButtonColor: '#991B1B',
                cancelButtonColor: '#6B7280',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\account\orders.blade.php ENDPATH**/ ?>