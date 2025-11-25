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
    <?php $__env->startSection('page-title', 'Edit User'); ?>

    <div class="min-h-screen py-8" style="background: linear-gradient(135deg, #0f0707 0%, #0f1419 50%, #1a1f2e 100%);">
        <div class="max-w-2xl mx-auto">
            <!-- Header with Icon -->
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); box-shadow: 0 8px 32px rgba(139, 0, 0, 0.3);">
                    <svg class="w-8 h-8" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl font-bold mb-2" style="color: #ffffff; letter-spacing: 0.5px;">Edit User</h2>
                <p class="text-base" style="color: #b0bcc4;">Update user information and access settings</p>
            </div>

            <!-- Form Card -->
            <div class="rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; backdrop-filter: blur(10px);">
                <!-- Gradient Top Border -->
                <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

                <div class="p-8 lg:p-10">
                    <form action="<?php echo e(route('admin.users.update', $user)); ?>" method="POST" class="space-y-8">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <!-- Profile Picture Section -->
                        <div class="border-b pb-8" style="border-color: #b0bcc4;">
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="#b0bcc4" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <label class="text-sm font-bold" style="color: #ffffff;">Profile Picture</label>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="flex flex-col items-center">
                                    <?php if($user->profile_picture): ?>
                                        <img id="profile-preview" src="<?php echo e(asset('storage/' . $user->profile_picture)); ?>?t=<?php echo e(time()); ?>" alt="Profile" style="width: 120px; height: 120px; border-radius: 12px; object-fit: cover; border: 3px solid #b0bcc4; box-shadow: 0 4px 12px rgba(139, 0, 0, 0.2);">
                                    <?php else: ?>
                                        <div id="profile-preview" style="width: 120px; height: 120px; border-radius: 12px; background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; font-weight: bold; border: 3px solid #b0bcc4;">
                                            <?php echo e($user->name[0] ?? 'U'); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <button type="button" onclick="document.getElementById('admin-profile-picture-input').click();" class="px-6 py-3 rounded-lg font-bold text-base transition-all" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: white; border: 2px solid #0f6fdd; box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3);" onmouseover="this.style.boxShadow='0 8px 20px rgba(15, 111, 221, 0.5)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='0 4px 12px rgba(15, 111, 221, 0.3)'; this.style.transform='translateY(0)'">
                                        📸 Change Picture
                                    </button>
                                    <input type="file" id="admin-profile-picture-input" accept="image/*" style="display: none;" onchange="handleAdminProfilePictureUpload(this, <?php echo e($user->id); ?>)">
                                    <p style="color: #b0bcc4; font-size: 0.875rem; margin-top: 8px;">Supported formats: JPEG, PNG, GIF (Max 5MB)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Groups -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="#b0bcc4" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <label for="name" class="text-sm font-bold" style="color: #ffffff;">Full Name</label>
                                    <span style="color: #f44336;">*</span>
                                </div>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="<?php echo e(old('name', $user->name)); ?>"
                                    placeholder="John Doe"
                                    class="w-full px-4 py-3 rounded-lg text-base transition-all duration-200"
                                    style="border: 2px solid #444; background-color: #0f0707; color: #ffffff; caret-color: #b0bcc4;"
                                    onfocus="this.style.borderColor='#b0bcc4'; this.style.boxShadow='0 0 0 3px rgba(218, 165, 32, 0.1)'"
                                    onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                    required
                                />
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-2 text-sm font-medium" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Email Field -->
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="#b0bcc4" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <label for="email" class="text-sm font-bold" style="color: #ffffff;">Email Address</label>
                                    <span style="color: #f44336;">*</span>
                                </div>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="<?php echo e(old('email', $user->email)); ?>"
                                    placeholder="user@example.com"
                                    class="w-full px-4 py-3 rounded-lg text-base transition-all duration-200"
                                    style="border: 2px solid #444; background-color: #0f0707; color: #ffffff; caret-color: #b0bcc4;"
                                    onfocus="this.style.borderColor='#b0bcc4'; this.style.boxShadow='0 0 0 3px rgba(218, 165, 32, 0.1)'"
                                    onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                    required
                                />
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-2 text-sm font-medium" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Password Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- New Password Field -->
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="#b0bcc4" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <label for="password" class="text-sm font-bold" style="color: #ffffff;">New Password</label>
                                    <span style="font-size: 0.75rem; color: #b0bcc4;">(optional)</span>
                                </div>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Leave blank to keep current"
                                    class="w-full px-4 py-3 rounded-lg text-base transition-all duration-200"
                                    style="border: 2px solid #444; background-color: #0f0707; color: #ffffff; caret-color: #b0bcc4;"
                                    onfocus="this.style.borderColor='#b0bcc4'; this.style.boxShadow='0 0 0 3px rgba(218, 165, 32, 0.1)'"
                                    onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                />
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-2 text-sm font-medium" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Confirm Password Field -->
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="#b0bcc4" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <label for="password_confirmation" class="text-sm font-bold" style="color: #ffffff;">Confirm Password</label>
                                    <span style="font-size: 0.75rem; color: #b0bcc4;">(if changing)</span>
                                </div>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    placeholder="Re-enter new password"
                                    class="w-full px-4 py-3 rounded-lg text-base transition-all duration-200"
                                    style="border: 2px solid #444; background-color: #0f0707; color: #ffffff; caret-color: #b0bcc4;"
                                    onfocus="this.style.borderColor='#b0bcc4'; this.style.boxShadow='0 0 0 3px rgba(218, 165, 32, 0.1)'"
                                    onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                />
                                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-2 text-sm font-medium" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="#b0bcc4" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <label class="text-sm font-bold" style="color: #ffffff;">User Role</label>
                                <span style="color: #f44336;">*</span>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px;">
                                <?php $__currentLoopData = ['admin' => 'Admin', 'staff' => 'Staff', 'customer' => 'Customer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleValue => $roleLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label style="position: relative; cursor: pointer;">
                                        <input 
                                            type="radio" 
                                            name="roles" 
                                            value="<?php echo e($roleValue); ?>"
                                            style="position: absolute; opacity: 0; cursor: pointer;"
                                            <?php echo e((old('roles') === $roleValue || (is_array($user->roles) && count($user->roles) > 0 && $user->roles[0] === $roleValue && !old('roles'))) ? 'checked' : ''); ?>

                                            required
                                        />
                                        <div style="padding: 12px 16px; border-radius: 10px; border: 2px solid #444; text-align: center; font-weight: 600; transition: all 0.3s ease; background-color: #0f1419; color: #b0bcc4;" 
                                             onmouseover="this.style.borderColor='#b0bcc4'; this.style.boxShadow='0 0 0 3px rgba(218, 165, 32, 0.1)'"
                                             onmouseout="this.style.borderColor='#444'; this.style.boxShadow=''">
                                            <?php echo e($roleLabel); ?>

                                        </div>
                                        <div style="position: absolute; top: 6px; right: 6px; width: 20px; height: 20px; border: 2px solid #b0bcc4; border-radius: 50%; display: none; background-color: #b0bcc4;"></div>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__errorArgs = ['roles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-2 text-sm font-medium" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Form Actions -->
                        <div style="border-top: 2px solid #b0bcc4; padding-top: 32px; display: grid; grid-template-columns: 1fr 2fr; gap: 16px;">
                            <a 
                                href="<?php echo e(route('admin.users.index')); ?>" 
                                class="px-6 py-4 rounded-xl font-bold text-base transition-all duration-300 text-center flex items-center justify-center"
                                style="background: linear-gradient(135deg, #333 0%, #222 100%); color: #b0bcc4; border: 2px solid #555; box-shadow: 0 4px 12px rgba(0,0,0,0.3);"
                                onmouseover="this.style.backgroundColor='#444'; this.style.borderColor='#b0bcc4'; this.style.boxShadow='0 6px 16px rgba(218, 165, 32, 0.2)'; this.style.transform='translateY(-2px)'"
                                onmouseout="this.style.backgroundColor='#333'; this.style.borderColor='#555'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.3)'; this.style.transform='translateY(0)'"
                            >
                                <span style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Cancel
                                </span>
                            </a>
                            <button 
                                type="submit" 
                                class="px-8 py-4 rounded-xl font-bold text-base transition-all duration-300 flex items-center justify-center"
                                style="background: linear-gradient(135deg, #ff9500 0%, #ff8500 100%); color: white; border: 3px solid #ff8500; box-shadow: 0 6px 20px rgba(255, 149, 0, 0.4);"
                                onmouseover="this.style.boxShadow='0 12px 32px rgba(255, 149, 0, 0.5)'; this.style.transform='translateY(-3px)'; this.style.background='linear-gradient(135deg, #ffb000 0%, #ff9500 100%)'"
                                onmouseout="this.style.boxShadow='0 6px 20px rgba(255, 149, 0, 0.4)'; this.style.transform='translateY(0)'; this.style.background='linear-gradient(135deg, #ff9500 0%, #ff8500 100%)'"
                            >
                                <span style="display: flex; align-items: center; justify-content: center; gap: 10px; font-size: 1.05rem;">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Save Changes
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        input[type="radio"]:checked + div {
            background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%) !important;
            color: #ffffff !important;
            border-color: #b0bcc4 !important;
            box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.2), 0 0 0 6px rgba(139, 0, 0, 0.2) !important;
        }

        input[type="radio"]:checked + div + div {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
    </style>

    <script>
        function handleAdminProfilePictureUpload(input, userId) {
            if (!input.files || !input.files[0]) return;

            const file = input.files[0];
            const formData = new FormData();
            formData.append('profile_picture', file);

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profile-preview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    const img = document.createElement('img');
                    img.id = 'profile-preview';
                    img.src = e.target.result;
                    img.style.cssText = 'width: 120px; height: 120px; border-radius: 12px; object-fit: cover; border: 3px solid #b0bcc4; box-shadow: 0 4px 12px rgba(139, 0, 0, 0.2);';
                    preview.parentNode.replaceChild(img, preview);
                }
            };
            reader.readAsDataURL(file);

            // Upload file
            fetch('<?php echo e(route("admin.users.update-picture", ":id")); ?>'.replace(':id', userId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const preview = document.getElementById('profile-preview');
                    const picUrl = data.picture_url + '?t=' + new Date().getTime();
                    if (preview.tagName === 'IMG') {
                        preview.src = picUrl;
                    }
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Success', data.message, 'success');
                    } else {
                        alert(data.message);
                    }
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Error', data.message, 'error');
                    } else {
                        alert('Error: ' + data.message);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Error', 'Upload failed', 'error');
                } else {
                    alert('Upload failed');
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\admin\users\edit.blade.php ENDPATH**/ ?>