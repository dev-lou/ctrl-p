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
    <?php $__env->startSection('page-title', 'Audit Log Details'); ?>

    <!-- Header with Back Button -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-4">
                <a href="<?php echo e(route('admin.audit-logs.index')); ?>" class="text-xl font-bold" style="color: #b0bcc4;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#b0bcc4'">← Audit Logs</a>
                <h2 class="text-2xl font-bold" style="color: #ffffff;"><?php echo e(ucfirst($log->action)); ?> - <?php echo e($log->model); ?> #<?php echo e($log->model_id); ?></h2>
            </div>
            <p class="mt-2" style="color: #b0bcc4;"><?php echo e($log->created_at->format('F d, Y h:i:s A')); ?></p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Log Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                    <h3 class="text-lg font-bold" style="color: #ffffff;">Audit Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div style="border-bottom: 2px solid #b0bcc4; padding-bottom: 12px;">
                        <p style="color: #b0bcc4; font-size: 12px;">Action</p>
                        <p style="color: #ffffff; font-weight: bold;">
                            <?php if($log->action === 'create'): ?>
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #4caf50; color: white;">Create</span>
                            <?php elseif($log->action === 'update'): ?>
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #ff9500; color: #0f1419;">Update</span>
                            <?php else: ?>
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #f44336; color: white;">Delete</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div style="border-bottom: 2px solid #b0bcc4; padding-bottom: 12px;">
                        <p style="color: #b0bcc4; font-size: 12px;">Model</p>
                        <p style="color: #ffffff; font-weight: bold;"><?php echo e($log->model); ?></p>
                    </div>
                    <div style="border-bottom: 2px solid #b0bcc4; padding-bottom: 12px;">
                        <p style="color: #b0bcc4; font-size: 12px;">Model ID</p>
                        <p style="color: #ffffff; font-weight: bold;">#<?php echo e($log->model_id); ?></p>
                    </div>
                    <div>
                        <p style="color: #b0bcc4; font-size: 12px;">IP Address</p>
                        <p style="color: #ffffff; font-weight: bold;"><?php echo e($log->ip_address ?? 'N/A'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Old Values (for updates/deletes) -->
            <?php if($log->old_values): ?>
                <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                    <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                        <h3 class="text-lg font-bold" style="color: #ffffff;">Previous Values</h3>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr style="border-bottom: 2px solid #b0bcc4;">
                                    <th class="text-left pb-3" style="color: #b0bcc4; font-weight: bold;">Field</th>
                                    <th class="text-left pb-3" style="color: #b0bcc4; font-weight: bold;">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $log->old_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style="border-bottom: 1px solid #b0bcc4;">
                                        <td class="py-2" style="color: #b0bcc4;"><?php echo e($key); ?></td>
                                        <td class="py-2" style="color: #ffffff; word-break: break-word; max-width: 300px;">
                                            <?php if(is_array($value)): ?>
                                                <pre style="background-color: #0f1419; padding: 8px; border-radius: 4px; border: 1px solid #b0bcc4; color: #b0bcc4; font-size: 12px; overflow-x: auto;"><?php echo e(json_encode($value, JSON_PRETTY_PRINT)); ?></pre>
                                            <?php else: ?>
                                                <?php echo e($value ?? 'null'); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- New Values (for creates/updates) -->
            <?php if($log->new_values): ?>
                <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                    <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                        <h3 class="text-lg font-bold" style="color: #ffffff;"><?php echo e($log->action === 'create' ? 'Created Values' : 'New Values'); ?></h3>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr style="border-bottom: 2px solid #b0bcc4;">
                                    <th class="text-left pb-3" style="color: #b0bcc4; font-weight: bold;">Field</th>
                                    <th class="text-left pb-3" style="color: #b0bcc4; font-weight: bold;">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $log->new_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style="border-bottom: 1px solid #b0bcc4;">
                                        <td class="py-2" style="color: #b0bcc4;"><?php echo e($key); ?></td>
                                        <td class="py-2" style="color: #ffffff; word-break: break-word; max-width: 300px;">
                                            <?php if(is_array($value)): ?>
                                                <pre style="background-color: #0f1419; padding: 8px; border-radius: 4px; border: 1px solid #b0bcc4; color: #b0bcc4; font-size: 12px; overflow-x: auto;"><?php echo e(json_encode($value, JSON_PRETTY_PRINT)); ?></pre>
                                            <?php else: ?>
                                                <?php echo e($value ?? 'null'); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Column - User Info -->
        <div class="lg:col-span-1">
            <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                    <h3 class="text-lg font-bold" style="color: #ffffff;">User Info</h3>
                </div>
                <div class="p-6 space-y-3">
                    <div>
                        <p style="color: #b0bcc4; font-size: 12px;">User</p>
                        <p style="color: #ffffff; font-weight: bold;"><?php echo e($log->user?->name ?? 'System'); ?></p>
                    </div>
                    <?php if($log->user): ?>
                        <div style="border-top: 2px solid #b0bcc4; padding-top: 12px;">
                            <p style="color: #b0bcc4; font-size: 12px;">Email</p>
                            <p style="color: #ffffff; font-weight: bold;"><?php echo e($log->user->email); ?></p>
                        </div>
                    <?php endif; ?>
                    <div style="border-top: 2px solid #b0bcc4; padding-top: 12px;">
                        <p style="color: #b0bcc4; font-size: 12px;">Date/Time</p>
                        <p style="color: #ffffff; font-weight: bold;"><?php echo e($log->created_at->format('M d, Y h:i A')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\admin\audit-logs\show.blade.php ENDPATH**/ ?>