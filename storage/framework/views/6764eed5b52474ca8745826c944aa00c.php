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
    <?php $__env->startSection('page-title', 'All Orders'); ?>

    <style>
        .filter-badge {
            display: inline-block;
            padding: 4px 12px;
            background-color: #b0bcc4;
            color: #0f6fdd;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-left: 8px;
        }
    </style>

    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold" style="color: #ffffff;">
            All Orders
            <span class="filter-badge"><?php echo e($orders->total()); ?></span>
        </h2>
        <p class="mt-1" style="color: #b0bcc4;">View and manage all customer orders</p>
    </div>

    <!-- Filter Bar -->
    <div class="rounded-lg shadow-lg p-6 mb-6" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
        <form method="GET" class="flex gap-4 flex-wrap items-end">
            <!-- Search Bar -->
            <div class="flex-1 min-w-64">
                <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Search Order or Customer</label>
                <input 
                    type="text" 
                    name="search" 
                    value="<?php echo e(request('search', '')); ?>"
                    placeholder="Search by order number or customer name..." 
                    class="w-full px-4 py-2 rounded-lg text-white focus:outline-none"
                    style="border: 2px solid #b0bcc4; background-color: #0f1419;" 
                    onfocus="this.style.borderColor='#ffffff'; this.style.boxShadow='0 0 0 2px #b0bcc4'" 
                    onblur="this.style.borderColor='#b0bcc4'; this.style.boxShadow=''"
                >
            </div>

            <!-- Date Filter Dropdown -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Filter by Date</label>
                <select 
                    name="date_filter" 
                    class="px-4 py-2 rounded-lg text-white focus:outline-none"
                    style="border: 2px solid #b0bcc4; background-color: #0f1419; min-width: 180px;"
                    onfocus="this.style.borderColor='#ffffff'"
                    onblur="this.style.borderColor='#b0bcc4'"
                >
                    <option value="" style="background-color: #0f1419; color: white;">All Time</option>
                    <option value="today" <?php echo e(request('date_filter') == 'today' ? 'selected' : ''); ?> style="background-color: #0f1419; color: white;">Today</option>
                    <option value="3days" <?php echo e(request('date_filter') == '3days' ? 'selected' : ''); ?> style="background-color: #0f1419; color: white;">Last 3 Days</option>
                    <option value="week" <?php echo e(request('date_filter') == 'week' ? 'selected' : ''); ?> style="background-color: #0f1419; color: white;">Last Week</option>
                    <option value="month" <?php echo e(request('date_filter') == 'month' ? 'selected' : ''); ?> style="background-color: #0f1419; color: white;">Last Month</option>
                </select>
            </div>

            <!-- Filter Button -->
            <button type="submit" class="px-6 py-2 rounded-lg font-bold transition-colors" style="background-color: #0f6fdd; color: #ffffff; border: 2px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#1a7fff'" onmouseout="this.style.backgroundColor='#0f6fdd'">
                Apply Filter
            </button>

            <!-- Clear Filters -->
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="px-6 py-2 rounded-lg font-bold transition-colors text-center" style="background-color: transparent; color: #b0bcc4; border: 2px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#1a7fff'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#b0bcc4';">
                Clear
            </a>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="transition-colors" style="border-bottom: 2px solid #b0bcc4; background-color: #0f6fdd;">
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Order Number</th>
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Customer</th>
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Date Created</th>
                        <th class="px-6 py-4 text-right text-sm font-bold" style="color: #ffffff;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="transition-colors" style="border-bottom: 2px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#0f6fdd'" onmouseout="this.style.backgroundColor='transparent'">
                            <td class="px-6 py-4 font-bold" style="color: #b0bcc4;">#<?php echo e($order->order_number); ?></td>
                            <td class="px-6 py-4" style="color: #ffffff;"><?php echo e($order->user->name ?? 'Unknown'); ?></td>
                            <td class="px-6 py-4 font-bold" style="color: #ffffff;">₱<?php echo e(number_format($order->total, 2)); ?></td>
                            <td class="px-6 py-4">
                                <?php
                                    $statusColor = match($order->status) {
                                        'completed' => '#4caf50',
                                        'cancelled' => '#f44336',
                                        'processing' => '#ff9500',
                                        default => '#b0bcc4'
                                    };
                                    $statusTextColor = in_array($order->status, ['completed', 'cancelled']) ? 'white' : '#0f1419';
                                ?>
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: <?php echo e($statusColor); ?>; color: <?php echo e($statusTextColor); ?>;"><?php echo e(ucfirst($order->status)); ?></span>
                            </td>
                            <td class="px-6 py-4" style="color: #b0bcc4;"><?php echo e($order->created_at->format('M d, Y h:i A')); ?></td>
                            <td class="px-6 py-4 text-right">
                                <div style="display: flex; gap: 6px; justify-content: flex-end;">
                                    <!-- View Button -->
                                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-semibold transition-all" style="background-color: #0f6fdd; color: #ffffff; border: 1px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#1a7fff'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.2)'" onmouseout="this.style.backgroundColor='#0f6fdd'; this.style.boxShadow=''">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        View
                                    </a>
                                    <!-- Delete Button -->
                                    <button type="button" onclick="deleteOrder(<?php echo e($order->id); ?>)" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-semibold transition-all" style="background-color: #f44336; color: white; border: 1px solid #f44336; cursor: pointer;" onmouseover="this.style.backgroundColor='#ff6b6b'; this.style.boxShadow='0 2px 4px rgba(244,67,54,0.3)'" onmouseout="this.style.backgroundColor='#f44336'; this.style.boxShadow=''">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center" style="color: #b0bcc4;">
                                No orders found
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if($orders->hasPages()): ?>
        <div class="mt-8 flex justify-center">
            <?php echo e($orders->links('pagination::tailwind')); ?>

        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        function deleteOrder(orderId) {
            Swal.fire({
                title: 'Delete Order?',
                text: 'This action cannot be undone. The order will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f44336',
                cancelButtonColor: '#666',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                background: '#0f1419',
                color: '#ffffff',
                titleColor: '#ffffff',
                iconColor: '#ff9500',
                didOpen: () => {
                    document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create form and submit delete request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/orders/${orderId}`;
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    document.body.appendChild(form);
                    
                    // Show loading state
                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Please wait while the order is being deleted.',
                        icon: 'info',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                            document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                        },
                        background: '#0f1419',
                        color: '#ffffff',
                        titleColor: '#ffffff',
                        iconColor: '#b0bcc4'
                    });
                    
                    // Add event listener for successful submission
                    form.addEventListener('submit', function() {
                        setTimeout(() => {
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: 'The order has been deleted successfully.',
                                icon: 'success',
                                confirmButtonColor: '#4caf50',
                                background: '#0f1419',
                                color: '#ffffff',
                                titleColor: '#4caf50',
                                iconColor: '#4caf50',
                                didOpen: () => {
                                    document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                                },
                                didClose: () => {
                                    // Redirect to orders list after alert closes
                                    window.location.href = '<?php echo e(route("admin.orders.index")); ?>';
                                }
                            });
                        }, 500);
                    });
                    
                    form.submit();
                }
            });
        }
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\admin\orders\index.blade.php ENDPATH**/ ?>