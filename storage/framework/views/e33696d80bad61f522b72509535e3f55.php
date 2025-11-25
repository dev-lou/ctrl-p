<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'primary', // primary, secondary, ghost, danger
    'size' => 'md', // sm, md, lg
    'disabled' => false,
    'type' => 'button',
    'href' => null,
    'class' => '',
]));

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

foreach (array_filter(([
    'variant' => 'primary', // primary, secondary, ghost, danger
    'size' => 'md', // sm, md, lg
    'disabled' => false,
    'type' => 'button',
    'href' => null,
    'class' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    // Base classes
    $baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-200 ease-out';
    
    // Variant styles
    $variants = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white shadow-sm hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-900 shadow-sm hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2',
        'ghost' => 'bg-transparent hover:bg-gray-100 text-gray-900 active:scale-95 focus:outline-none focus:ring-2 focus:ring-gray-400',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white shadow-sm hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2',
    ];
    
    // Size classes
    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm rounded-lg',
        'md' => 'px-4 py-2.5 text-base rounded-lg',
        'lg' => 'px-6 py-3 text-lg rounded-lg',
    ];
    
    // Disabled state
    $disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer';
    
    $computedClass = "{$baseClasses} {$variants[$variant]} {$sizes[$size]} {$disabledClasses} {$class}";
?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->class($computedClass)->except(['variant', 'size', 'disabled', 'type', 'href', 'class'])); ?>>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button 
        type="<?php echo e($type); ?>"
        <?php echo e($disabled ? 'disabled' : ''); ?>

        <?php echo e($attributes->class($computedClass)->except(['variant', 'size', 'disabled', 'type', 'href', 'class'])); ?>

    >
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\components\button.blade.php ENDPATH**/ ?>