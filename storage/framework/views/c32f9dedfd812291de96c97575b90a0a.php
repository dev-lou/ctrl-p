<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => ['title' => 'Register - CICT Merch']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Register - CICT Merch')]); ?>
    <style>
        :root {
            --color-primary: #8b0000;
            --color-accent: #daa520;
        }

        html, body {
            background: transparent !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .auth-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #8b0000;
            background-image: url('/gold.gif');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding-top: 100px;
            padding-bottom: 40px;
        }

        /* Dark Overlay */
        .auth-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 2;
        }

        /* Animated Gradient Elements */
        .auth-bg-elements {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 3;
            display: none;
        }

        .auth-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 600px;
            padding: 24px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-radius: 24px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4), 
                        0 0 80px rgba(139, 0, 0, 0.1),
                        inset 0 0 0 1px rgba(255, 255, 255, 0.5);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .auth-card:hover {
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.5), 
                        0 0 100px rgba(139, 0, 0, 0.15),
                        inset 0 0 0 1px rgba(255, 255, 255, 0.6);
            transform: translateY(-6px);
        }

        .auth-header {
            padding: 32px 32px 24px;
            text-align: center;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.03) 0%, rgba(218, 165, 32, 0.02) 100%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            position: relative;
        }

        .auth-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #8B0000 0%, #C00000 50%, #8B0000 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
            font-family: 'Inter', sans-serif;
        }

        .auth-subtitle {
            font-size: 15px;
            color: #666;
            font-weight: 500;
            margin: 0;
            line-height: 1.6;
        }

        .auth-body {
            padding: 28px 32px;
        }

        .auth-input-group {
            margin-bottom: 18px;
            width: 100%;
        }

        .auth-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #8B0000;
            margin-bottom: 10px;
            letter-spacing: 0.3px;
            font-family: 'Inter', sans-serif;
        }

        .auth-input {
            width: 100%;
            padding: 15px 18px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(139, 0, 0, 0.12);
            border-radius: 12px;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            color: #1a1a1a;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-sizing: border-box;
            min-height: 52px;
        }

        .auth-input::placeholder {
            color: #aaa;
        }

        .auth-input:focus {
            outline: none;
            border-color: #8B0000;
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.08);
        }

        .auth-input.invalid {
            border-color: #DC2626;
            background: rgba(220, 38, 38, 0.05);
        }

        .auth-input.valid {
            border-color: #4CAF50;
            background: rgba(76, 175, 80, 0.05);
        }

        .validation-message {
            display: none;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 6px;
            animation: slideDown 0.3s ease;
        }

        .validation-message.error {
            display: block;
            color: #DC2626;
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .validation-message.success {
            display: block;
            color: #4CAF50;
            background: rgba(76, 175, 80, 0.1);
            border: 1px solid rgba(76, 175, 80, 0.2);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #8B0000 0%, #B00000 50%, #8B0000 100%);
            background-size: 200% 100%;
            color: #FFFFFF;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.3px;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 10px 25px rgba(139, 0, 0, 0.35),
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
            margin-top: 8px;
            min-height: 52px;
        }

        .auth-button:hover {
            background-position: 100% 0;
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(139, 0, 0, 0.45),
                        inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .auth-button:active {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.35);
        }

        .auth-footer {
            padding: 18px 32px;
            text-align: center;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.02) 0%, rgba(218, 165, 32, 0.02) 100%);
        }

        .auth-footer-text {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .auth-link {
            color: #8B0000;
            font-weight: 700;
            text-decoration: none;
            border-bottom: 2px solid #FFD700;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: inline-block;
        }

        .auth-link:hover {
            color: #A00000;
            transform: translateX(2px);
        }

        .auth-error {
            background: rgba(255, 107, 107, 0.12);
            border: 1px solid #ff6b6b;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 16px;
        }

        .auth-error-item {
            color: #DC2626;
            font-size: 13px;
            font-weight: 600;
            margin: 4px 0;
        }

        .auth-error-item:first-child {
            margin-top: 0;
        }
    </style>

    <div class="auth-section">
        <!-- Background Image -->
        <!-- Dark Overlay -->
        <!-- Animated Gradient Elements -->
        <div class="auth-bg-elements">
            <div class="auth-gradient-1"></div>
            <div class="auth-gradient-2"></div>
            <div class="auth-gradient-3"></div>
        </div>

        <!-- Main Container -->
        <div class="auth-container">
            <div class="auth-card">
                <!-- Header -->
                <div class="auth-header">
                    <h2 class="auth-title">📝 Join Us</h2>
                    <p class="auth-subtitle">Create your account to start shopping quality merchandise</p>
                </div>

                <!-- Form Body -->
                <div class="auth-body">
                    <form method="POST" action="<?php echo e(route('register.post')); ?>" class="space-y-4">
                        <?php echo csrf_field(); ?>

                        <?php if($errors->any()): ?>
                            <div class="auth-error">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="auth-error-item">✗ <?php echo e($error); ?></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="auth-input-group">
                            <label for="name" class="auth-label">👤 Full Name</label>
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                required 
                                class="auth-input" 
                                placeholder="John Doe" 
                                value="<?php echo e(old('name')); ?>"
                                autocomplete="name"
                                minlength="2"
                                oninput="validateName(this)">
                            <div id="name-error" class="validation-message"></div>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="validation-message error">✗ <?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="auth-input-group">
                            <label for="email" class="auth-label">📧 Email Address</label>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required 
                                class="auth-input" 
                                placeholder="you@example.com" 
                                value="<?php echo e(old('email')); ?>"
                                autocomplete="email"
                                inputmode="email"
                                oninput="validateEmail(this)">
                            <div id="email-error" class="validation-message"></div>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="validation-message error">✗ <?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="auth-input-group">
                            <label for="password" class="auth-label">🔒 Password</label>
                            <div style="position: relative;">
                                <input 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    required 
                                    class="auth-input" 
                                    placeholder="Min. 8 characters"
                                    autocomplete="new-password"
                                    minlength="8"
                                    oninput="validatePassword(this)"
                                    style="padding-right: 48px;">
                                <button 
                                    type="button" 
                                    onclick="togglePassword('password', this)"
                                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 8px; color: #666; transition: color 0.2s;"
                                    onmouseover="this.style.color='#8B0000'"
                                    onmouseout="this.style.color='#666'"
                                    aria-label="Toggle password visibility">
                                    <svg class="eye-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        <path class="eye-closed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" style="display: none;"></path>
                                        <path class="eye-closed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 10.5a2 2 0 012.45 2.45M15 12a3 3 0 01-3 3" style="display: none;"></path>
                                    </svg>
                                </button>
                            </div>
                            <div id="password-error" class="validation-message"></div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="validation-message error">✗ <?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="auth-input-group">
                            <label for="password_confirmation" class="auth-label">✓ Confirm Password</label>
                            <div style="position: relative;">
                                <input 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    type="password" 
                                    required 
                                    class="auth-input" 
                                    placeholder="••••••••"
                                    autocomplete="new-password"
                                    oninput="validatePasswordConfirmation(this)"
                                    style="padding-right: 48px;">
                                <button 
                                    type="button" 
                                    onclick="togglePassword('password_confirmation', this)"
                                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 8px; color: #666; transition: color 0.2s;"
                                    onmouseover="this.style.color='#8B0000'"
                                    onmouseout="this.style.color='#666'"
                                    aria-label="Toggle password visibility">
                                    <svg class="eye-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        <path class="eye-closed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" style="display: none;"></path>
                                        <path class="eye-closed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 10.5a2 2 0 012.45 2.45M15 12a3 3 0 01-3 3" style="display: none;"></path>
                                    </svg>
                                </button>
                            </div>
                            <div id="password-confirmation-error" class="validation-message"></div>
                        </div>

                        <script>
                        function togglePassword(inputId, button) {
                            const input = document.getElementById(inputId);
                            const eyeOpen = button.querySelectorAll('.eye-open');
                            const eyeClosed = button.querySelectorAll('.eye-closed');
                            
                            if (input.type === 'password') {
                                input.type = 'text';
                                eyeOpen.forEach(el => el.style.display = 'none');
                                eyeClosed.forEach(el => el.style.display = 'block');
                            } else {
                                input.type = 'password';
                                eyeOpen.forEach(el => el.style.display = 'block');
                                eyeClosed.forEach(el => el.style.display = 'none');
                            }
                        }
                        </script>

                        <button type="submit" class="auth-button">🎉 Create Account</button>
                    </form>
                </div>

                <!-- Footer -->
                <div class="auth-footer">
                    <p class="auth-footer-text">
                        Already have an account? 
                        <a href="<?php echo e(route('login')); ?>" class="auth-link">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateName(input) {
            const errorDiv = document.getElementById('name-error');
            const value = input.value.trim();
            
            if (value.length === 0) {
                input.classList.remove('valid', 'invalid');
                errorDiv.classList.remove('error', 'success');
                errorDiv.textContent = '';
                return;
            }
            
            if (value.length < 2) {
                input.classList.add('invalid');
                input.classList.remove('valid');
                errorDiv.classList.add('error');
                errorDiv.classList.remove('success');
                errorDiv.textContent = '✗ Name must be at least 2 characters';
            } else {
                input.classList.add('valid');
                input.classList.remove('invalid');
                errorDiv.classList.add('success');
                errorDiv.classList.remove('error');
                errorDiv.textContent = '✓ Looks good!';
            }
        }

        function validateEmail(input) {
            const errorDiv = document.getElementById('email-error');
            const value = input.value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (value.length === 0) {
                input.classList.remove('valid', 'invalid');
                errorDiv.classList.remove('error', 'success');
                errorDiv.textContent = '';
                return;
            }
            
            if (!emailPattern.test(value)) {
                input.classList.add('invalid');
                input.classList.remove('valid');
                errorDiv.classList.add('error');
                errorDiv.classList.remove('success');
                errorDiv.textContent = '✗ Please enter a valid email address';
            } else {
                input.classList.add('valid');
                input.classList.remove('invalid');
                errorDiv.classList.add('success');
                errorDiv.classList.remove('error');
                errorDiv.textContent = '✓ Email looks good!';
            }
        }

        function validatePassword(input) {
            const errorDiv = document.getElementById('password-error');
            const value = input.value;
            
            if (value.length === 0) {
                input.classList.remove('valid', 'invalid');
                errorDiv.classList.remove('error', 'success');
                errorDiv.textContent = '';
                return;
            }
            
            if (value.length < 8) {
                input.classList.add('invalid');
                input.classList.remove('valid');
                errorDiv.classList.add('error');
                errorDiv.classList.remove('success');
                errorDiv.textContent = '✗ Password must be at least 8 characters';
            } else {
                input.classList.add('valid');
                input.classList.remove('invalid');
                errorDiv.classList.add('success');
                errorDiv.classList.remove('error');
                errorDiv.textContent = '✓ Password is valid';
            }
            
            // Also validate confirmation if it has a value
            const confirmInput = document.getElementById('password_confirmation');
            if (confirmInput.value.length > 0) {
                validatePasswordConfirmation(confirmInput);
            }
        }

        function validatePasswordConfirmation(input) {
            const errorDiv = document.getElementById('password-confirmation-error');
            const password = document.getElementById('password').value;
            const confirmation = input.value;
            
            if (confirmation.length === 0) {
                input.classList.remove('valid', 'invalid');
                errorDiv.classList.remove('error', 'success');
                errorDiv.textContent = '';
                return;
            }
            
            if (password !== confirmation) {
                input.classList.add('invalid');
                input.classList.remove('valid');
                errorDiv.classList.add('error');
                errorDiv.classList.remove('success');
                errorDiv.textContent = '✗ Passwords do not match';
            } else {
                input.classList.add('valid');
                input.classList.remove('invalid');
                errorDiv.classList.add('success');
                errorDiv.classList.remove('error');
                errorDiv.textContent = '✓ Passwords match!';
            }
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\auth\register.blade.php ENDPATH**/ ?>