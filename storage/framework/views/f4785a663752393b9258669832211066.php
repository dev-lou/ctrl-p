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
    <?php $__env->startSection('page-title', 'Create Product'); ?>

    <style>
        body {
            font-size: 16px;
            line-height: 1.6;
        }
        .page-header {
            margin-bottom: 32px;
            position: relative;
        }
        .page-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6 0%, transparent 100%);
            border-radius: 2px;
        }
        .form-group {
            margin-bottom: 24px;
        }
        .form-label {
            display: block;
            color: #cbd5e1;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #e2e8f0;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.95rem;
            line-height: 1.6;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .form-input::placeholder {
            color: #64748b;
            font-weight: 400;
        }
        .form-input:hover {
            border-color: rgba(59, 130, 246, 0.5);
            background: rgba(15, 23, 42, 0.8);
        }
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(15, 23, 42, 0.95);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .section-header {
            color: #f1f5f9;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            letter-spacing: 0.3px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
            position: relative;
        }
        .section-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 60px;
            height: 2px;
            background: #3b82f6;
        }
        .btn-primary {
            padding: 10px 20px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.25);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 1px 4px rgba(59, 130, 246, 0.3);
        }
        .btn-cancel {
            background: rgba(30, 41, 59, 0.6);
            color: #94a3b8;
            border: 1px solid rgba(71, 85, 105, 0.4);
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .btn-cancel:hover {
            background: rgba(51, 65, 85, 0.8);
            color: #e2e8f0;
            border-color: rgba(100, 116, 139, 0.6);
        }
        .btn-cancel:active {
            transform: scale(0.98);
        }
        .section-container {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(71, 85, 105, 0.3);
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }
        .section-container:hover {
            border-color: rgba(59, 130, 246, 0.4);
            background: rgba(30, 41, 59, 0.5);
        }
        .input-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        textarea.form-input {
            font-family: inherit;
        }
        select.form-input {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%233b82f6' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 40px;
        }
        select.form-input:hover {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2360a5fa' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        }
        .info-box {
            background: rgba(59, 130, 246, 0.08);
            border-left: 3px solid #3b82f6;
            border-radius: 4px;
            padding: 12px 16px;
            margin-top: 12px;
            font-size: 0.85rem;
            color: #94a3b8;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .info-box::before {
            content: '💡';
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .variant-row {
            transition: background-color 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .variant-row:hover {
            background-color: rgba(59, 130, 246, 0.08);
        }
        .variant-input {
            background: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
        }
        .variant-input:focus {
            background: rgba(15, 23, 42, 0.95) !important;
            border-color: #3b82f6 !important;
        }
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
            padding: 20px;
        }
        .modal-overlay.active {
            display: flex;
            /* make sure we center even in odd stacking contexts */
            align-items: center;
            justify-content: center;
            place-items: center;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .modal-content {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.98) 0%, rgba(30, 41, 59, 0.98) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(59, 130, 246, 0.4);
            border-radius: 12px;
            padding: 28px;
            max-width: 700px;
            width: 100%;
                /* make modal safe for all viewports and keep it centered when smaller
                    - use calc so padding / breathing space is respected */
                max-height: calc(100vh - 64px);
                margin: auto;
            overflow-y: auto;
            animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), 0 0 100px rgba(59, 130, 246, 0.1);
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
        }
        .modal-header h2 {
            color: #f1f5f9;
            font-weight: 600;
            margin: 0;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .modal-close-btn {
            background: rgba(30, 41, 59, 0.8);
            color: #94a3b8;
            border: 1px solid rgba(71, 85, 105, 0.4);
            padding: 8px 14px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .modal-close-btn:hover {
            background: rgba(51, 65, 85, 0.9);
            color: #e2e8f0;
            border-color: rgba(100, 116, 139, 0.6);
        }
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.25);
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.35);
        }
        .btn-danger:active {
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .section-container {
                padding: 20px;
            }
            .input-group {
                grid-template-columns: 1fr;
            }
            .page-header {
                margin-bottom: 20px;
            }
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                grid-template-columns: 1fr !important;
            }
            .section-container {
                padding: 16px;
                margin-bottom: 20px;
            }
            .section-header {
                font-size: 1.1rem;
                margin-bottom: 16px;
            }
            .form-label {
                font-size: 0.9rem;
            }
            .form-input {
                font-size: 0.95rem;
                padding: 10px 12px;
            }
            h1 {
                font-size: 2rem !important;
            }
            .btn-primary, .btn-cancel {
                padding: 10px 16px;
                font-size: 0.95rem;
            }
        }
    </style>

    <!-- Breadcrumb Navigation -->
    <nav style="margin-bottom: 24px; padding: 14px 20px; background: linear-gradient(135deg, rgba(15, 23, 42, 0.6) 0%, rgba(30, 41, 59, 0.6) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; display: flex; align-items: center; gap: 8px;">
        <a href="<?php echo e(route('admin.dashboard')); ?>" style="color: #94a3b8; font-weight: 500; font-size: 0.9rem; transition: color 0.2s;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#94a3b8'">Dashboard</a>
        <span style="color: #475569; font-weight: 600;">›</span>
        <a href="<?php echo e(route('admin.inventory.index')); ?>" style="color: #94a3b8; font-weight: 500; font-size: 0.9rem; transition: color 0.2s;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#94a3b8'">Inventory</a>
        <span style="color: #475569; font-weight: 600;">›</span>
        <span style="color: #f1f5f9; font-weight: 600; font-size: 0.9rem;">Create Product</span>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h1 style="color: #f1f5f9; font-size: 2.2rem; margin: 0 0 8px 0; font-weight: 600; letter-spacing: -0.5px; display: flex; align-items: center; gap: 12px;">
                    <span style="display: flex; align-items: center; justify-content: center; width: 44px; height: 44px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 8px; font-size: 1.3rem;">✚</span>
                    Create Product
                </h1>
                <p style="color: #94a3b8; margin: 0 0 0 56px; font-size: 0.95rem; font-weight: 400;">Add a new product to your inventory system</p>
            </div>
            <a href="<?php echo e(route('admin.inventory.index')); ?>" class="btn-cancel" style="white-space: nowrap; margin: 0;">
                ← Back to Inventory
            </a>
        </div>
    </div>

    <!-- Main Container -->
    <div style="display: grid; grid-template-columns: 1fr 360px; gap: 28px; margin-bottom: 40px;" class="main-container">
        <!-- Left Panel: Form -->
        <div style="min-width: 0;">
            <form id="productForm" action="<?php echo e(route('admin.inventory.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <!-- Product Details Section -->
                <div class="section-container">
                    <div class="section-header">
                        <span style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 1.3rem;">📝</span>
                            <span>Product Information</span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>" required class="form-input" placeholder="Enter product name" />
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Product Slug</label>
                        <input type="text" name="slug" value="<?php echo e(old('slug')); ?>" class="form-input" placeholder="auto-generated from product name" style="background: #0f1419; opacity: 0.8;" />
                        <p style="color: #94a3b8; font-size: 0.85rem; margin-top: 10px;">Auto-generated from product name. Edit manually if needed.</p>
                        <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5" class="form-input" style="resize: none; font-size: 1rem;" placeholder="Add product description..."><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="input-group">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Base Price (₱) *</label>
                            <input type="number" name="base_price" value="<?php echo e(old('base_price')); ?>" step="0.01" required class="form-input" placeholder="0.00" />
                            <?php $__errorArgs = ['base_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-input" style="cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2712%27 height=%278%27 viewBox=%270 0 12 8%27%3e%3cpath fill=%27%2394a3b8%27 d=%27M6 8L0 0h12z%27/%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 16px center; background-size: 12px; padding-right: 40px;">
                                <option value="active" <?php echo e(old('status', 'active') === 'active' ? 'selected' : ''); ?>>🟢 Active</option>
                                <option value="inactive" <?php echo e(old('status') === 'inactive' ? 'selected' : ''); ?>>🔴 Inactive</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Low Stock Threshold</label>
                        <input type="number" name="low_stock_threshold" value="<?php echo e(old('low_stock_threshold', 20)); ?>" class="form-input" min="1" required>
                        <div class="info-box" style="margin-top: 8px;">
                            <span style="color: #cbd5e1;">Receive alerts when stock falls below this level</span>
                        </div>
                        <?php $__errorArgs = ['low_stock_threshold'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Stock Management -->
                    <div style="margin-top: 28px; padding-top: 24px; border-top: 1px solid rgba(71, 85, 105, 0.3);">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                            <span style="font-size: 1.3rem;">📊</span>
                            <h4 style="color: #cbd5e1; font-weight: 600; font-size: 0.95rem; margin: 0; letter-spacing: 0.3px;">Stock Management</h4>
                        </div>

                        <div class="form-group" style="margin-bottom: 12px;">
                            <label class="form-label">Default Stock *</label>
                            <input type="number" name="current_stock" value="<?php echo e(old('current_stock', 0)); ?>" min="0" required class="form-input" placeholder="0" />
                            <?php $__errorArgs = ['current_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #fca5a5; font-size: 0.85rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="info-box" style="margin-top: 12px;">
                            <span style="color: #cbd5e1; font-size: 0.85rem;"><strong style="color: #e2e8f0;">Tip:</strong> Add variants above to track stock by size, color, or style. Each variant has its own stock level.</span>
                        </div>
                    </div>
                </div>

                <!-- Manage Variants Section -->
                <div class="section-container">
                    <div class="section-header">
                        <span style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 1.3rem;">📦</span>
                            <span>Manage Variants</span>
                        </span>
                        <button type="button" id="toggleNewVariantBtn" class="btn-primary" style="padding: 8px 16px; font-size: 0.85rem; display: flex; align-items: center; gap: 6px;">
                            <span style="font-size: 1rem;">✚</span>
                            <span>Add Variant</span>
                        </button>
                    </div>

                    <!-- Variants Summary Card -->
                    <div id="variantSummaryCard" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 20px; margin-bottom: 24px; backdrop-filter: blur(10px); display: none;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                            <div style="text-align: center;">
                                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 6px 0;">Total Stock</p>
                                <span id="totalStock" style="color: #3b82f6; font-weight: 700; font-size: 2rem;">0</span>
                                <span style="color: #94a3b8; font-size: 0.85rem; margin-left: 6px;">units</span>
                            </div>
                            <div style="text-align: center;">
                                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 6px 0;">Low Stock Variants</p>
                                <span id="lowStockCount" style="color: #ff9500; font-weight: 700; font-size: 2rem;">0</span>
                            </div>
                            <div style="text-align: center;">
                                <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 6px 0;">Avg. Price Modifier</p>
                                <span id="avgPriceModifier" style="color: #22c55e; font-weight: 700; font-size: 2rem;">₱0.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Variants Table View -->
                    <div id="variantTableContainer" style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; overflow: hidden; margin-bottom: 24px; display: none;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-bottom: 1px solid rgba(59, 130, 246, 0.3);">
                                    <th style="padding: 14px 16px; text-align: left; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Variant Name</th>
                                    <th style="padding: 14px 16px; text-align: center; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Stock</th>
                                    <th style="padding: 14px 16px; text-align: center; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Price Modifier</th>
                                    <th style="padding: 14px 16px; text-align: center; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Size</th>
                                    <th style="padding: 14px 16px; text-align: center; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Color</th>
                                    <th style="padding: 14px 16px; text-align: center; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Weight</th>
                                    <th style="padding: 14px 16px; text-align: center; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="variantTableBody">
                                <!-- Variants will be added here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 48px 32px; text-align: center; margin-bottom: 24px;">
                        <div style="font-size: 4rem; margin-bottom: 16px; opacity: 0.5;">📦</div>
                        <p style="color: #94a3b8; font-size: 1rem; margin: 0;">No variants added yet. Click "Add Variant" to get started.</p>
                    </div>

                    <!-- modal removed from inline location to avoid fixed-position nesting issues -->
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 12px; margin-top: 32px; padding-top: 20px; border-top: 1px solid rgba(71, 85, 105, 0.3); flex-wrap: wrap;">
                    <button type="button" id="saveBtn" style="flex: 1; min-width: 140px; padding: 12px 20px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; transition: all 0.2s ease; letter-spacing: 0.3px; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3); display: flex; align-items: center; justify-content: center; gap: 8px;" onmouseover="this.style.boxShadow='0 4px 16px rgba(59, 130, 246, 0.4)'; this.style.transform='translateY(-1px)';" onmouseout="this.style.boxShadow='0 2px 8px rgba(59, 130, 246, 0.3)'; this.style.transform='translateY(0)';">
                        <span style="font-size: 1.1rem;">✓</span>
                        <span>Create Product</span>
                    </button>
                    <a href="<?php echo e(route('admin.inventory.index')); ?>" class="btn-cancel" style="flex: 1; min-width: 140px; padding: 12px 20px; font-size: 1rem; font-weight: 600; letter-spacing: 0.3px; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span style="font-size: 1.1rem;">✕</span>
                        <span>Cancel</span>
                    </a>
                </div>

                <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" />
            </form>
        </div>

        <!-- Right Panel: Image -->
        <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 8px; padding: 20px; height: fit-content; position: sticky; top: 20px; z-index: 1; transition: all 0.3s ease;" onmouseover="this.style.borderColor='rgba(59, 130, 246, 0.4)'; this.style.background='rgba(30, 41, 59, 0.5)';" onmouseout="this.style.borderColor='rgba(71, 85, 105, 0.3)'; this.style.background='rgba(30, 41, 59, 0.4)';">
            <h3 style="color: #cbd5e1; font-weight: 600; margin: 0 0 16px 0; font-size: 0.95rem; letter-spacing: 0.3px; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 1.2rem;">🖼️</span>
                <span>Product Image</span>
            </h3>

            <label for="imageInput" id="imagePreview" style="width: 100%; aspect-ratio: 1; background: rgba(15, 23, 42, 0.6); border: 2px dashed rgba(100, 116, 139, 0.5); border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; margin-bottom: 16px; overflow: hidden; transition: all 0.25s ease;" onmouseover="this.style.borderColor='#3b82f6'; this.style.backgroundColor='rgba(59, 130, 246, 0.05)'; this.style.boxShadow='0 0 20px rgba(59, 130, 246, 0.15)'; this.style.transform='scale(1.01)';" onmouseout="this.style.borderColor='rgba(100, 116, 139, 0.5)'; this.style.backgroundColor='rgba(15, 23, 42, 0.6)'; this.style.boxShadow='none'; this.style.transform='scale(1)';">
                <div style="text-align: center;">
                    <div style="font-size: 56px; margin-bottom: 12px; opacity: 0.7;">📸</div>
                    <p style="color: #cbd5e1; font-weight: 600; margin: 0; font-size: 1rem;">Click to Upload</p>
                    <p style="color: #64748b; font-size: 0.85rem; margin: 6px 0 0 0;">or drag & drop</p>
                </div>
            </label>

            <div id="imageStatus" style="display:none; color: #94a3b8; font-size: 0.85rem; margin-bottom: 8px; text-align:center"></div>
            <!-- Visible debug log to capture picker events (helpful if devtools aren't open) -->
            <div id="imageDebug" style="display:block; color:#94a3b8; font-size:0.8rem; margin-top:6px; padding:8px; background: rgba(2,6,23,0.3); border-radius:6px; max-height:120px; overflow:auto; white-space:pre-wrap; font-family: monospace;">Debug log (events will appear here)</div>

            <div style="background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 6px; padding: 12px; text-align: center; margin-bottom: 16px;">
                <p style="color: #cbd5e1; font-weight: 600; margin: 0 0 4px 0; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 6px;">
                    <span>📋</span>
                    <span>Image Guidelines</span>
                </p>
                <p style="color: #94a3b8; font-size: 0.8rem; margin: 0; line-height: 1.5;">JPG, PNG, GIF, WebP • Max 5MB</p>
            </div>

            <button type="button" id="removeImageBtn" class="btn-danger" style="width: 100%; padding: 12px; font-size: 1rem; font-weight: 700; display: none;">
                🗑️ Remove Image
            </button>
        </div>
    </div>

    <!-- Variant modal moved to page root so it's not constrained by parent stacking contexts -->
    <div id="variantModal" class="modal-overlay" aria-hidden="true">
        <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="variantModalTitle">
            <div class="modal-header" style="position: relative;">
                <h2 id="variantModalTitle" style="display: flex; align-items: center; justify-content: center; width: 100%; gap: 10px;">
                    <span style="font-size: 1.4rem;">➕</span>
                    <span>Create New Variant</span>
                </h2>
                <button type="button" class="modal-close-btn" onclick="closeVariantModal();" style="position: absolute; right: 18px; top: 18px;">✕</button>
            </div>
            <div id="modalVariantsContainer" style="display: grid; gap: 20px; margin-bottom: 24px;"></div>
            <div style="display: grid; gap: 10px;">
                <button type="button" onclick="addVariantToModal();" class="btn-secondary" style="width: 100%; padding: 10px; font-size: 0.9rem; background: rgba(30, 41, 59, 0.8); color: #e2e8f0; border: 1px solid rgba(71, 85, 105, 0.4); border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='rgba(51, 65, 85, 0.9)'; this.style.borderColor='rgba(100, 116, 139, 0.6)';" onmouseout="this.style.backgroundColor='rgba(30, 41, 59, 0.8)'; this.style.borderColor='rgba(71, 85, 105, 0.4)';">
                    ✚ Add Another Variant
                </button>
                <button type="button" onclick="saveModalVariants();" style="width: 100%; padding: 10px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.9rem; transition: all 0.2s ease; box-shadow: 0 2px 6px rgba(59, 130, 246, 0.25);" onmouseover="this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.4)'; this.style.transform='translateY(-1px)';" onmouseout="this.style.boxShadow='0 2px 6px rgba(59, 130, 246, 0.25)'; this.style.transform='translateY(0)';">
                    ✓ Save Variants
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let modalVariantCount = 0;

        // Auto-generate slug from product name
        document.querySelector('input[name="name"]').addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            document.querySelector('input[name="slug"]').value = slug;
        });

        function createVariantInput(index, isModal = false) {
            const div = document.createElement('div');
            div.style.cssText = 'background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 6px; padding: 16px; transition: all 0.25s ease;';
            div.innerHTML = `
                <div style="margin-bottom: 12px;">
                    <label style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px; font-size: 0.85rem; letter-spacing: 0.3px;">Variant Name</label>
                    <input type="text" name="variants[${index}][name]" placeholder="e.g., Red Large, Blue Medium" style="width: 100%; padding: 10px 14px; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(59, 130, 246, 0.3); color: #e2e8f0; border-radius: 4px; font-size: 0.9rem; font-weight: 500; transition: all 0.2s ease;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'; this.style.background='rgba(15, 23, 42, 0.95)';" onblur="this.style.borderColor='rgba(59, 130, 246, 0.3)'; this.style.boxShadow='none'; this.style.background='rgba(15, 23, 42, 0.8)';" />
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                    <div>
                        <label style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px; font-size: 0.85rem; letter-spacing: 0.3px;">Stock</label>
                        <input type="number" name="variants[${index}][stock_quantity]" min="0" placeholder="0" style="width: 100%; padding: 10px 14px; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(59, 130, 246, 0.3); color: #e2e8f0; border-radius: 4px; font-size: 0.9rem; font-weight: 500; transition: all 0.2s ease;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'; this.style.background='rgba(15, 23, 42, 0.95)';" onblur="this.style.borderColor='rgba(59, 130, 246, 0.3)'; this.style.boxShadow='none'; this.style.background='rgba(15, 23, 42, 0.8)';" />
                    </div>
                    <div>
                        <label style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px; font-size: 0.85rem; letter-spacing: 0.3px;">Price Modifier (₱)</label>
                        <input type="number" name="variants[${index}][price_modifier]" step="0.01" placeholder="0.00" style="width: 100%; padding: 10px 14px; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(59, 130, 246, 0.3); color: #e2e8f0; border-radius: 4px; font-size: 0.9rem; font-weight: 500; transition: all 0.2s ease;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'; this.style.background='rgba(15, 23, 42, 0.95)';" onblur="this.style.borderColor='rgba(59, 130, 246, 0.3)'; this.style.boxShadow='none'; this.style.background='rgba(15, 23, 42, 0.8)';" />
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                    <div>
                        <label style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px; font-size: 0.85rem; letter-spacing: 0.3px;">Size</label>
                        <input type="text" name="variants[${index}][size]" placeholder="M, L, XL, 2XL..." style="width: 100%; padding: 10px 14px; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(59, 130, 246, 0.3); color: #e2e8f0; border-radius: 4px; font-size: 0.9rem; font-weight: 500; transition: all 0.2s ease;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'; this.style.background='rgba(15, 23, 42, 0.95)';" onblur="this.style.borderColor='rgba(59, 130, 246, 0.3)'; this.style.boxShadow='none'; this.style.background='rgba(15, 23, 42, 0.8)';" />
                    </div>
                    <div>
                        <label style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px; font-size: 0.85rem; letter-spacing: 0.3px;">Color</label>
                        <input type="text" name="variants[${index}][color]" placeholder="Red, Blue, Black..." style="width: 100%; padding: 10px 14px; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(59, 130, 246, 0.3); color: #e2e8f0; border-radius: 4px; font-size: 0.9rem; font-weight: 500; transition: all 0.2s ease;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'; this.style.background='rgba(15, 23, 42, 0.95)';" onblur="this.style.borderColor='rgba(59, 130, 246, 0.3)'; this.style.boxShadow='none'; this.style.background='rgba(15, 23, 42, 0.8)';" />
                    </div>
                </div>
                <div style="margin-bottom: 12px;">
                    <label style="display: block; color: #cbd5e1; font-weight: 600; margin-bottom: 8px; font-size: 0.85rem; letter-spacing: 0.3px;">Weight</label>
                    <input type="text" name="variants[${index}][weight]" placeholder="500g, 1kg, 2.5kg..." style="width: 100%; padding: 10px 14px; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(59, 130, 246, 0.3); color: #e2e8f0; border-radius: 4px; font-size: 0.9rem; font-weight: 500; transition: all 0.2s ease;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.15)'; this.style.background='rgba(15, 23, 42, 0.95)';" onblur="this.style.borderColor='rgba(59, 130, 246, 0.3)'; this.style.boxShadow='none'; this.style.background='rgba(15, 23, 42, 0.8)';" />
                </div>
                <button type="button" class="removeVariantBtn" style="width: 100%; padding: 8px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; display: none; margin-top: 10px; transition: all 0.2s ease; font-size: 0.85rem;" onmouseover="this.style.background='linear-gradient(135deg, #dc2626 0%, #b91c1c 100%)'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='linear-gradient(135deg, #ef4444 0%, #dc2626 100%)'; this.style.transform='translateY(0)';" onclick="this.parentElement.remove(); updateRemoveButtons();">
                    ✕ Remove Variant
                </button>
            `;
            return div;
        }

        function updateRemoveButtons() {
            document.querySelectorAll('.removeVariantBtn').forEach(btn => {
                btn.style.display = document.querySelectorAll('.removeVariantBtn').length > 1 ? 'block' : 'none';
            });
        }

        function addVariantToModal() {
            document.getElementById('modalVariantsContainer').appendChild(createVariantInput(modalVariantCount++));
            updateRemoveButtons();
        }

        function closeVariantModal() {
            document.getElementById('variantModal').classList.remove('active');
            document.getElementById('modalVariantsContainer').innerHTML = '';
            modalVariantCount = 0;
        }

        function saveModalVariants() {
            const variantDivs = document.querySelectorAll('#modalVariantsContainer > div');
            
            if (variantDivs.length === 0) {
                Swal.fire({
                    title: 'No Variants',
                    text: 'Please add at least one variant.',
                    icon: 'warning',
                    iconColor: '#f59e0b',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)'
                });
                return;
            }

            let hasData = false;
            const variantTableBody = document.getElementById('variantTableBody');
            
            // Process each variant form in modal
            variantDivs.forEach((variantForm, idx) => {
                const inputs = variantForm.querySelectorAll('input[type="text"], input[type="number"]');
                let variantHasData = false;
                const variantData = {};
                
                inputs.forEach(input => {
                    const value = input.value.trim();
                    if (value !== '') {
                        variantHasData = true;
                    }
                    const nameAttr = input.getAttribute('name');
                    if (nameAttr) {
                        const fieldName = nameAttr.match(/\[(\w+)\]$/)?.[1];
                        if (fieldName) {
                            variantData[fieldName] = value;
                        }
                    }
                });
                
                if (variantHasData) {
                    hasData = true;
                    
                    // Create a table row for the variant
                    const currentIndex = variantTableBody.querySelectorAll('tr').length;
                    const newRow = document.createElement('tr');
                    newRow.className = 'variant-row';
                    newRow.style.cssText = 'border-bottom: 1px solid rgba(71, 85, 105, 0.2); transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);';
                    newRow.onmouseover = function() { this.style.backgroundColor = 'rgba(59, 130, 246, 0.08)'; };
                    newRow.onmouseout = function() { this.style.backgroundColor = 'transparent'; };
                    
                    newRow.innerHTML = `
                        <td style="padding: 14px 16px;">
                            <input type="text" class="variantName form-input variant-input" name="variants[${currentIndex}][name]" value="${variantData.name || ''}" placeholder="Variant name" style="padding: 10px 12px; font-size: 0.95rem;" required />
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <input type="number" class="variantStock form-input variant-input" name="variants[${currentIndex}][stock_quantity]" value="${variantData.stock_quantity || '0'}" min="0" placeholder="0" style="padding: 10px 12px; font-size: 0.95rem; text-align: center; width: 100px; margin: 0 auto;" required />
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <input type="number" class="variantPriceModifier form-input variant-input" name="variants[${currentIndex}][price_modifier]" value="${variantData.price_modifier || '0.00'}" step="0.01" placeholder="0.00" style="padding: 10px 12px; font-size: 0.95rem; text-align: center; width: 120px; margin: 0 auto;" />
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <input type="text" class="variantSize form-input variant-input" name="variants[${currentIndex}][size]" value="${variantData.size || ''}" placeholder="Size" style="padding: 10px 12px; font-size: 0.95rem; text-align: center; width: 100px; margin: 0 auto;" />
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <input type="text" class="variantColor form-input variant-input" name="variants[${currentIndex}][color]" value="${variantData.color || ''}" placeholder="Color" style="padding: 10px 12px; font-size: 0.95rem; text-align: center; width: 120px; margin: 0 auto;" />
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <input type="text" class="variantWeight form-input variant-input" name="variants[${currentIndex}][weight]" value="${variantData.weight || ''}" placeholder="Weight" style="padding: 10px 12px; font-size: 0.95rem; text-align: center; width: 100px; margin: 0 auto;" />
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <button type="button" class="deleteVariantBtn btn-danger" onclick="deleteVariant(this, event);" style="padding: 8px 14px; font-size: 0.9rem; white-space: nowrap;">
                                🗑️
                            </button>
                        </td>
                    `;
                    
                    variantTableBody.appendChild(newRow);
                }
            });

            if (!hasData) {
                Swal.fire({
                    title: 'Empty Variants',
                    text: 'Please fill in at least one variant field.',
                    icon: 'warning',
                    iconColor: '#f59e0b',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)'
                });
                return;
            }

            closeVariantModal();
            updateVariantDisplay();
            updateVariantSummary();
            
            Swal.fire({
                title: 'Success!',
                text: 'Variants added to Manage Variants section.',
                icon: 'success',
                iconColor: '#22c55e',
                background: 'rgba(15, 23, 42, 0.98)',
                color: '#e2e8f0',
                confirmButtonColor: '#3b82f6',
                backdrop: 'rgba(0, 0, 0, 0.7)',
                timer: 2000
            });
        }

        function deleteVariant(btn, event) {
            event.preventDefault();
            const row = btn.closest('tr');
            
            Swal.fire({
                title: 'Delete Variant?',
                text: 'Are you sure you want to delete this variant?',
                icon: 'warning',
                iconColor: '#f59e0b',
                background: 'rgba(15, 23, 42, 0.98)',
                color: '#e2e8f0',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: 'rgba(148, 163, 184, 0.2)',
                confirmButtonText: 'Yes, Delete',
                backdrop: 'rgba(0, 0, 0, 0.7)'
            }).then(result => {
                if (result.isConfirmed) {
                    row.remove();
                    updateVariantIndexes();
                    updateVariantDisplay();
                    updateVariantSummary();
                }
            });
        }

        function updateVariantIndexes() {
            const rows = document.querySelectorAll('#variantTableBody tr');
            rows.forEach((row, index) => {
                row.querySelectorAll('input').forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
                    }
                });
            });
        }

        function updateVariantDisplay() {
            const variantCount = document.querySelectorAll('#variantTableBody tr').length;
            const emptyState = document.getElementById('emptyState');
            const tableContainer = document.getElementById('variantTableContainer');
            const summaryCard = document.getElementById('variantSummaryCard');
            
            if (variantCount > 0) {
                emptyState.style.display = 'none';
                tableContainer.style.display = 'block';
                summaryCard.style.display = 'block';
            } else {
                emptyState.style.display = 'block';
                tableContainer.style.display = 'none';
                summaryCard.style.display = 'none';
            }
        }

        function updateVariantSummary() {
            const rows = document.querySelectorAll('#variantTableBody tr');
            let totalStock = 0;
            let lowStockCount = 0;
            let totalPriceModifier = 0;
            let variantCount = rows.length;
            
            rows.forEach(row => {
                const stockInput = row.querySelector('.variantStock');
                const priceInput = row.querySelector('.variantPriceModifier');
                
                const stock = parseInt(stockInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
                
                totalStock += stock;
                if (stock <= 20) lowStockCount++;
                totalPriceModifier += price;
            });
            
            const avgPrice = variantCount > 0 ? (totalPriceModifier / variantCount) : 0;
            
            document.getElementById('totalStock').textContent = totalStock;
            document.getElementById('lowStockCount').textContent = lowStockCount;
            document.getElementById('avgPriceModifier').textContent = '₱' + avgPrice.toFixed(2);
        }

        // Close modal when clicking overlay
        document.getElementById('variantModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVariantModal();
            }
        });

        // Toggle variant modal
        document.getElementById('toggleNewVariantBtn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('variantModal').classList.add('active');
            if (document.getElementById('modalVariantsContainer').children.length === 0) {
                addVariantToModal();
            }
        });

        // Image upload (robust)
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        let removeImageBtn = document.getElementById('removeImageBtn');

        // Helper to create the remove button when necessary (safe to call)
        function ensureRemoveBtnCreate() {
            const imagePanel = imagePreview.parentElement;

            // If not present, create it
            if (!removeImageBtn) {
                removeImageBtn = document.createElement('button');
                removeImageBtn.id = 'removeImageBtn';
                removeImageBtn.type = 'button';
                removeImageBtn.className = 'btn-danger';
                removeImageBtn.style.cssText = 'width: 100%; padding: 14px; font-size: 1.1rem; font-weight: 700; margin-top: 28px; display: none;';
                removeImageBtn.innerHTML = '🗑️ Remove Image';
                imagePanel.appendChild(removeImageBtn);
            }

            // Attach click handler once (idempotent)
            if (!removeImageBtn.dataset.listenerAttached) {
                removeImageBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    // Clear file input and preview
                    try { imageInput.value = ''; } catch (err) { console.log('clear input err', err); }
                    const statusEl = document.getElementById('imageStatus');
                    if (statusEl) { statusEl.style.display = 'none'; }
                    imagePreview.innerHTML = `<div style="text-align: center;">
                        <div style="font-size: 64px; margin-bottom: 12px; animation: pulse 2s infinite;">📸</div>
                        <p style="color: #ffffff; font-weight: 700; margin: 0; font-size: 1.1rem;">Click to Upload</p>
                        <p style="color: #b0bcc4; font-size: 0.95rem; margin: 8px 0 0 0;">or drag & drop</p>
                    </div>`;

                    // hide the button until an image is selected again
                    this.style.display = 'none';

                    // If the page has a hidden input to signal backend to delete an existing image, set it
                    const removeExisting = document.querySelector('input[name="remove_existing_image"]');
                    if (removeExisting) removeExisting.value = '1';

                    // Log for debugging
                    appendImageDebug('remove clicked - cleared input/preview');
                });
                removeImageBtn.dataset.listenerAttached = '1';
            }

            return removeImageBtn;
        }

        // Debug logging helper + robust change handling
        function appendImageDebug(msg) {
            try {
                console.log(msg);
                const el = document.getElementById('imageDebug');
                if (!el) return;
                const time = new Date().toLocaleTimeString();
                el.textContent = `[${time}] ${msg}\n` + el.textContent;
            } catch (err) {
                console.log('appendImageDebug err', err);
            }
        }
        let pickerRequested = false;
        let imagePickerInProgress = false;
        imageInput.addEventListener('change', function(e) {
                console.log('create: imageInput.change files=', this.files);
                appendImageDebug('change: files=' + (this.files && this.files.length ? Array.from(this.files).map(f => f.name).join(',') : 'none'));
            const file = this.files && this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    console.log('create: reader.onload file=', file && file.name);
                    appendImageDebug('reader.onload: ' + (file && file.name));
                    imagePreview.innerHTML = `<img src="${event.target.result}" style="width: 100%; height: 100%; object-fit: cover;" />`;
                    const btn = ensureRemoveBtnCreate();
                    if (btn) btn.style.display = 'block';
                    // show a short UI status so users without console see that a file was selected
                    const statusEl = document.getElementById('imageStatus');
                    if (statusEl) {
                        statusEl.textContent = 'Selected: ' + (file.name || 'image');
                        statusEl.style.display = 'block';
                        setTimeout(() => { statusEl.style.display = 'none'; }, 2000);
                    }
                    // clear picker state so preview click can open again
                    pickerRequested = false;
                    imageInput.dataset.opening = '';
                    imagePickerInProgress = false;
                };
                reader.readAsDataURL(file);
            } else {
                console.log('create: no file selected');
                appendImageDebug('no file selected');
            }
        });

        // If there's already a remove button rendered in DOM for some reason, attach safe handler
        const existingRemoveBtn = document.getElementById('removeImageBtn');
        if (existingRemoveBtn && !existingRemoveBtn.dataset.listenerAttached) {
            existingRemoveBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                try { imageInput.value = ''; } catch (err) { console.log('clear input err', err); }
                const statusEl = document.getElementById('imageStatus');
                if (statusEl) { statusEl.style.display = 'none'; }
                imagePreview.innerHTML = `<div style="text-align: center;">
                    <div style="font-size: 64px; margin-bottom: 12px; animation: pulse 2s infinite;">📸</div>
                    <p style="color: #ffffff; font-weight: 700; margin: 0; font-size: 1.1rem;">Click to Upload</p>
                    <p style="color: #b0bcc4; font-size: 0.95rem; margin: 8px 0 0 0;">or drag & drop</p>
                </div>`;
                this.style.display = 'none';
                this.dataset.listenerAttached = '1';
                appendImageDebug('existing remove clicked - cleared input/preview');
            });
        }

        // Make click/open handling robust for browsers (avoid double re-open)
        // Clear the input on pointerdown so selecting the same file still fires change
        imagePreview.addEventListener('pointerdown', function(e) {
            if (e.target.tagName !== 'IMG' && !e.target.closest('#removeImageBtn')) {
                imageInput.value = '';
            }
        });

        // Use native label behavior to open the file picker (avoid double-open). pointerdown clears selection.

        // Log file presence just before form submit to help debugging
        document.getElementById('saveBtn').addEventListener('click', function(ev) {
            console.log('create: before submit files=', imageInput.files && imageInput.files.length);
            appendImageDebug('before submit files=' + (imageInput.files && imageInput.files.length));
        });

        // When the window regains focus after the file picker, clear opening state
        window.addEventListener('focus', function() {
            if (imageInput && imageInput.dataset && imageInput.dataset.opening) {
                console.log('create: focus detected - clearing opening flag');
                appendImageDebug('focus detected - clearing opening flag');
                imageInput.dataset.opening = '';
            }
            // clear progress flag on focus to avoid stuck state
            imagePickerInProgress = false;
        });

        // Check for success/error on page load
        window.addEventListener('load', function() {
            <?php if(session('success')): ?>
                Swal.fire({
                    title: 'Success!',
                    text: '<?php echo e(session("success")); ?>',
                    icon: 'success',
                    iconColor: '#22c55e',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)',
                    didOpen: (modal) => {
                        setTimeout(() => {
                            window.location.href = '<?php echo e(route("admin.inventory.index")); ?>';
                        }, 2500);
                    }
                });
            <?php elseif($errors->any()): ?>
                Swal.fire({
                    title: 'Creation Failed',
                    html: '<ul style="text-align: left; display: inline-block; margin: 0; padding-left: 20px;"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li style="margin: 6px 0; color: #fca5a5;">❌ <?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>',
                    icon: 'error',
                    iconColor: '#ef4444',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)'
                });
            <?php endif; ?>
        });

        // Save button
        document.getElementById('saveBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Check if variants exist
            const variantRows = document.querySelectorAll('#variantTableBody tr');
            
            if (variantRows.length === 0) {
                Swal.fire({
                    title: 'No Variants!',
                    text: 'Please add at least one variant before creating the product.',
                    icon: 'warning',
                    iconColor: '#f59e0b',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)'
                });
                return;
            }
            
            Swal.fire({
                title: 'Create Product?',
                text: 'Are you sure you want to create this product with ' + variantRows.length + ' variant(s)?',
                icon: 'question',
                iconColor: '#3b82f6',
                background: 'rgba(15, 23, 42, 0.98)',
                color: '#e2e8f0',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, Create',
                backdrop: 'rgba(0, 0, 0, 0.7)'
            }).then(result => {
                if (result.isConfirmed) {
                    // Show loading alert
                    Swal.fire({
                        title: 'Creating Product...',
                        html: 'Please wait while we create your product.',
                        icon: 'info',
                        iconColor: '#3b82f6',
                        background: 'rgba(15, 23, 42, 0.98)',
                        color: '#e2e8f0',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        backdrop: 'rgba(0, 0, 0, 0.7)',
                        didOpen: (modal) => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit form
                    console.log('create: before submit files=', imageInput.files && imageInput.files.length);
                    document.getElementById('productForm').submit();
                }
            });
        });
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\admin\inventory\create.blade.php ENDPATH**/ ?>