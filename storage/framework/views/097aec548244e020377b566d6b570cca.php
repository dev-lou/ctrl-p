<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'CICT Merch Hub - Student Council Merchandise'); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <style>
        :root {
            /* Core Color Palette - Elegant & Soft */
            --color-bg-primary: #FFFAF1;
            --color-surface: #FFFFFF;
            --color-primary: #8B0000;
            --color-primary-dark: #6B0000;
            --color-accent: #DAA520;
            --color-accent-dark: #B8860B;
            --color-text: #000000;
            --color-text-white: #FFFFFF;
            --color-border: #E8DCC8;
            --color-accent-light: rgba(218, 165, 32, 0.15);
        }

        @keyframes gradientWave {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes bounce-slow {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
        }

        /* Hide Alpine elements until Alpine has initialized */
        [x-cloak] { 
            display: none !important; 
        }

        /* Global Background */
        body {
            background: var(--color-bg-primary) !important;
            color: var(--color-text) !important;
        }

        /* Page Container */
        .page-bg-animated {
            background: var(--color-bg-primary) !important;
            min-height: 100vh;
        }

        .animated-gradient-section {
            background: var(--color-primary) !important;
        }

        /* Hero/Section Text - White on Maroon */
        .animated-gradient-section h1,
        .animated-gradient-section h2,
        .animated-gradient-section h3,
        .animated-gradient-section h4,
        .animated-gradient-section h5,
        .animated-gradient-section h6 {
            color: var(--color-text-white) !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .animated-gradient-section p,
        .animated-gradient-section span,
        .animated-gradient-section label {
            color: rgba(255, 255, 255, 0.95) !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Cards in Hero Sections */
        .animated-gradient-section .card,
        .animated-gradient-section [style*="background: var(--color-surface)"] {
            background: var(--color-surface) !important;
        }

        .animated-gradient-section .card h3,
        .animated-gradient-section .card p {
            color: var(--color-text) !important;
            text-shadow: none !important;
        }

        /* Primary Button (Maroon) */
        .btn-primary {
            background: var(--color-primary);
            color: var(--color-text-white);
            border: 2px solid var(--color-primary);
            font-weight: 700;
            border-radius: 12px;
            padding: 12px 32px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
        }

        .btn-primary:hover {
            background: var(--color-primary-dark);
            border-color: var(--color-primary-dark);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.4);
            transform: translateY(-2px);
        }

        /* Secondary Button (Gold) */
        .btn-secondary {
            background: var(--color-accent);
            color: var(--color-text);
            border: 2px solid var(--color-accent);
            font-weight: 700;
            border-radius: 12px;
            padding: 12px 32px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(218, 165, 32, 0.3);
        }

        .btn-secondary:hover {
            background: var(--color-accent-dark);
            border-color: var(--color-accent-dark);
            color: var(--color-text-white);
            box-shadow: 0 6px 16px rgba(218, 165, 32, 0.4);
            transform: translateY(-2px);
        }

        /* Ghost Button */
        .btn-ghost {
            background: transparent;
            color: var(--color-primary);
            border: 2px solid var(--color-primary);
            font-weight: 700;
            border-radius: 12px;
            padding: 12px 32px;
            transition: all 0.3s ease;
        }

        .btn-ghost:hover {
            background: var(--color-primary);
            color: var(--color-text-white);
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        /* Card Component */
        .card {
            background: var(--color-surface) !important;
            border: 1px solid var(--color-border) !important;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .card-title {
            color: var(--color-text) !important;
            font-weight: 700 !important;
        }

        .card-text {
            color: var(--color-text) !important;
        }

        /* Responsive Container */
        .container-elegant {
            background: var(--color-bg-primary);
            padding: 2rem;
            border-radius: 12px;
        }
    </style>
</head>
<body style="background: var(--color-bg-primary); color: var(--color-text);">
    <div class="min-h-screen flex flex-col" style="background: var(--color-bg-primary);" data-page-type="home">
        <!-- Navigation -->
        <?php if (isset($component)) { $__componentOriginala591787d01fe92c5706972626cdf7231 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala591787d01fe92c5706972626cdf7231 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $attributes = $__attributesOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__attributesOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala591787d01fe92c5706972626cdf7231)): ?>
<?php $component = $__componentOriginala591787d01fe92c5706972626cdf7231; ?>
<?php unset($__componentOriginala591787d01fe92c5706972626cdf7231); ?>
<?php endif; ?>

        <!-- Main Content -->
        <main class="flex-1">
            <?php echo e($slot); ?>

        </main>

        <!-- Footer -->
        <footer style="background: transparent; color: var(--color-text-muted); border-top: none;" class="py-12 mt-0 animated-gradient-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <!-- Brand -->
                    <div>
                        <h3 style="color: #daa520;" class="font-bold text-lg mb-4">👑 CICT MERCH</h3>
                        <p class="text-sm" style="color: rgba(255, 255, 255, 0.8);">ISFUST Dingle Campus CICT Student Council</p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 style="color: white;" class="font-semibold text-sm mb-4">Shop</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="<?php echo e(route('shop.index')); ?>" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">🛍️ Merchandise</a></li>
                            <li><a href="<?php echo e(route('services.index')); ?>" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">📞 Services</a></li>
                            <li><a href="<?php echo e(route('cart.index')); ?>" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">🛒 Cart</a></li>
                        </ul>
                    </div>

                    <!-- Account -->
                    <div>
                        <h4 style="color: white;" class="font-semibold text-sm mb-4">Account</h4>
                        <ul class="space-y-2 text-sm">
                            <?php if(auth()->guard()->check()): ?>
                                <li><a href="<?php echo e(route('profile.edit')); ?>" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">👤 Profile</a></li>
                                <li><a href="<?php echo e(route('account.orders')); ?>" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">📦 My Orders</a></li>
                            <?php else: ?>
                                <li><a href="<?php echo e(route('login')); ?>" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">Sign In</a></li>
                                <li><a href="<?php echo e(route('register')); ?>" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">Create Account</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 style="color: white;" class="font-semibold text-sm mb-4">Support</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">❓ Help Center</a></li>
                            <li><a href="#" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">📧 Contact Us</a></li>
                            <li><a href="#" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors hover:opacity-100">🔒 Privacy</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom -->
                <div style="border-top: 1px solid rgba(218, 165, 32, 0.3);" class="pt-8 flex flex-col sm:flex-row justify-between items-center">
                    <p class="text-sm" style="color: rgba(255, 255, 255, 0.8);">&copy; 2025 CICT Merch Hub. All rights reserved. | ISFUST Dingle Campus</p>
                    <div class="flex gap-6 mt-4 sm:mt-0 text-sm" style="color: rgba(255, 255, 255, 0.8);">
                        <a href="#" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors">Terms</a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors">Privacy</a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.8);" class="hover:text-accent transition-colors">Cookies</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Toast Notification Component -->
    <div 
        x-data="{
            show: false,
            message: '',
            type: 'success',
            init() {
                <?php if(session('success')): ?>
                    this.showToast('<?php echo e(session('success')); ?>', 'success');
                <?php endif; ?>
                <?php if(session('error')): ?>
                    this.showToast('<?php echo e(session('error')); ?>', 'error');
                <?php endif; ?>
            },
            showToast(msg, toastType = 'success') {
                this.message = msg;
                this.type = toastType;
                this.show = true;
                setTimeout(() => { this.show = false }, 4000);
            }
        }"
        @toast.window="showToast($event.detail.message, $event.detail.type || 'success')"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="fixed bottom-8 right-8 z-50 max-w-md"
        style="display: none;"
    >
        <div 
            class="rounded-xl shadow-2xl p-4 flex items-center gap-3"
            :style="type === 'success' ? 'background: rgba(16, 185, 129, 0.95); backdrop-filter: blur(10px);' : 'background: rgba(239, 68, 68, 0.95); backdrop-filter: blur(10px);'"
        >
            <!-- Icon -->
            <div class="flex-shrink-0">
                <template x-if="type === 'success'">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
                <template x-if="type === 'error'">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
            </div>
            
            <!-- Message -->
            <p class="text-white font-semibold flex-1" x-text="message"></p>
            
            <!-- Close Button -->
            <button 
                @click="show = false"
                class="flex-shrink-0 text-white hover:text-gray-200 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Chatbot Widget -->
    <div 
        x-data="{
            open: false,
            messages: [],
            userInput: '',
            isLoading: false,
            init() {
                // Welcome message
                this.messages.push({
                    type: 'bot',
                    text: 'Hi! 👋 I\'m your CICT Merch Hub assistant. How can I help you today?',
                    time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
                });
            },
            async sendMessage() {
                if (!this.userInput.trim() || this.isLoading) return;
                
                const message = this.userInput.trim();
                this.userInput = '';
                
                // Add user message
                this.messages.push({
                    type: 'user',
                    text: message,
                    time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
                });
                
                // Scroll to bottom
                this.$nextTick(() => {
                    const container = this.$refs.chatMessages;
                    if (container) container.scrollTop = container.scrollHeight;
                });
                
                this.isLoading = true;
                
                try {
                    const response = await fetch('/chatbot/message', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({ message })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        this.messages.push({
                            type: 'bot',
                            text: data.message,
                            time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
                        });
                    } else {
                        this.messages.push({
                            type: 'bot',
                            text: data.error || 'Sorry, something went wrong. Please try again.',
                            time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
                        });
                    }
                } catch (error) {
                    console.error('Chat error:', error);
                    this.messages.push({
                        type: 'bot',
                        text: 'Sorry, I\'m having trouble connecting. Please try again later.',
                        time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
                    });
                } finally {
                    this.isLoading = false;
                    this.$nextTick(() => {
                        const container = this.$refs.chatMessages;
                        if (container) container.scrollTop = container.scrollHeight;
                    });
                }
            },
            quickAction(action) {
                const routes = {
                    'shop': '<?php echo e(route('shop.index')); ?>',
                    'services': '<?php echo e(route('services.index')); ?>',
                    'orders': '<?php echo e(route('account.orders')); ?>',
                    'contact': '<?php echo e(route('contact.index')); ?>'
                };
                if (routes[action]) {
                    window.location.href = routes[action];
                }
            }
        }"
        class="fixed bottom-6 right-6 z-50"
        style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 9999 !important;"
    >
        <!-- Chat Button -->
        <button
            @click="open = !open"
            x-show="!open"
            class="group relative w-16 h-16 rounded-full shadow-2xl transition-all duration-300 hover:scale-110 flex items-center justify-center animate-bounce-slow"
            style="background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); animation-duration: 3s; display: flex !important;"
        >
            <!-- AI Sparkle Icon -->
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L9.19 8.63L2 11.5L9.19 14.37L12 21L14.81 14.37L22 11.5L14.81 8.63L12 2Z"/>
                <circle cx="12" cy="11.5" r="1.5" fill="white" opacity="0.8"/>
            </svg>
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse"></span>
        </button>

        <!-- Fallback button when Alpine not loaded yet -->
        <noscript>
            <button
                class="w-16 h-16 rounded-full shadow-2xl flex items-center justify-center"
                style="background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);"
            >
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L9.19 8.63L2 11.5L9.19 14.37L12 21L14.81 14.37L22 11.5L14.81 8.63L12 2Z"/>
                    <circle cx="12" cy="11.5" r="1.5" fill="white" opacity="0.8"/>
                </svg>
            </button>
        </noscript>

        <!-- Chat Window -->
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="absolute bottom-0 right-0 w-96 h-[600px] rounded-2xl shadow-2xl flex flex-col overflow-hidden"
            style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(20px); border: 1px solid rgba(139, 0, 0, 0.1); display: none;"
        >
            <!-- Header -->
            <div class="px-6 py-4 flex items-center justify-between" style="background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: rgba(255, 255, 255, 0.2);">
                        <!-- AI Sparkle Icon -->
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L9.19 8.63L2 11.5L9.19 14.37L12 21L14.81 14.37L22 11.5L14.81 8.63L12 2Z"/>
                            <circle cx="12" cy="11.5" r="1.5" fill="white" opacity="0.8"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-sm">CICT AI Assistant</h3>
                        <p class="text-white text-xs opacity-90">● Online - Powered by Gemini</p>
                    </div>
                </div>
                <button @click="open = false" class="text-white hover:bg-white/20 p-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Messages -->
            <div x-ref="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-4" style="background: #FFFAF1;">
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div 
                            :class="msg.type === 'user' ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white' : 'bg-white border border-gray-200'"
                            class="max-w-[75%] rounded-2xl px-4 py-2.5 shadow-sm"
                        >
                            <p :class="msg.type === 'user' ? 'text-white' : 'text-gray-800'" class="text-sm leading-relaxed" x-text="msg.text"></p>
                            <p :class="msg.type === 'user' ? 'text-blue-100' : 'text-gray-400'" class="text-xs mt-1" x-text="msg.time"></p>
                        </div>
                    </div>
                </template>
                
                <!-- Loading Indicator -->
                <div x-show="isLoading" class="flex justify-start">
                    <div class="bg-white border border-gray-200 rounded-2xl px-4 py-3 shadow-sm">
                        <div class="flex gap-1">
                            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms;"></span>
                            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms;"></span>
                            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms;"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="px-4 py-3 border-t border-gray-200 bg-white">
                <div class="flex gap-2 flex-wrap mb-3">
                    <button @click="quickAction('shop')" class="text-xs px-3 py-1.5 rounded-full border-2 border-gray-300 hover:border-maroon hover:bg-maroon/5 transition-colors font-semibold">
                        🛍️ Shop
                    </button>
                    <button @click="quickAction('services')" class="text-xs px-3 py-1.5 rounded-full border-2 border-gray-300 hover:border-maroon hover:bg-maroon/5 transition-colors font-semibold">
                        🖨️ Services
                    </button>
                    <button @click="quickAction('orders')" class="text-xs px-3 py-1.5 rounded-full border-2 border-gray-300 hover:border-maroon hover:bg-maroon/5 transition-colors font-semibold">
                        📦 Orders
                    </button>
                </div>
            </div>

            <!-- Input -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <form @submit.prevent="sendMessage" class="flex gap-2">
                    <input
                        x-model="userInput"
                        type="text"
                        placeholder="Type your message..."
                        class="flex-1 px-4 py-2.5 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-maroon transition-colors text-sm"
                        :disabled="isLoading"
                    >
                    <button
                        type="submit"
                        :disabled="!userInput.trim() || isLoading"
                        class="px-4 py-2.5 rounded-xl font-bold text-sm transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                        style="background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); color: white;"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Alpine.js for interactive components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\layouts\app.blade.php ENDPATH**/ ?>