<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'Admin Dashboard']));

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

foreach (array_filter((['title' => 'Admin Dashboard']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title); ?> - <?php echo e(config('app.name', 'IGP Hub')); ?> Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="text-white font-inter antialiased" style="background: linear-gradient(135deg, #0f0f1e 0%, #1a1a3e 50%, #0f0f1e 100%); margin: 0; padding: 0;">
    <!-- Grid Container: Two columns (Sidebar | Main Content) -->
    <div class="grid h-screen overflow-hidden gap-0" style="display: grid; grid-template-columns: 280px 1fr; grid-template-rows: 1fr;" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar Column (Fixed 280px width) -->
        <div style="grid-column: 1 / 2; grid-row: 1 / 2; overflow: hidden;">
            <?php if (isset($component)) { $__componentOriginalbebe114f3ccde4b38d7462a3136be045 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbebe114f3ccde4b38d7462a3136be045 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbebe114f3ccde4b38d7462a3136be045)): ?>
<?php $attributes = $__attributesOriginalbebe114f3ccde4b38d7462a3136be045; ?>
<?php unset($__attributesOriginalbebe114f3ccde4b38d7462a3136be045); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbebe114f3ccde4b38d7462a3136be045)): ?>
<?php $component = $__componentOriginalbebe114f3ccde4b38d7462a3136be045; ?>
<?php unset($__componentOriginalbebe114f3ccde4b38d7462a3136be045); ?>
<?php endif; ?>
        </div>

        <!-- Main Content Column (Takes remaining space) -->
        <div style="grid-column: 2 / 3; grid-row: 1 / 2; display: flex; flex-direction: column; overflow: hidden;">
            <!-- Mobile Header (only visible on small screens) -->
            <div class="lg:hidden px-6 py-4 flex items-center gap-4" style="background: linear-gradient(90deg, #1e40af 0%, #0c4a6e 100%); border-bottom: 1px solid rgba(59, 130, 246, 0.3); flex-shrink: 0;">
                <button 
                    @click="sidebarOpen = !sidebarOpen"
                    class="p-2 rounded-lg transition-colors"
                    style="color: #93c5fd;"
                    onmouseover="this.style.color='#ffffff'; this.style.backgroundColor='rgba(59, 130, 246, 0.2)';"
                    onmouseout="this.style.color='#93c5fd'; this.style.backgroundColor='transparent';"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-lg font-bold flex-1" style="color: #ffffff;"><?php echo e($title); ?></h1>
            </div>

            <!-- Page Content (Scrollable) -->
            <main class="flex-1 overflow-y-auto" style="background: linear-gradient(135deg, #0f0f1e 0%, #1a1a3e 50%, #0f0f1e 100%);">
                <div class="w-full px-6 sm:px-8 lg:px-12 py-8">
                    <?php echo e($slot); ?>

                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div 
        x-show="sidebarOpen && window.innerWidth < 1024"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"
        style="display: none;"
    ></div>

    <!-- Alpine.js for interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\components\admin-layout.blade.php ENDPATH**/ ?>