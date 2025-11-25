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
    <?php $__env->startSection('page-title', 'Admin Settings'); ?>

    <!-- Page Header -->
    <div class="mb-12">
        <div class="flex items-center gap-4 mb-4">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); box-shadow: 0 8px 32px rgba(139, 0, 0, 0.3);">
                <svg class="w-7 h-7" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-4xl font-bold" style="color: #ffffff; letter-spacing: 0.5px;">Admin Settings</h1>
                <p class="text-sm mt-1" style="color: #b0bcc4;">Manage application settings, system configuration, and preferences</p>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 rounded-lg" style="background-color: #4caf50; color: white; border: 2px solid #45a049; display: flex; align-items: center; gap: 12px;">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Settings Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- General Settings Card -->
        <div class="lg:col-span-2 rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
            <!-- Card Top Border -->
            <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

            <div class="p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold" style="color: #ffffff;">General Settings</h2>
                        <p class="text-xs mt-1" style="color: #b0bcc4;">System information and core configuration</p>
                    </div>
                </div>

                <form class="space-y-6" id="settingsForm" method="POST" action="<?php echo e(route('admin.settings.update')); ?>">
                    <?php echo csrf_field(); ?>

                    <!-- System Name -->
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="#b0bcc4" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.5a2 2 0 00-1 .268V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4z"></path>
                            </svg>
                            <label class="text-sm font-bold" style="color: #ffffff;">Site Name</label>
                        </div>
                        <input 
                            type="text" 
                            name="site_name"
                            id="site_name"
                            value="<?php echo e($siteName); ?>"
                            class="w-full rounded-lg px-4 py-3 text-base font-medium transition-all"
                            style="border: 2px solid #b0bcc4; background-color: #0f0707; color: #ffffff; caret-color: #b0bcc4;"
                            onfocus="this.style.borderColor='#ffffff'; this.style.boxShadow='0 0 0 3px rgba(218, 165, 32, 0.1)'"
                            onblur="this.style.borderColor='#b0bcc4'; this.style.boxShadow=''"
                        />
                        <p class="text-xs mt-2" style="color: #999;">Change your platform's main name</p>
                        <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-xs mt-2" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Platform Status -->
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="#b0bcc4" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            <label class="text-sm font-bold" style="color: #ffffff;">Platform Status</label>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <div style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 8px; background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(76, 175, 80, 0.1)); border: 2px solid #4caf50;">
                                <div style="width: 10px; height: 10px; border-radius: 50%; background-color: #4caf50; animation: pulse 2s infinite;"></div>
                                <span style="color: #4caf50; font-weight: 600;">Active & Running</span>
                            </div>
                        </div>
                        <p class="text-xs mt-2" style="color: #999;">The platform is fully operational and ready to use</p>
                    </div>

                    <!-- Divider -->
                    <div style="border-top: 2px solid #444; padding-top: 24px;"></div>

                    <!-- Save Button -->
                    <div style="display: flex; gap: 12px; justify-content: flex-end;">
                        <button 
                            type="button" 
                            class="px-6 py-3 rounded-lg font-bold transition-all duration-300"
                            style="background-color: #333; color: #b0bcc4; border: 2px solid #555;"
                            onmouseover="this.style.backgroundColor='#444'; this.style.borderColor='#b0bcc4'"
                            onmouseout="this.style.backgroundColor='#333'; this.style.borderColor='#555'"
                            onclick="resetForm()"
                        >
                            Reset
                        </button>
                        <button 
                            type="submit" 
                            class="px-6 py-3 rounded-lg font-bold transition-all duration-300 flex items-center gap-2"
                            id="saveBtn"
                            style="background: linear-gradient(135deg, #4caf50 0%, #45a049 100%); color: white; border: 2px solid #45a049; box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);"
                            onmouseover="this.style.boxShadow='0 8px 20px rgba(76, 175, 80, 0.4)'; this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.boxShadow='0 4px 12px rgba(76, 175, 80, 0.3)'; this.style.transform='translateY(0)'"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Quick Stats Card -->
        <div class="rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
            <!-- Card Top Border -->
            <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

            <div class="p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold" style="color: #ffffff;">Quick Stats</h2>
                </div>

                <div class="space-y-4">
                    <!-- Stat Item 1 -->
                    <div style="padding: 12px; border-radius: 10px; background-color: #0f0707; border: 2px solid #444; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #b0bcc4; font-size: 0.875rem; font-weight: 500;">Total Users</span>
                        <span style="color: #ffffff; font-size: 1.25rem; font-weight: bold;"><?php echo e($stats['total_users']); ?></span>
                    </div>

                    <!-- Stat Item 2 -->
                    <div style="padding: 12px; border-radius: 10px; background-color: #0f0707; border: 2px solid #444; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #b0bcc4; font-size: 0.875rem; font-weight: 500;">Total Orders</span>
                        <span style="color: #ffffff; font-size: 1.25rem; font-weight: bold;"><?php echo e($stats['total_orders']); ?></span>
                    </div>

                    <!-- Stat Item 3 -->
                    <div style="padding: 12px; border-radius: 10px; background-color: #0f0707; border: 2px solid #444; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #b0bcc4; font-size: 0.875rem; font-weight: 500;">Active Inventory</span>
                        <span style="color: #ffffff; font-size: 1.25rem; font-weight: bold;"><?php echo e($stats['active_inventory']); ?></span>
                    </div>

                    <!-- Stat Item 4 -->
                    <div style="padding: 12px; border-radius: 10px; background-color: #0f0707; border: 2px solid #444; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #b0bcc4; font-size: 0.875rem; font-weight: 500;">System Uptime</span>
                        <span style="color: #4caf50; font-size: 1.25rem; font-weight: bold;"><?php echo e($stats['system_uptime']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Information Section -->
    <div class="rounded-2xl shadow-2xl overflow-hidden mb-8" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
        <!-- Card Top Border -->
        <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

        <div class="p-8">
            <div class="flex items-center gap-3 mb-8">
                <div style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold" style="color: #ffffff;">System Information</h2>
                    <p class="text-xs mt-1" style="color: #b0bcc4;">Technical details and system specifications</p>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Laravel Version -->
                <div style="padding: 16px; border-radius: 12px; background: linear-gradient(135deg, rgba(218, 165, 32, 0.05), rgba(139, 0, 0, 0.05)); border: 2px solid #444; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#b0bcc4'; this.style.background='linear-gradient(135deg, rgba(218, 165, 32, 0.1), rgba(139, 0, 0, 0.1))'" onmouseout="this.style.borderColor='#444'; this.style.background='linear-gradient(135deg, rgba(218, 165, 32, 0.05), rgba(139, 0, 0, 0.05))'">
                    <p class="text-xs font-bold mb-2" style="color: #b0bcc4;">Laravel Version</p>
                    <p class="text-lg font-bold" style="color: #ffffff;">11.46.1</p>
                    <p class="text-xs mt-2" style="color: #999;">Latest stable release</p>
                </div>

                <!-- PHP Version -->
                <div style="padding: 16px; border-radius: 12px; background: linear-gradient(135deg, rgba(218, 165, 32, 0.05), rgba(139, 0, 0, 0.05)); border: 2px solid #444; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#b0bcc4'; this.style.background='linear-gradient(135deg, rgba(218, 165, 32, 0.1), rgba(139, 0, 0, 0.1))'" onmouseout="this.style.borderColor='#444'; this.style.background='linear-gradient(135deg, rgba(218, 165, 32, 0.05), rgba(139, 0, 0, 0.05))'">
                    <p class="text-xs font-bold mb-2" style="color: #b0bcc4;">PHP Version</p>
                    <p class="text-lg font-bold" style="color: #ffffff;"><?php echo e(phpversion()); ?></p>
                    <p class="text-xs mt-2" style="color: #999;">Current runtime</p>
                </div>

                <!-- Database -->
                <div style="padding: 16px; border-radius: 12px; background: linear-gradient(135deg, rgba(218, 165, 32, 0.05), rgba(139, 0, 0, 0.05)); border: 2px solid #444; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#b0bcc4'; this.style.background='linear-gradient(135deg, rgba(218, 165, 32, 0.1), rgba(139, 0, 0, 0.1))'" onmouseout="this.style.borderColor='#444'; this.style.background='linear-gradient(135deg, rgba(218, 165, 32, 0.05), rgba(139, 0, 0, 0.05))'">
                    <p class="text-xs font-bold mb-2" style="color: #b0bcc4;">Database</p>
                    <p class="text-lg font-bold" style="color: #ffffff;">SQLite</p>
                    <p class="text-xs mt-2" style="color: #999;">Data storage</p>
                </div>

                <!-- Environment -->
                <div style="padding: 16px; border-radius: 12px; background: linear-gradient(135deg, rgba(76, 175, 80, 0.05), rgba(76, 175, 80, 0.05)); border: 2px solid #4caf50; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#54d960'; this.style.background='linear-gradient(135deg, rgba(76, 175, 80, 0.15), rgba(76, 175, 80, 0.15))'" onmouseout="this.style.borderColor='#4caf50'; this.style.background='linear-gradient(135deg, rgba(76, 175, 80, 0.05), rgba(76, 175, 80, 0.05))'">
                    <p class="text-xs font-bold mb-2" style="color: #4caf50;">Environment</p>
                    <p class="text-lg font-bold" style="color: #54d960;">Production</p>
                    <p class="text-xs mt-2" style="color: #999;">Running mode</p>
                </div>
            </div>
        </div>
    </div>

    <!-- User Management Card -->
    <div class="rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
        <!-- Card Top Border -->
        <div style="height: 3px; background: linear-gradient(90deg, #b0bcc4 0%, #0f6fdd 50%, #b0bcc4 100%);"></div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Left Content -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <h2 class="text-2xl font-bold" style="color: #ffffff;">User Management</h2>
                    </div>
                    <p class="mb-4" style="color: #b0bcc4; line-height: 1.6;">Manage administrator accounts, assign roles and permissions, configure user access levels, and monitor user activity across the system.</p>
                    <p class="text-sm" style="color: #999;">Access the complete user management dashboard with advanced filtering and search capabilities.</p>
                </div>

                <!-- Right Button -->
                <div style="display: flex; justify-content: flex-start; md:justify-content: flex-end; align-items: center;">
                    <a 
                        href="<?php echo e(route('admin.users.index')); ?>" 
                        class="px-8 py-4 rounded-xl font-bold text-base transition-all duration-300 flex items-center gap-3"
                        style="background: linear-gradient(135deg, #ff9500 0%, #ff8500 100%); color: white; border: 3px solid #ff8500; box-shadow: 0 6px 20px rgba(255, 149, 0, 0.3);"
                        onmouseover="this.style.boxShadow='0 12px 32px rgba(255, 149, 0, 0.4)'; this.style.transform='translateY(-3px)'; this.style.background='linear-gradient(135deg, #ffb000 0%, #ff9500 100%)'"
                        onmouseout="this.style.boxShadow='0 6px 20px rgba(255, 149, 0, 0.3)'; this.style.transform='translateY(0)'; this.style.background='linear-gradient(135deg, #ff9500 0%, #ff8500 100%)'"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        Manage Users
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        // Handle form submission with AJAX
        document.getElementById('settingsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const csrfToken = document.querySelector('input[name="_token"]').value;
            
            fetch('<?php echo e(route("admin.settings.update")); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    // Show success alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Site name changed successfully!',
                        icon: 'success',
                        confirmButtonColor: '#4caf50',
                        background: '#0f1419',
                        color: '#ffffff',
                        titleColor: '#4caf50',
                        iconColor: '#4caf50',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Stay on the same settings page (don't redirect to dashboard)
                            location.reload();
                        }
                    });
                } else {
                    // Show error alert
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update site name. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#f44336',
                        background: '#0f1419',
                        color: '#ffffff',
                        titleColor: '#f44336',
                        iconColor: '#f44336',
                        didOpen: () => {
                            document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#f44336',
                    background: '#0f1419',
                    color: '#ffffff',
                    titleColor: '#f44336',
                    iconColor: '#f44336',
                    didOpen: () => {
                        document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                    }
                });
            });
        });

        // Reset form button functionality
        function resetForm() {
            document.getElementById('settingsForm').reset();
            // Reload to get original values
            location.reload();
        }

        // Show SweetAlert if success message is present in session (for page reload scenarios)
        <?php if(session('success')): ?>
            Swal.fire({
                title: 'Success!',
                text: 'Site name changed successfully!',
                icon: 'success',
                confirmButtonColor: '#4caf50',
                background: '#0f1419',
                color: '#ffffff',
                titleColor: '#4caf50',
                iconColor: '#4caf50',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\admin\settings\index.blade.php ENDPATH**/ ?>