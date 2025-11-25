<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
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
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'class' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="flex flex-col gap-2">
    <?php if($label): ?>
        <label for="<?php echo e($name); ?>" class="block text-sm font-medium text-gray-700">
            <?php echo e($label); ?>

            <?php if($required): ?>
                <span class="text-red-500 ml-1">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <?php if($type === 'textarea'): ?>
        <textarea
            id="<?php echo e($name); ?>"
            name="<?php echo e($name); ?>"
            <?php echo e($disabled ? 'disabled' : ''); ?>

            <?php echo e($readonly ? 'readonly' : ''); ?>

            <?php echo e($required ? 'required' : ''); ?>

            placeholder="<?php echo e($placeholder); ?>"
            class="w-full px-4 py-2.5 text-base rounded-lg border-2 border-gray-200 bg-white text-gray-900 placeholder-gray-400 transition-all duration-200 ease-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-offset-0 <?php echo e($error ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''); ?> <?php echo e($disabled ? 'opacity-50 cursor-not-allowed bg-gray-100' : ''); ?> <?php echo e($class); ?>"
            rows="4"
        ><?php echo e($value); ?></textarea>
    <?php elseif($type === 'select'): ?>
        <select
            id="<?php echo e($name); ?>"
            name="<?php echo e($name); ?>"
            <?php echo e($disabled ? 'disabled' : ''); ?>

            <?php echo e($required ? 'required' : ''); ?>

            class="w-full px-4 py-2.5 text-base rounded-lg border-2 border-gray-200 bg-white text-gray-900 transition-all duration-200 ease-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-offset-0 appearance-none <?php echo e($error ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''); ?> <?php echo e($disabled ? 'opacity-50 cursor-not-allowed bg-gray-100' : ''); ?> <?php echo e($class); ?>"
        >
            <?php echo e($slot); ?>

        </select>
    <?php else: ?>
        <input
            type="<?php echo e($type); ?>"
            id="<?php echo e($name); ?>"
            name="<?php echo e($name); ?>"
            value="<?php echo e(old($name, $value)); ?>"
            <?php echo e($disabled ? 'disabled' : ''); ?>

            <?php echo e($readonly ? 'readonly' : ''); ?>

            <?php echo e($required ? 'required' : ''); ?>

            placeholder="<?php echo e($placeholder); ?>"
            class="w-full px-4 py-2.5 text-base rounded-lg border-2 border-gray-200 bg-white text-gray-900 placeholder-gray-400 transition-all duration-200 ease-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-offset-0 <?php echo e($error ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''); ?> <?php echo e($disabled ? 'opacity-50 cursor-not-allowed bg-gray-100' : ''); ?> <?php echo e($readonly ? 'bg-gray-100 cursor-not-allowed' : ''); ?> <?php echo e($class); ?>"
        />
    <?php endif; ?>

    <?php if($error): ?>
        <p class="text-sm font-medium text-red-600"><?php echo e($error); ?></p>
    <?php endif; ?>

    <?php echo e($help ?? ''); ?>

</div>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\components\input.blade.php ENDPATH**/ ?>