<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'status' => 'default', // default, pending, processing, completed, cancelled, danger, success
    'size' => 'md', // sm, md, lg
    'dot' => true,
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
    'status' => 'default', // default, pending, processing, completed, cancelled, danger, success
    'size' => 'md', // sm, md, lg
    'dot' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $statusConfig = [
        'default' => [
            'bg' => 'bg-gray-100',
            'text' => 'text-gray-800',
            'dot' => 'bg-gray-400',
            'label' => 'Default',
        ],
        'pending' => [
            'bg' => 'bg-yellow-100',
            'text' => 'text-yellow-800',
            'dot' => 'bg-yellow-500',
            'label' => 'Pending',
        ],
        'processing' => [
            'bg' => 'bg-blue-100',
            'text' => 'text-blue-800',
            'dot' => 'bg-blue-500',
            'label' => 'Processing',
        ],
        'completed' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-800',
            'dot' => 'bg-green-500',
            'label' => 'Completed',
        ],
        'cancelled' => [
            'bg' => 'bg-gray-200',
            'text' => 'text-gray-700',
            'dot' => 'bg-gray-400',
            'label' => 'Cancelled',
        ],
        'danger' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-800',
            'dot' => 'bg-red-500',
            'label' => 'Error',
        ],
        'success' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-800',
            'dot' => 'bg-green-500',
            'label' => 'Success',
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['default'];

    $sizes = [
        'sm' => 'px-2.5 py-1 text-xs font-medium rounded',
        'md' => 'px-3 py-1.5 text-sm font-medium rounded-lg',
        'lg' => 'px-4 py-2 text-base font-medium rounded-lg',
    ];
?>

<span class="inline-flex items-center gap-2 <?php echo e($config['bg']); ?> <?php echo e($config['text']); ?> <?php echo e($sizes[$size]); ?>">
    <?php if($dot): ?>
        <span class="inline-flex">
            <span class="h-1.5 w-1.5 rounded-full <?php echo e($config['dot']); ?>"></span>
        </span>
    <?php endif; ?>
    <?php echo e($slot ?: $config['label']); ?>

</span>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\components\badge.blade.php ENDPATH**/ ?>