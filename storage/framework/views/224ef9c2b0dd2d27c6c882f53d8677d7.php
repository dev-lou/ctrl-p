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
    <?php $__env->startSection('title', 'Notifications - ' . config('app.name')); ?>

    <div style="background: #FFFAF1; min-height: 100vh; padding-top: 140px; padding-bottom: 80px;">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 style="font-size: 2.5rem; font-weight: 800; color: #1a1a1a; margin-bottom: 8px;">🔔 Notifications</h1>
                    <p style="color: #666666; font-size: 15px;">Stay updated with your order status changes</p>
                </div>
                <?php if($notifications->where('is_read', false)->count() > 0): ?>
                    <button onclick="markAllAsRead()" style="background: #8B0000; color: white; padding: 10px 20px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer;">
                        Mark All as Read
                    </button>
                <?php endif; ?>
            </div>

            <!-- Notifications List -->
            <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="notification-card <?php echo e($notification->is_read ? 'read' : 'unread'); ?>" style="background: white; border: 1px solid #F0F0F0; border-radius: 12px; padding: 20px; margin-bottom: 16px; transition: all 0.3s ease;">
                    <div style="display: flex; gap: 16px; align-items: start;">
                        <!-- Icon -->
                        <div style="flex-shrink: 0;">
                            <?php if($notification->type === 'order_completed'): ?>
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: #D4EDDA; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    ✅
                                </div>
                            <?php elseif($notification->type === 'order_status_changed'): ?>
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: #FFF3CD; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    🔄
                                </div>
                            <?php else: ?>
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: #D1ECF1; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    🔔
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Content -->
                        <div style="flex-grow: 1;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">
                                <?php echo e($notification->title); ?>

                            </h3>
                            <p style="color: #666666; font-size: 14px; margin-bottom: 8px; line-height: 1.5;">
                                <?php echo e($notification->message); ?>

                            </p>
                            <div style="display: flex; gap: 16px; align-items: center;">
                                <span style="color: #999999; font-size: 13px;">
                                    <?php echo e($notification->created_at->diffForHumans()); ?>

                                </span>
                                <?php if($notification->data && isset($notification->data['order_id'])): ?>
                                    <a href="<?php echo e(route('orders.show', $notification->data['order_id'])); ?>" style="color: #8B0000; font-size: 13px; font-weight: 600; text-decoration: none;">
                                        View Order →
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div style="flex-shrink: 0; display: flex; gap: 8px;">
                            <?php if(!$notification->is_read): ?>
                                <button onclick="markAsRead(<?php echo e($notification->id); ?>)" style="padding: 6px 12px; background: #F0F0F0; border: none; border-radius: 6px; font-size: 12px; cursor: pointer;">
                                    Mark as Read
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="background: white; border: 1px solid #F0F0F0; border-radius: 12px; padding: 60px; text-align: center;">
                    <div style="font-size: 64px; margin-bottom: 16px;">🔕</div>
                    <h3 style="font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px;">No Notifications</h3>
                    <p style="color: #666666;">You're all caught up! We'll notify you when there are updates.</p>
                </div>
            <?php endif; ?>

            <!-- Pagination -->
            <?php if($notifications->hasPages()): ?>
                <div class="mt-8">
                    <?php echo e($notifications->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function markAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }
    </script>

    <style>
        .notification-card.unread {
            border-left: 4px solid #8B0000;
            background: #FFFBF5 !important;
        }

        .notification-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }
    </style>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\notifications\index.blade.php ENDPATH**/ ?>