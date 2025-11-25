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
    <?php $__env->startSection('page-title', 'Inventory Management'); ?>

    <!-- Header Section -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2" style="color: #ffffff; letter-spacing: 0.5px;">📦 Products Inventory</h2>
            <p class="text-sm" style="color: #b0bcc4;">Manage your inventory and product information</p>
        </div>
        <div class="flex gap-3">
            <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['href' => ''.e(route('admin.inventory.create')).'','variant' => 'primary','size' => 'lg','style' => 'background: linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%); border: 2px solid #0f6fdd; border-radius: 12px; padding: 12px 24px; font-weight: 600; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3); transition: all 0.3s ease; display: flex; align-items: center; gap: 6px;','onmouseover' => 'this.style.background=\'linear-gradient(135deg, #1a7fff 0%, #2a4a62 100%)\'; this.style.boxShadow=\'0 8px 20px rgba(15, 111, 221, 0.5)\';','onmouseout' => 'this.style.background=\'linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%)\'; this.style.boxShadow=\'0 4px 12px rgba(15, 111, 221, 0.3)\';']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('admin.inventory.create')).'','variant' => 'primary','size' => 'lg','style' => 'background: linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%); border: 2px solid #0f6fdd; border-radius: 12px; padding: 12px 24px; font-weight: 600; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3); transition: all 0.3s ease; display: flex; align-items: center; gap: 6px;','onmouseover' => 'this.style.background=\'linear-gradient(135deg, #1a7fff 0%, #2a4a62 100%)\'; this.style.boxShadow=\'0 8px 20px rgba(15, 111, 221, 0.5)\';','onmouseout' => 'this.style.background=\'linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%)\'; this.style.boxShadow=\'0 4px 12px rgba(15, 111, 221, 0.3)\';']); ?>
                <span style="font-size: 20px; font-weight: 700;">+</span>
                <span>Add Product</span>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
        </div>
    </div>

    <!-- Statistics Dashboard -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 32px;">
        <!-- Total Products -->
        <div style="background: linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%); border: 2px solid #00d9ff; border-radius: 16px; padding: 24px; position: relative; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(15, 111, 221, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 80px; opacity: 0.1;">📦</div>
            <p style="color: #b0bcc4; font-size: 0.9rem; margin: 0 0 8px 0; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Total Products</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <span style="color: #ffffff; font-weight: 700; font-size: 2.5rem;"><?php echo e($stats['total_products']); ?></span>
                <span style="color: #00d9ff; font-size: 0.9rem; font-weight: 600;">items</span>
            </div>
            <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <span style="color: #4caf50; font-size: 0.85rem; font-weight: 600;">🟢 <?php echo e($stats['active_products']); ?> Active</span>
                <span style="color: #b0bcc4; margin: 0 8px;">•</span>
                <span style="color: #ff6b6b; font-size: 0.85rem; font-weight: 600;">🔴 <?php echo e($stats['inactive_products']); ?> Inactive</span>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div style="background: linear-gradient(135deg, #ff9500 0%, #cc7700 100%); border: 2px solid #ffd700; border-radius: 16px; padding: 24px; position: relative; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(255, 149, 0, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 80px; opacity: 0.15;">⚠️</div>
            <p style="color: rgba(255, 255, 255, 0.9); font-size: 0.9rem; margin: 0 0 8px 0; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Low Stock Alerts</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <span style="color: #ffffff; font-weight: 700; font-size: 2.5rem;"><?php echo e($stats['low_stock_count']); ?></span>
                <span style="color: #ffd700; font-size: 0.9rem; font-weight: 600;">warnings</span>
            </div>
            <?php if($stats['low_stock_count'] > 0): ?>
                <p style="color: rgba(255, 255, 255, 0.85); font-size: 0.85rem; margin: 12px 0 0 0;">Restock items below threshold</p>
            <?php else: ?>
                <p style="color: rgba(255, 255, 255, 0.85); font-size: 0.85rem; margin: 12px 0 0 0;">✓ All items well stocked</p>
            <?php endif; ?>
        </div>

        <!-- Total Inventory Value -->
        <div style="background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%); border: 2px solid #66bb6a; border-radius: 16px; padding: 24px; position: relative; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(76, 175, 80, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 80px; opacity: 0.15;">💰</div>
            <p style="color: rgba(255, 255, 255, 0.9); font-size: 0.9rem; margin: 0 0 8px 0; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Inventory Value</p>
            <div style="display: flex; align-items: baseline; gap: 4px;">
                <span style="color: #ffffff; font-weight: 700; font-size: 2rem;">₱<?php echo e(number_format($stats['total_inventory_value'], 2)); ?></span>
            </div>
            <p style="color: rgba(255, 255, 255, 0.85); font-size: 0.85rem; margin: 12px 0 0 0;">Total stock value at base price</p>
        </div>

        <!-- Total Stock Units -->
        <div style="background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%); border: 2px solid #ba68c8; border-radius: 16px; padding: 24px; position: relative; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(156, 39, 176, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 80px; opacity: 0.15;">📊</div>
            <p style="color: rgba(255, 255, 255, 0.9); font-size: 0.9rem; margin: 0 0 8px 0; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Total Stock</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <span style="color: #ffffff; font-weight: 700; font-size: 2.5rem;"><?php echo e(number_format($stats['total_stock'])); ?></span>
                <span style="color: #ba68c8; font-size: 0.9rem; font-weight: 600;">units</span>
            </div>
            <p style="color: rgba(255, 255, 255, 0.85); font-size: 0.85rem; margin: 12px 0 0 0;">Across all products & variants</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="rounded-xl shadow-lg p-6 mb-6" style="background: linear-gradient(135deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #2a3f5f; border-radius: 16px;">
        <form method="GET" class="space-y-4">
            <!-- First Row: Search & Status -->
            <div class="flex gap-4 flex-wrap items-end">
                <div class="flex-1 min-w-64">
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">🔍 Search Product</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="<?php echo e(request('search', '')); ?>"
                        placeholder="Search by product name..." 
                        class="w-full px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300"
                        style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff;" 
                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" 
                        onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';" 
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Status</label>
                    <select name="status" class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300" style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; min-width: 150px;" onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';">
                        <option value="all" style="background-color: #0f1419; color: #ffffff;" <?php echo e(request('status', 'all') === 'all' ? 'selected' : ''); ?>>All Status</option>
                        <option value="active" style="background-color: #0f1419; color: #ffffff;" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>🟢 Active</option>
                        <option value="inactive" style="background-color: #0f1419; color: #ffffff;" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>🔴 Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Stock Level</label>
                    <select name="stock_level" class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300" style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; min-width: 150px;" onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';">
                        <option value="" style="background-color: #0f1419; color: #ffffff;" <?php echo e(!request('stock_level') ? 'selected' : ''); ?>>All Levels</option>
                        <option value="low" style="background-color: #0f1419; color: #ffffff;" <?php echo e(request('stock_level') === 'low' ? 'selected' : ''); ?>>⚠️ Low Stock</option>
                        <option value="out" style="background-color: #0f1419; color: #ffffff;" <?php echo e(request('stock_level') === 'out' ? 'selected' : ''); ?>>❌ Out of Stock</option>
                        <option value="in_stock" style="background-color: #0f1419; color: #ffffff;" <?php echo e(request('stock_level') === 'in_stock' ? 'selected' : ''); ?>>✅ In Stock</option>
                    </select>
                </div>
            </div>

            <!-- Second Row: Price Range & Sort -->
            <div class="flex gap-4 flex-wrap items-end">
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Min Price (₱)</label>
                    <input 
                        type="number" 
                        name="min_price" 
                        value="<?php echo e(request('min_price', '')); ?>"
                        placeholder="0.00" 
                        step="0.01"
                        class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300"
                        style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; width: 140px;" 
                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" 
                        onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';" 
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Max Price (₱)</label>
                    <input 
                        type="number" 
                        name="max_price" 
                        value="<?php echo e(request('max_price', '')); ?>"
                        placeholder="9999.99" 
                        step="0.01"
                        class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300"
                        style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; width: 140px;" 
                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" 
                        onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';" 
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Sort By</label>
                    <select name="sort_by" class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300" style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; min-width: 150px;" onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';">
                        <option value="name" <?php echo e(request('sort_by', 'name') === 'name' ? 'selected' : ''); ?>>Name</option>
                        <option value="price" <?php echo e(request('sort_by') === 'price' ? 'selected' : ''); ?>>Price</option>
                        <option value="stock" <?php echo e(request('sort_by') === 'stock' ? 'selected' : ''); ?>>Stock</option>
                        <option value="created_at" <?php echo e(request('sort_by') === 'created_at' ? 'selected' : ''); ?>>Date Added</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Order</label>
                    <select name="sort_order" class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300" style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; min-width: 120px;" onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';">
                        <option value="asc" <?php echo e(request('sort_order', 'asc') === 'asc' ? 'selected' : ''); ?>>↑ Ascending</option>
                        <option value="desc" <?php echo e(request('sort_order') === 'desc' ? 'selected' : ''); ?>>↓ Descending</option>
                    </select>
                </div>
                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'submit','variant' => 'primary','style' => 'background: linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%); border: 2px solid #0f6fdd; border-radius: 10px; padding: 12px 24px; font-weight: 600; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3); transition: all 0.3s ease;','onmouseover' => 'this.style.background=\'linear-gradient(135deg, #1a7fff 0%, #2a4a62 100%)\'; this.style.boxShadow=\'0 8px 16px rgba(15, 111, 221, 0.4)\';','onmouseout' => 'this.style.background=\'linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%)\'; this.style.boxShadow=\'0 4px 12px rgba(15, 111, 221, 0.3)\';']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'primary','style' => 'background: linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%); border: 2px solid #0f6fdd; border-radius: 10px; padding: 12px 24px; font-weight: 600; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3); transition: all 0.3s ease;','onmouseover' => 'this.style.background=\'linear-gradient(135deg, #1a7fff 0%, #2a4a62 100%)\'; this.style.boxShadow=\'0 8px 16px rgba(15, 111, 221, 0.4)\';','onmouseout' => 'this.style.background=\'linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%)\'; this.style.boxShadow=\'0 4px 12px rgba(15, 111, 221, 0.3)\';']); ?>
                    🔍 Search
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                <?php if(request('search') || request('status') !== 'all' || request('stock_level') || request('min_price') || request('max_price') || (request('sort_by') && request('sort_by') !== 'name')): ?>
                    <a href="<?php echo e(route('admin.inventory.index')); ?>" class="px-5 py-3 rounded-lg text-white font-semibold transition-all duration-300 flex items-center justify-center" style="background: linear-gradient(135deg, #666 0%, #444 100%); border: 2px solid #555; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); text-align: center;" onmouseover="this.style.background='linear-gradient(135deg, #777 0%, #555 100%)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.4)';" onmouseout="this.style.background='linear-gradient(135deg, #666 0%, #444 100%)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.3)';">
                        ✕ Clear Filters
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="rounded-xl shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #2a3f5f; border-radius: 16px;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="transition-colors" style="border-bottom: 2px solid #2a3f5f; background: linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%);">
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #ffffff; letter-spacing: 0.5px; width: 50px;"></th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #ffffff; letter-spacing: 0.5px;">Product</th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #ffffff; letter-spacing: 0.5px;">Price</th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #ffffff; letter-spacing: 0.5px;">Variants</th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #ffffff; letter-spacing: 0.5px;">Total Stock</th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #ffffff; letter-spacing: 0.5px;">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-bold uppercase" style="color: #ffffff; letter-spacing: 0.5px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="transition-all duration-300" style="border-bottom: 2px solid #2a3f5f;" onmouseover="this.style.backgroundColor='rgba(15, 111, 221, 0.1)'; this.style.boxShadow='inset 0 0 10px rgba(15, 111, 221, 0.1)';" onmouseout="this.style.backgroundColor='transparent'; this.style.boxShadow='';">
                            <!-- Product Image Thumbnail -->
                            <td class="px-6 py-4">
                                <div style="width: 50px; height: 50px; border-radius: 8px; overflow: hidden; border: 2px solid #2a3f5f; background: #0f1419;">
                                    <?php if($product->image_path): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->image_path)); ?>" alt="<?php echo e($product->name); ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                                    <?php else: ?>
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 24px;">📦</div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold" style="color: #ffffff; font-size: 1.05rem;"><?php echo e($product->name); ?></p>
                            </td>
                            <td class="px-6 py-4 font-bold" style="color: #00d9ff; font-size: 1.1rem;">₱<?php echo e(number_format($product->base_price, 2)); ?></td>
                            <td class="px-6 py-4">
                                <?php if($product->variants->count() > 0): ?>
                                    <div style="display: flex; flex-wrap: wrap; gap: 6px; max-width: 350px;">
                                        <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div style="background: linear-gradient(135deg, #0f3a5f 0%, #1a2535 100%); border: 1.5px solid <?php echo e($variant->stock_quantity <= 20 ? '#ff9500' : '#00d9ff'); ?>; border-radius: 8px; padding: 6px 12px; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                                                <span style="color: #00d9ff; font-weight: 600; font-size: 0.85rem;"><?php echo e($variant->name); ?></span>
                                                <span style="background: rgba(0, 217, 255, 0.15); color: #ffffff; padding: 2px 6px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;"><?php echo e($variant->stock_quantity); ?></span>
                                                <?php if($variant->price_modifier > 0): ?>
                                                    <span style="color: #4caf50; font-size: 0.75rem; font-weight: 600;">+₱<?php echo e(number_format($variant->price_modifier, 2)); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <span style="color: #b0bcc4; font-style: italic; font-size: 0.9rem;">No variants</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <?php
                                        // Get total stock from variants if they exist, otherwise fall back to current_stock
                                        $variantStock = (int) $product->variants()->sum('stock_quantity');
                                        $totalStock = $variantStock > 0 ? $variantStock : (int) $product->current_stock;
                                        
                                        // Determine color based on stock level
                                        $stockColor = '#ff6b6b'; // out of stock
                                        if ($totalStock > 20) {
                                            $stockColor = '#4caf50'; // plenty
                                        } elseif ($totalStock > 0) {
                                            $stockColor = '#ff9500'; // low stock
                                        }
                                        
                                        $percentage = $totalStock > 0 ? min(($totalStock / 100) * 100, 100) : 0;
                                    ?>
                                    <span class="font-bold" style="color: <?php echo e($stockColor); ?>; font-size: 1.1rem;"><?php echo e($totalStock); ?></span>
                                    <div class="w-20 rounded-full h-2" style="background-color: #0f3a5f; border: 1px solid #2a3f5f;">
                                        <div 
                                            class="h-2 rounded-full transition-all duration-300" 
                                            style="background-color: <?php echo e($stockColor); ?>; width: <?php echo e($percentage); ?>%"
                                        ></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['status' => 'success','style' => 'background: '.e($product->status === 'active' ? 'linear-gradient(135deg, #4caf50 0%, #2e7d32 100%)' : 'linear-gradient(135deg, #ff6b6b 0%, #cc0000 100%)').'; color: #ffffff; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 0.9rem;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => 'success','style' => 'background: '.e($product->status === 'active' ? 'linear-gradient(135deg, #4caf50 0%, #2e7d32 100%)' : 'linear-gradient(135deg, #ff6b6b 0%, #cc0000 100%)').'; color: #ffffff; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 0.9rem;']); ?>
                                    <?php echo e($product->status === 'active' ? 'Active' : 'Inactive'); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <!-- Edit Button -->
                                    <a href="<?php echo e(route('admin.inventory.edit', $product)); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all duration-300" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%); color: white; border: 2px solid #0f6fdd; border-radius: 10px; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.2);" onmouseover="this.style.background='linear-gradient(135deg, #1a7fff 0%, #2a4a62 100%)'; this.style.boxShadow='0 6px 16px rgba(15, 111, 221, 0.4)';" onmouseout="this.style.background='linear-gradient(135deg, #0f6fdd 0%, #1a3a52 100%)'; this.style.boxShadow='0 4px 12px rgba(15, 111, 221, 0.2)';">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <button type="button" onclick="deleteProduct('<?php echo e($product->slug); ?>')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all duration-300" style="background: linear-gradient(135deg, #ff6b6b 0%, #cc0000 100%); color: white; border: 2px solid #ff6b6b; border-radius: 10px; box-shadow: 0 4px 12px rgba(255, 107, 107, 0.2);" onmouseover="this.style.background='linear-gradient(135deg, #ff7f7f 0%, #dd1111 100%)'; this.style.boxShadow='0 6px 16px rgba(255, 107, 107, 0.4)';" onmouseout="this.style.background='linear-gradient(135deg, #ff6b6b 0%, #cc0000 100%)'; this.style.boxShadow='0 4px 12px rgba(255, 107, 107, 0.2)';">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <span style="color: #b0bcc4;">No products created yet.</span>
                                <a href="<?php echo e(route('admin.inventory.create')); ?>" style="color: #0f6fdd; font-weight: bold;" onmouseover="this.style.color='#1a7fff'" onmouseout="this.style.color='#0f6fdd'">Create one →</a>
                            </td>
                        </tr>
                    <?php endif; ?>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if($products->hasPages()): ?>
        <div class="mt-8">
            <?php echo e($products->links()); ?>

        </div>
    <?php endif; ?>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<script>
    function deleteProduct(productId) {
        Swal.fire({
            title: 'Delete Product?',
            text: 'This action cannot be undone. The product and all its variants will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff6b6b',
            cancelButtonColor: '#2a3f5f',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            background: '#0f1419',
            color: '#ffffff',
            iconColor: '#ff9500',
            didOpen: () => {
                document.querySelector('.swal2-title').style.color = '#ffffff';
                document.querySelector('.swal2-popup').style.border = '3px solid #daa520';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait while the product is being deleted.',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                        document.querySelector('.swal2-title').style.color = '#ffd700';
                        document.querySelector('.swal2-popup').style.border = '3px solid #daa520';
                    },
                    background: '#1a0f0f',
                    color: '#ffd700',
                    iconColor: '#daa520'
                });
                
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                
                // Log the request for debugging
                console.log('Delete request - Product ID:', productId);
                console.log('URL:', `/admin/inventory/${productId}`);
                console.log('CSRF Token:', csrfToken ? 'Present' : 'Missing');
                
                // Send DELETE request via AJAX
                fetch(`/admin/inventory/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Delete response:', data);
                    Swal.fire({
                        title: 'Delete Successful!',
                        text: data.message || 'The product has been deleted successfully.',
                        icon: 'success',
                        confirmButtonColor: '#4caf50',
                        background: '#0f1419',
                        color: '#ffffff',
                        iconColor: '#4caf50',
                        didOpen: () => {
                            document.querySelector('.swal2-title').style.color = '#4caf50';
                            document.querySelector('.swal2-popup').style.border = '3px solid #0f6fdd';
                        }
                    }).then(() => {
                        // Reload the page after alert closes
                        window.location.href = '<?php echo e(route("admin.inventory.index")); ?>';
                    });
                })
                .catch(error => {
                    console.error('Delete error:', error);
                    Swal.fire({
                        title: 'Delete Failed!',
                        text: error.message || 'An error occurred while deleting the product. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#ff6b6b',
                        background: '#0f1419',
                        color: '#ffffff',
                        iconColor: '#ff6b6b',
                        didOpen: () => {
                            document.querySelector('.swal2-title').style.color = '#ff6b6b';
                            document.querySelector('.swal2-popup').style.border = '3px solid #0f6fdd';
                        }
                    });
                });
            }
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\admin\inventory\index.blade.php ENDPATH**/ ?>