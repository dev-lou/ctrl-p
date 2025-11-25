<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => '',
    'label' => '',
    'maxFiles' => 1,
    'acceptedTypes' => 'image/jpeg,image/png,application/pdf',
    'maxSizeMb' => 10,
    'required' => false,
    'helpText' => '',
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
    'name' => '',
    'label' => '',
    'maxFiles' => 1,
    'acceptedTypes' => 'image/jpeg,image/png,application/pdf',
    'maxSizeMb' => 10,
    'required' => false,
    'helpText' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div 
    x-data="fileUploader()"
    @drop.prevent="handleDrop"
    @dragover.prevent="isDragging = true"
    @dragleave.prevent="isDragging = false"
    class="flex flex-col gap-3"
>
    <?php if($label): ?>
        <label class="block text-sm font-medium text-gray-700">
            <?php echo e($label); ?>

            <?php if($required): ?>
                <span class="text-red-500 ml-1">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <!-- Upload Area -->
    <div
        :class="isDragging && 'bg-blue-50 border-blue-400'"
        class="relative border-2 border-dashed border-gray-300 rounded-lg p-8 transition-all duration-200 ease-out cursor-pointer hover:border-gray-400 bg-gray-50"
    >
        <input
            type="file"
            x-ref="fileInput"
            @change="handleFiles"
            <?php echo e($maxFiles > 1 ? 'multiple' : ''); ?>

            accept="<?php echo e($acceptedTypes); ?>"
            <?php echo e($required ? 'required' : ''); ?>

            class="hidden"
            name="<?php echo e($name); ?>[]"
        />

        <div @click="$refs.fileInput.click()" class="text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-8-8l-4-4m0 0l-4 4m4-4v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p class="mt-3 text-sm font-medium text-gray-900">
                Drop your files here or <span class="text-blue-600 hover:text-blue-700">browse</span>
            </p>
            <p class="mt-1 text-xs text-gray-500">
                <?php echo e($maxFiles > 1 ? "Up to $maxFiles files" : "Single file"); ?> • Max <?php echo e($maxSizeMb); ?>MB
            </p>
        </div>
    </div>

    <?php if($helpText): ?>
        <p class="text-xs text-gray-500"><?php echo e($helpText); ?></p>
    <?php endif; ?>

    <!-- File List -->
    <div x-show="files.length > 0" class="mt-4">
        <ul class="space-y-2">
            <template x-for="(file, index) in files" :key="index">
                <li class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 16.5a1 1 0 001-1V10a1 1 0 00-2 0v5.5a1 1 0 001 1zm-7-4a1 1 0 011-1h12a1 1 0 110 2H2a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900 truncate" x-text="file.name"></p>
                            <p class="text-xs text-gray-500" x-text="formatFileSize(file.size)"></p>
                        </div>
                    </div>
                    <button
                        @click="removeFile(index)"
                        type="button"
                        class="ml-2 text-gray-400 hover:text-red-600 transition-colors duration-150 flex-shrink-0"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </li>
            </template>
        </ul>
    </div>
</div>

<script>
function fileUploader() {
    return {
        files: [],
        isDragging: false,
        maxFiles: <?php echo e($maxFiles); ?>,
        maxSizeMb: <?php echo e($maxSizeMb); ?>,

        handleFiles(event) {
            const newFiles = Array.from(event.target.files);
            this.addFiles(newFiles);
        },

        handleDrop(event) {
            this.isDragging = false;
            const droppedFiles = Array.from(event.dataTransfer.files);
            this.addFiles(droppedFiles);
        },

        addFiles(newFiles) {
            for (let file of newFiles) {
                if (this.files.length >= this.maxFiles && this.maxFiles > 0) {
                    alert(`Maximum ${this.maxFiles} file(s) allowed`);
                    break;
                }

                if (file.size > this.maxSizeMb * 1024 * 1024) {
                    alert(`File "${file.name}" exceeds ${this.maxSizeMb}MB limit`);
                    continue;
                }

                this.files.push(file);
            }
        },

        removeFile(index) {
            this.files.splice(index, 1);
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
        }
    }
}
</script>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\components\file-uploader.blade.php ENDPATH**/ ?>