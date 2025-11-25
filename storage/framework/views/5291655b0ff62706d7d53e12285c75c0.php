<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<aside class="w-full h-full text-white flex flex-col overflow-hidden shadow-2xl" style="background: linear-gradient(180deg, #0f1419 0%, #1a1f2e 100%); border-right: 3px solid #2a3f5f; display: flex; flex-direction: column;">
    <!-- Logo & Page Title -->
    <div class="px-6 py-6" style="border-bottom: 2px solid #2a3f5f;">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 mb-4 transition-all duration-300" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center shadow-lg" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); border: 2px solid #00d9ff;">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" style="color: #ffffff;">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a1 1 0 001 1h12a1 1 0 00-1-1V6a2 2 0 00-2-2H4zm12 4h1a1 1 0 100-2h-1a1 1 0 100 2zM4 13a1 1 0 011-1h6a1 1 0 110 2H5a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="font-bold text-white text-xl" style="letter-spacing: 0.5px;"><?php echo e(config('app.name', 'IGP Hub')); ?></p>
                <p class="text-xs font-semibold" style="color: #00d9ff;">Admin Panel</p>
            </div>
        </a>
        <!-- Page Title -->
        <div class="mt-4 pt-4" style="border-top: 2px solid #2a3f5f;">
            <p class="text-xs font-semibold" style="color: #b0bcc4; text-transform: uppercase; letter-spacing: 0.5px;">Current Page</p>
            <h1 class="text-lg font-bold mt-1" style="color: #ffffff;"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto min-h-0" style="scrollbar-width: thin; scrollbar-color: #2a3f5f #0f1419;">
        <!-- Dashboard -->
        <a
            href="<?php echo e(route('admin.dashboard')); ?>"
            class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition-all duration-300"
            <?php if(request()->routeIs('admin.dashboard')): ?>
                style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: #ffffff; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.4); border: 2px solid #00d9ff;"
            <?php else: ?>
                style="color: #b0bcc4; border: 2px solid transparent;"
                onmouseover="this.style.backgroundColor='rgba(15, 111, 221, 0.15)'; this.style.color='#ffffff'; this.style.borderColor='#2a3f5f'; this.style.transform='translateX(4px)';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#b0bcc4'; this.style.borderColor='transparent'; this.style.transform='translateX(0)';"
            <?php endif; ?>
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4v4m4-4v4m4-12l2 3"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Inventory -->
        <div x-data="{ inventoryOpen: <?php echo e(request()->routeIs('admin.inventory.*') ? 'true' : 'false'); ?> }" class="space-y-2">
            <button
                @click="inventoryOpen = !inventoryOpen"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition-all duration-300"
                style="color: #b0bcc4; border: 2px solid transparent;"
                onmouseover="this.style.backgroundColor='rgba(15, 111, 221, 0.15)'; this.style.color='#ffffff'; this.style.borderColor='#2a3f5f';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#b0bcc4'; this.style.borderColor='transparent';"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4v10M7 11l8 4m0-4v10"></path>
                </svg>
                <span>Inventory</span>
                <svg class="w-4 h-4 ml-auto transition-transform duration-300" :class="{ 'rotate-180': inventoryOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="inventoryOpen" x-transition class="ml-2 space-y-1 pl-4" style="border-left: 2px solid #2a3f5f;">
                <a href="<?php echo e(route('admin.inventory.index')); ?>" class="block px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300" style="<?php if(request()->routeIs('admin.inventory.index')): ?>background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: #ffffff;<?php else: ?> color: #b0bcc4;<?php endif; ?>" onmouseover="this.style.backgroundColor='rgba(15, 111, 221, 0.2)'; this.style.color='#ffffff';" onmouseout="<?php if(!request()->routeIs('admin.inventory.index')): ?>this.style.backgroundColor='transparent'; this.style.color='#b0bcc4';<?php endif; ?>">📦 Products</a>
                <a href="<?php echo e(route('admin.inventory.create')); ?>" class="block px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300" style="<?php if(request()->routeIs('admin.inventory.create')): ?>background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: #ffffff;<?php else: ?> color: #b0bcc4;<?php endif; ?>" onmouseover="this.style.backgroundColor='rgba(15, 111, 221, 0.2)'; this.style.color='#ffffff';" onmouseout="<?php if(!request()->routeIs('admin.inventory.create')): ?>this.style.backgroundColor='transparent'; this.style.color='#b0bcc4';<?php endif; ?>">➕ Add Product</a>
            </div>
        </div>

        <!-- Buy List -->
        <a
            href="<?php echo e(route('admin.buy-list.index')); ?>"
            class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition-all duration-300"
            <?php if(request()->routeIs('admin.buy-list.*')): ?>
                style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: #ffffff; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.4); border: 2px solid #00d9ff;"
            <?php else: ?>
                style="color: #b0bcc4; border: 2px solid transparent;"
                onmouseover="this.style.backgroundColor='rgba(15, 111, 221, 0.15)'; this.style.color='#ffffff'; this.style.borderColor='#2a3f5f'; this.style.transform='translateX(4px)';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#b0bcc4'; this.style.borderColor='transparent'; this.style.transform='translateX(0)';"
            <?php endif; ?>
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <span>Buy List</span>
        </a>

        <!-- Orders (Collapsible Dropdown) -->
        <div x-data="{ ordersOpen: <?php echo e(request()->routeIs('admin.orders.*') ? 'true' : 'false'); ?> }" class="space-y-2">
            <button
                @click="ordersOpen = !ordersOpen"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition-all justify-between"
                style="color: #cbd5e1;"
                onmouseover="this.style.backgroundColor='rgba(59, 130, 246, 0.3)'; this.style.color='#ffffff'; this.style.boxShadow='0 4px 6px -1px rgba(59, 130, 246, 0.3)';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#cbd5e1'; this.style.boxShadow='';"
            >
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>Orders</span>
                </div>
                <div class="flex items-center gap-2">
                    <?php if($pendingOrderCount > 0): ?>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold" style="background-color: #f44336; color: white;"><?php echo e($pendingOrderCount); ?></span>
                    <?php endif; ?>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': ordersOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </button>

            <!-- Orders Dropdown Menu -->
            <div x-show="ordersOpen" x-transition class="ml-2 space-y-1 pl-4" style="border-left: 2px solid rgba(59, 130, 246, 0.5);">
                <!-- Pending -->
                <a 
                    href="<?php echo e(route('admin.orders.pending')); ?>" 
                    class="flex items-center justify-between px-4 py-2 rounded text-sm font-semibold transition-all"
                    style="<?php if(request()->routeIs('admin.orders.pending')): ?>background-color: #3b82f6; color: #ffffff;<?php else: ?> color: #93c5fd;<?php endif; ?>"
                    onmouseover="this.style.backgroundColor='rgba(59, 130, 246, 0.5)'; this.style.color='white';"
                    onmouseout="<?php if(!request()->routeIs('admin.orders.pending')): ?>this.style.backgroundColor='transparent'; this.style.color='#93c5fd';<?php endif; ?>"
                >
                    <span>Pending</span>
                    <?php if($pendingOrderCount > 0): ?>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold" style="background-color: #ef4444; color: white;"><?php echo e($pendingOrderCount); ?></span>
                    <?php endif; ?>
                </a>

                <!-- Processing -->
                <a 
                    href="<?php echo e(route('admin.orders.processing')); ?>" 
                    class="flex items-center justify-between px-4 py-2 rounded text-sm font-semibold transition-all"
                    style="<?php if(request()->routeIs('admin.orders.processing')): ?>background-color: #3b82f6; color: #ffffff;<?php else: ?> color: #93c5fd;<?php endif; ?>"
                    onmouseover="this.style.backgroundColor='rgba(59, 130, 246, 0.5)'; this.style.color='white';"
                    onmouseout="<?php if(!request()->routeIs('admin.orders.processing')): ?>this.style.backgroundColor='transparent'; this.style.color='#93c5fd';<?php endif; ?>"
                >
                    <span>Processing</span>
                    <?php if($processingOrderCount > 0): ?>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold" style="background-color: #f97316; color: #0f0f1e;"><?php echo e($processingOrderCount); ?></span>
                    <?php endif; ?>
                </a>

                <!-- Completed -->
                <a 
                    href="<?php echo e(route('admin.orders.completed')); ?>" 
                    class="flex items-center justify-between px-4 py-2 rounded text-sm font-semibold transition-all"
                    style="<?php if(request()->routeIs('admin.orders.completed')): ?>background-color: #3b82f6; color: #ffffff;<?php else: ?> color: #93c5fd;<?php endif; ?>"
                    onmouseover="this.style.backgroundColor='rgba(59, 130, 246, 0.5)'; this.style.color='white';"
                    onmouseout="<?php if(!request()->routeIs('admin.orders.completed')): ?>this.style.backgroundColor='transparent'; this.style.color='#93c5fd';<?php endif; ?>"
                >
                    <span>Completed</span>
                </a>

                <!-- All Orders -->
                <a 
                    href="<?php echo e(route('admin.orders.index')); ?>" 
                    class="flex items-center justify-between px-4 py-2 rounded text-sm font-semibold transition-all"
                    style="<?php if(request()->routeIs('admin.orders.index') && !request()->routeIs('admin.orders.pending') && !request()->routeIs('admin.orders.processing') && !request()->routeIs('admin.orders.completed')): ?>background-color: #3b82f6; color: #ffffff;<?php else: ?> color: #93c5fd;<?php endif; ?>"
                    onmouseover="this.style.backgroundColor='rgba(59, 130, 246, 0.5)'; this.style.color='white';"
                    onmouseout="<?php if(!(request()->routeIs('admin.orders.index') && !request()->routeIs('admin.orders.pending') && !request()->routeIs('admin.orders.processing') && !request()->routeIs('admin.orders.completed'))): ?>this.style.backgroundColor='transparent'; this.style.color='#93c5fd';<?php endif; ?>"
                >
                    <span>All Orders</span>
                </a>
            </div>
        </div>

        <!-- Divider -->
        <div style="border-top: 1px solid rgba(59, 130, 246, 0.3); margin: 1rem 0;"></div>

        <!-- View Customer Site -->
        <a
            href="<?php echo e(route('home')); ?>"
            class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition-all"
            style="color: #cbd5e1; background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%); border: 1px solid rgba(34, 197, 94, 0.3);"
            onmouseover="this.style.backgroundColor='rgba(34, 197, 94, 0.25)'; this.style.color='#86efac'; this.style.boxShadow='0 4px 6px -1px rgba(34, 197, 94, 0.3)';"
            onmouseout="this.style.backgroundColor='linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%)'; this.style.color='#cbd5e1'; this.style.boxShadow='';"
            title="Visit customer-facing website"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
            <span>View Customer Site</span>
        </a>

        <!-- Divider -->
        <div style="border-top: 1px solid rgba(59, 130, 246, 0.3); margin: 1rem 0;"></div>
        <a
            href="<?php echo e(route('admin.audit-logs.index')); ?>"
            class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition-all duration-300"
            <?php if(request()->routeIs('admin.audit-logs.*')): ?>
                style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: #ffffff; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.4); border: 2px solid #00d9ff;"
            <?php else: ?>
                style="color: #b0bcc4; border: 2px solid transparent;"
                onmouseover="this.style.backgroundColor='rgba(15, 111, 221, 0.15)'; this.style.color='#ffffff'; this.style.borderColor='#2a3f5f'; this.style.transform='translateX(4px)';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#b0bcc4'; this.style.borderColor='transparent'; this.style.transform='translateX(0)';"
            <?php endif; ?>
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Audit Logs</span>
        </a>

        <!-- Users Management -->
        <a
            href="<?php echo e(route('admin.users.index')); ?>"
            class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition-all duration-300"
            <?php if(request()->routeIs('admin.users.*')): ?>
                style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: #ffffff; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.4); border: 2px solid #00d9ff;"
            <?php else: ?>
                style="color: #b0bcc4; border: 2px solid transparent;"
                onmouseover="this.style.backgroundColor='rgba(15, 111, 221, 0.15)'; this.style.color='#ffffff'; this.style.borderColor='#2a3f5f'; this.style.transform='translateX(4px)';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#b0bcc4'; this.style.borderColor='transparent'; this.style.transform='translateX(0)';"
            <?php endif; ?>
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a6 6 0 1112 0v-2H6v2z"></path>
            </svg>
            <span>Users</span>
        </a>

        <!-- Settings -->
        <a
            href="<?php echo e(route('admin.settings.index')); ?>"
            class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold transition-all duration-300"
            <?php if(request()->routeIs('admin.settings.*')): ?>
                style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: #ffffff; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.4); border: 2px solid #00d9ff;"
            <?php else: ?>
                style="color: #b0bcc4; border: 2px solid transparent;"
                onmouseover="this.style.backgroundColor='rgba(15, 111, 221, 0.15)'; this.style.color='#ffffff'; this.style.borderColor='#2a3f5f'; this.style.transform='translateX(4px)';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#b0bcc4'; this.style.borderColor='transparent'; this.style.transform='translateX(0)';"
            <?php endif; ?>
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>Settings</span>
        </a>
    </nav>

    <!-- Footer - User Menu -->
    <div class="px-6 py-4 shrink-0" style="border-top: 2px solid #2a3f5f; background: linear-gradient(180deg, #0f1419 0%, #1a1f2e 100%);">
        <!-- User Profile Info with Logout -->
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <?php if(auth()->user()->profile_picture): ?>
                    <img src="<?php echo e(asset('storage/' . auth()->user()->profile_picture)); ?>" alt="Profile" class="w-10 h-10 rounded-full flex-shrink-0 object-cover" style="border: 2px solid #00d9ff; box-shadow: 0 0 12px rgba(0, 217, 255, 0.3);">
                <?php else: ?>
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: #ffffff; border: 2px solid #00d9ff; box-shadow: 0 0 12px rgba(0, 217, 255, 0.3);">
                        <?php echo e(auth()->user()->name[0] ?? 'A'); ?>

                    </div>
                <?php endif; ?>
                <div class="text-left flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate"><?php echo e(auth()->user()->name); ?></p>
                    <p class="text-xs truncate" style="color: #b0bcc4;"><?php echo e(auth()->user()->email); ?></p>
                </div>
            </div>

            <!-- Logout Button Icon -->
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="flex-shrink-0">
                <?php echo csrf_field(); ?>
                <button type="submit" class="p-2 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #ff6b6b 0%, #cc0000 100%); color: white;" title="Logout" onmouseover="this.style.boxShadow='0 4px 12px rgba(255, 107, 107, 0.5)'; this.style.transform='scale(1.05)'" onmouseout="this.style.boxShadow='none'; this.style.transform='scale(1)'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </form>
        </div>

        <div class="mt-3 pt-3" style="border-top: 1px solid #2a3f5f;">
            <p class="text-xs font-semibold" style="color: #b0bcc4;">Version 1.0.0</p>
        </div>
    </div>
</aside><?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\components\admin\sidebar.blade.php ENDPATH**/ ?>