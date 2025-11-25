<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => ['title' => 'My Profile - CICT Merch']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('My Profile - CICT Merch')]); ?>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        :root {
            --cream: #FFFAF1;
            --white: #FFFFFF;
            --red: #8B0000;
            --red-dark: #6B0000;
            --red-light: #A00000;
            --border: #F0F0F0;
            --text-dark: #1a1a1a;
            --text-muted: #888888;
            --text-medium: #666666;
        }

        html, body {
            background: var(--cream) !important;
            margin: 0;
            padding: 0;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(135deg, #8B0000 0%, #C41E3A 25%, #FF6B35 50%, #FFA500 75%, #FFD700 100%);
            z-index: 0;
            pointer-events: none;
        }

        .profile-page {
            background: var(--cream);
            min-height: 100vh;
            padding-bottom: 80px;
            padding-top: 140px;
            position: relative;
        }

        .profile-header {
            display: none;
        }

        .profile-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 32px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 32px;
            align-items: start;
            position: relative;
            margin-top: 0;
        }

        /* ============ SIDEBAR ============ */
        .sidebar {
            display: none;
        }

        .profile-card {
            display: none;
        }

        .avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: -40px -40px 40px -40px;
            padding: 56px 40px 40px 40px;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.05) 0%, rgba(255, 215, 0, 0.03) 100%);
            border-radius: 24px 24px 0 0;
            border-bottom: 1px solid rgba(139, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }

        .avatar-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .avatar-image {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            display: block;
            box-shadow: 0 8px 32px rgba(139, 0, 0, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            z-index: 2;
        }

        .avatar-image:hover {
            transform: scale(1.12) translateY(-8px);
            box-shadow: 0 20px 60px rgba(139, 0, 0, 0.35);
        }

        .avatar-placeholder {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--red) 0%, var(--red-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
            border: 5px solid white;
            box-shadow: 0 8px 32px rgba(139, 0, 0, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            z-index: 2;
        }

        .avatar-placeholder:hover {
            transform: scale(1.12) translateY(-8px);
            box-shadow: 0 20px 60px rgba(139, 0, 0, 0.35);
        }

        .profile-name {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-dark);
            margin-top: 24px;
            margin-bottom: 8px;
            letter-spacing: -0.8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 2;
        }

        .profile-email {
            font-size: 15px;
            color: var(--text-medium);
            word-break: break-word;
            margin-bottom: 24px;
            font-weight: 600;
            letter-spacing: 0.3px;
            position: relative;
            z-index: 2;
        }

        .upload-btn {
            background: linear-gradient(135deg, var(--red) 0%, var(--red-light) 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            width: fit-content;
            margin-top: 8px;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.2);
            z-index: 2;
        }

        .upload-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--red-dark) 0%, #FFD700 100%);
            transition: left 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: -1;
        }

        .upload-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 36px rgba(139, 0, 0, 0.3);
        }

        .upload-btn:hover::before {
            left: 0;
        }

        .upload-btn:active {
            transform: translateY(-2px);
        }

        #profile_picture_input {
            display: none;
        }

        /* ============ MAIN CONTENT ============ */
        .main-content {
            display: flex;
            flex-direction: column;
            gap: 28px;
            width: 100%;
        }

        .content-card {
            background: var(--white);
            border: 1px solid rgba(139, 0, 0, 0.06);
            border-radius: 24px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04), 0 1px 4px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .content-card:hover {
            border-color: rgba(139, 0, 0, 0.12);
            box-shadow: 0 12px 40px rgba(139, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--red) 0%, var(--red-light) 100%);
            padding: 24px 40px;
            border-bottom: none;
        }

        .card-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.3px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 40px;
            background: linear-gradient(to bottom, rgba(255, 250, 241, 0.3) 0%, transparent 100%);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(139, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .info-item:hover {
            border-bottom-color: rgba(139, 0, 0, 0.2);
            padding-left: 8px;
        }

        .info-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--text-muted);
            margin: 0;
        }

        .info-value {
            font-size: 17px;
            font-weight: 600;
            color: var(--text-dark);
            letter-spacing: -0.2px;
        }

        .stats-section h2 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 32px 0 24px 0;
            letter-spacing: -0.4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid rgba(139, 0, 0, 0.08);
            border-radius: 20px;
            padding: 32px 24px;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 4px 16px rgba(139, 0, 0, 0.04), 0 1px 4px rgba(0, 0, 0, 0.02);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--red) 0%, #FFD700 100%);
            opacity: 0.6;
        }

        .stat-card:hover {
            border-color: rgba(139, 0, 0, 0.15);
            box-shadow: 0 12px 32px rgba(139, 0, 0, 0.1), 0 4px 12px rgba(0, 0, 0, 0.05);
            transform: translateY(-4px);
        }

        .stat-icon {
            font-size: 48px;
            margin-bottom: 16px;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.2) rotateY(10deg);
        }

        .stat-value {
            font-size: 36px;
            font-weight: 800;
            color: var(--red);
            margin: 8px 0;
            letter-spacing: -1px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-label {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-medium);
            letter-spacing: 0.9px;
            margin-bottom: 12px;
        }

        .stat-action {
            font-size: 12px;
            font-weight: 700;
            color: var(--red);
            margin-top: 12px;
            opacity: 0;
            transform: translateY(8px);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .stat-card:hover .stat-action {
            opacity: 1;
            transform: translateY(0);
        }

        .quick-actions-section {
            background: var(--white);
            border: 1px solid rgba(139, 0, 0, 0.08);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04), 0 1px 4px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .quick-actions-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--red) 0%, #FFD700 100%);
            opacity: 0.6;
        }

        .quick-actions-section:hover {
            border-color: rgba(139, 0, 0, 0.12);
            box-shadow: 0 12px 40px rgba(139, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }

        .quick-actions-section h3 {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-dark);
            margin: 0 0 8px 0;
            letter-spacing: -0.4px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .quick-actions-desc {
            font-size: 15px;
            color: var(--text-medium);
            margin: 0 0 32px 0;
            font-weight: 500;
            line-height: 1.6;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .action-btn {
            background: var(--white);
            border: 1px solid rgba(139, 0, 0, 0.12);
            color: var(--text-dark);
            padding: 18px 16px;
            border-radius: 16px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--red) 0%, var(--red-light) 100%);
            opacity: 0;
            transition: opacity 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: -1;
        }

        .action-btn:hover {
            border-color: var(--red);
            color: white;
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(139, 0, 0, 0.15);
        }

        .action-btn:hover::before {
            opacity: 1;
        }

        /* ============ INPUT FIELDS ============ */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid rgba(139, 0, 0, 0.12);
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--white);
            color: var(--text-dark);
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        textarea:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.08), 0 4px 12px rgba(139, 0, 0, 0.12);
            background: var(--white);
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: var(--text-muted);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 700;
            color: var(--text-dark);
            font-size: 14px;
            letter-spacing: 0.3px;
            text-transform: capitalize;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        input[type="password"] {
            letter-spacing: 0.15em;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 1024px) {
            .profile-container {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .action-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .action-grid {
                grid-template-columns: 1fr;
            }

            .avatar-section {
                flex-direction: column;
                gap: 16px;
            }
        }

        @media (max-width: 640px) {
            .profile-page {
                padding-top: 120px;
                padding-bottom: 40px;
            }

            .profile-header {
                padding: 40px 20px 165px 20px;
            }

            .profile-header h1 {
                font-size: 28px;
            }

            .profile-header p {
                font-size: 14px;
            }

            .profile-container {
                padding: 0 16px;
                gap: 16px;
            }

            .card-body {
                padding: 16px;
            }

            .avatar-section {
                padding: 24px 16px 16px 16px;
                margin: -24px -16px 16px -16px;
            }

            .action-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions-section {
                padding: 16px;
            }

            .avatar-image,
            .avatar-placeholder {
                width: 80px;
                height: 80px;
                font-size: 36px;
                border-width: 3px;
            }

            .profile-name {
                font-size: 16px;
            }

            .stat-value {
                font-size: 28px;
            }
        }
    </style>

    <div class="profile-page">
        <!-- Header -->
        <div class="profile-header" style="margin-top: 100px;">
            <h1>My Profile</h1>
            <p>Manage your account information and preferences</p>
        </div>

        <!-- Main Container -->
        <div class="profile-container">
            <!-- Main Content -->
            <main class="main-content">
                <!-- Profile Information Card -->
                <div class="content-card">
                    <!-- Avatar Section -->
                    <div class="avatar-section">
                        <?php if(auth()->user()->profile_picture): ?>
                            <img src="<?php echo e(asset('storage/' . auth()->user()->profile_picture)); ?>" alt="Profile Picture" class="avatar-image">
                        <?php else: ?>
                            <div class="avatar-placeholder">👤</div>
                        <?php endif; ?>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <div class="profile-name"><?php echo e(auth()->user()->name); ?></div>
                            <div class="profile-email"><?php echo e(auth()->user()->email); ?></div>
                            <button type="button" class="upload-btn" onclick="document.getElementById('profile_picture_input').click();">📸 Upload Photo</button>
                            <input type="file" id="profile_picture_input" accept="image/*" onchange="handleProfilePictureUpload(this)">
                        </div>
                    </div>

                    <div class="card-header">
                        <h3>📋 Profile Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <!-- Full Name Edit -->
                            <div class="info-item">
                                <span class="info-label">Full Name</span>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <span class="info-value" id="name-display"><?php echo e(auth()->user()->name); ?></span>
                                    <button type="button" class="action-btn" style="padding: 6px 12px; font-size: 12px;" onclick="editField('name')">✏️ Edit</button>
                                </div>
                                <div id="name-edit-form" style="display: none; margin-top: 12px;">
                                    <form method="POST" action="<?php echo e(route('profile.update-name')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div style="display: flex; gap: 8px;">
                                            <input 
                                                type="text" 
                                                name="name" 
                                                value="<?php echo e(auth()->user()->name); ?>" 
                                                required 
                                                autocomplete="name"
                                                minlength="2"
                                                style="flex: 1; padding: 12px; border: 2px solid #F0F0F0; border-radius: 8px; font-size: 16px; min-height: 48px;">
                                            <button type="submit" class="action-btn" style="padding: 8px 16px;">✓ Save</button>
                                            <button type="button" class="action-btn" style="padding: 8px 16px; background: #F0F0F0; color: #8B0000;" onclick="editField('name')">✕ Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Email Edit -->
                            <div class="info-item">
                                <span class="info-label">Email Address</span>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <span class="info-value" id="email-display"><?php echo e(auth()->user()->email); ?></span>
                                    <button type="button" class="action-btn" style="padding: 6px 12px; font-size: 12px;" onclick="editField('email')">✏️ Edit</button>
                                </div>
                                <div id="email-edit-form" style="display: none; margin-top: 12px;">
                                    <form method="POST" action="<?php echo e(route('profile.update-email')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div style="display: flex; gap: 8px;">
                                            <input 
                                                type="email" 
                                                name="email" 
                                                value="<?php echo e(auth()->user()->email); ?>" 
                                                required 
                                                autocomplete="email"
                                                inputmode="email"
                                                style="flex: 1; padding: 12px; border: 2px solid #F0F0F0; border-radius: 8px; font-size: 16px; min-height: 48px;">
                                            <button type="submit" class="action-btn" style="padding: 8px 16px;">✓ Save</button>
                                            <button type="button" class="action-btn" style="padding: 8px 16px; background: #F0F0F0; color: #8B0000;" onclick="editField('email')">✕ Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Account Type</span>
                                <span class="info-value">
                                    <?php
                                        // Normalize roles into an array. roles might be stored as JSON string, plain string, or already an array.
                                        $rawRoles = auth()->user()->roles ?? [];
                                        $rolesArray = [];

                                        if (is_string($rawRoles)) {
                                            $decoded = json_decode($rawRoles, true);
                                            if (is_array($decoded)) {
                                                $rolesArray = $decoded;
                                            } else {
                                                // fallback for comma separated or single role string
                                                $rolesArray = array_filter(array_map('trim', explode(',', $rawRoles)));
                                            }
                                        } elseif (is_array($rawRoles)) {
                                            $rolesArray = $rawRoles;
                                        } else {
                                            // cast to array as last resort
                                            $rolesArray = (array) $rawRoles;
                                        }
                                    ?>

                                    <?php $__currentLoopData = $rolesArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <strong><?php echo e(ucfirst($role)); ?></strong>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Member Since</span>
                                <span class="info-value"><?php echo e(auth()->user()->created_at->format('F d, Y')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Change Card -->
                <div class="content-card">
                    <div class="card-header">
                        <h3>🔐 Change Password</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('profile.update-password')); ?>">
                            <?php echo csrf_field(); ?>
                            <div style="display: flex; flex-direction: column; gap: 16px;">
                                <div>
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark); font-size: 14px;">Current Password</label>
                                    <input 
                                        type="password" 
                                        name="current_password" 
                                        required 
                                        autocomplete="current-password"
                                        style="width: 100%; padding: 14px; border: 2px solid #F0F0F0; border-radius: 8px; font-size: 16px; min-height: 48px; transition: all 0.3s ease;">
                                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span style="color: #ff0000; font-size: 12px; margin-top: 4px; display: block;"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark); font-size: 14px;">New Password</label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        required 
                                        autocomplete="new-password"
                                        minlength="8"
                                        style="width: 100%; padding: 14px; border: 2px solid #F0F0F0; border-radius: 8px; font-size: 16px; min-height: 48px; transition: all 0.3s ease;">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span style="color: #ff0000; font-size: 12px; margin-top: 4px; display: block;"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark); font-size: 14px;">Confirm Password</label>
                                    <input 
                                        type="password" 
                                        name="password_confirmation" 
                                        required 
                                        autocomplete="new-password"
                                        style="width: 100%; padding: 14px; border: 2px solid #F0F0F0; border-radius: 8px; font-size: 16px; min-height: 48px; transition: all 0.3s ease;">
                                </div>
                                <button type="submit" class="action-btn" style="padding: 12px 20px; width: 100%; text-align: center;">🔒 Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Quick Statistics -->
                <div class="stats-section">
                    <h2>📊 Quick Statistics</h2>
                    <div class="stats-grid">
                        <a href="<?php echo e(route('account.orders')); ?>" class="stat-card">
                            <div class="stat-icon">📦</div>
                            <div class="stat-value"><?php echo e(auth()->user()->orders()->count()); ?></div>
                            <div class="stat-label">Total Orders</div>
                            <div class="stat-action">View History →</div>
                        </a>

                        <a href="<?php echo e(route('cart.index')); ?>" class="stat-card">
                            <div class="stat-icon">🛒</div>
                            <?php
                                $cartItems = session()->get('cart', []);
                                $cartCount = 0;
                                foreach ($cartItems as $item) {
                                    $cartCount += $item['quantity'] ?? 1;
                                }
                            ?>
                            <div class="stat-value"><span class="cart-count-badge"><?php echo e($cartCount); ?></span></div>
                            <div class="stat-label">Cart Items</div>
                            <div class="stat-action">Go to Cart →</div>
                        </a>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions-section">
                    <h3>🔗 Quick Actions</h3>
                    <p class="quick-actions-desc">Fast access to frequently used features</p>
                    <div class="action-grid">
                        <a href="<?php echo e(route('shop.index')); ?>" class="action-btn">🛍️ Shop</a>
                        <a href="<?php echo e(route('account.orders')); ?>" class="action-btn">📋 Orders</a>
                        <a href="<?php echo e(route('cart.index')); ?>" class="action-btn">🛒 Cart</a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function handleProfilePictureUpload(input) {
            if (!input.files || !input.files[0]) return;

            const file = input.files[0];
            
            // Show loading state
            const loadingAlert = Swal.fire({
                title: 'Uploading...',
                html: 'Please wait while we upload your profile picture.',
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData();
            formData.append('profile_picture', file);
            formData.append('_token', document.querySelector('input[name="_token"]')?.value || '');

            fetch('<?php echo e(route("profile.update-picture")); ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the avatar image
                    const avatarImg = document.querySelector('.avatar-image');
                    const avatarPlaceholder = document.querySelector('.avatar-placeholder');
                    
                    if (avatarPlaceholder) {
                        avatarPlaceholder.remove();
                    }
                    
                    if (avatarImg) {
                        avatarImg.src = data.picture_url + '?t=' + new Date().getTime();
                    } else {
                        const img = document.createElement('img');
                        img.src = data.picture_url;
                        img.className = 'avatar-image';
                        img.alt = 'Profile Picture';
                        document.querySelector('.avatar-section').prepend(img);
                    }
                    
                    // Show success message
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your profile picture has been updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'Great!',
                        confirmButtonColor: '#8B0000',
                        timer: 3000,
                        timerProgressBar: true
                    });
                    
                    // Reset the input
                    input.value = '';
                } else {
                    // Show error message
                    Swal.fire({
                        title: 'Upload Failed',
                        text: data.message || 'Failed to upload image. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'Try Again',
                        confirmButtonColor: '#8B0000'
                    });
                    input.value = '';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error message
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while uploading your image. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#8B0000'
                });
                input.value = '';
            });
        }

        function editField(fieldName) {
            const displayElement = document.getElementById(`${fieldName}-display`);
            const editForm = document.getElementById(`${fieldName}-edit-form`);
            
            if (editForm.style.display === 'none') {
                displayElement.style.display = 'none';
                editForm.style.display = 'block';
            } else {
                displayElement.style.display = 'inline';
                editForm.style.display = 'none';
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\profile\show.blade.php ENDPATH**/ ?>