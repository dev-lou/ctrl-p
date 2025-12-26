<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Ctrl+P')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/ctrlp-logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/ctrlp-logo.png') }}">

    <!-- Styles -->
    @include('components.vite-assets')
    
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
        <x-navbar />

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        @unless(request()->is('admin*'))
        <!-- Footer (customer-facing) -->
        <footer style="background: linear-gradient(135deg, rgba(6, 11, 20, 0.95) 0%, rgba(15, 23, 42, 0.96) 100%); color: rgba(255, 255, 255, 0.92); border-top: none;" class="py-16 mt-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-12 gap-x-12" style="align-items:flex-start;">
                    <div class="col-span-1" style="display:flex; align-items:flex-start; gap:22px;">
                        <div style="width:92px; height:92px; border-radius:9999px; padding:6px; background:#fff; box-shadow: 0 12px 28px rgba(0,0,0,0.3); flex-shrink:0; display:flex; align-items:center; justify-content:center;">
                            <div style="width:80px; height:80px; border-radius:9999px; overflow:hidden; background:#fff;">
                                <img src="{{ asset('images/ctrlp-logo.png') }}" alt="Ctrl+P logo" style="width:100%; height:100%; object-fit:cover; border-radius:9999px; display:block;">
                            </div>
                        </div>
                        <div style="display:flex; flex-direction:column; gap:8px;">
                            <div style="display:flex; flex-direction:column; gap:4px;">
                                <h3 class="font-bold text-xl" style="margin:0; color:white;">Ctrl+P</h3>
                                <p class="text-sm" style="margin:2px 0 0 0; color: rgba(255,255,255,0.75);">ISUFST Dingle Campus · Shop & Services</p>
                            </div>
                            <p class="text-sm" style="margin:0; color: rgba(255,255,255,0.75); line-height:1.7; max-width: 22rem;">Campus-run store and services delivering print, merch, and digital support for students and orgs.</p>
                        </div>
                    </div>

                    <div class="col-span-1 flex flex-col gap-6" style="margin-top:0;" class="md:mt-0">
                        <div style="padding:16px; border-radius:14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.12); display:flex; align-items:flex-start; gap:12px; align-self:flex-end; max-width:420px; width:100%;">
                            <span style="display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; border-radius:50%; background: linear-gradient(135deg,#8B0000,#A00000); color:white; box-shadow: 0 8px 20px rgba(0,0,0,0.18);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" style="width:20px; height:20px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.25c-2.548 0-4.93-.862-6.772-2.25a.75.75 0 0 1-.228-.834l1.115-3.34a.75.75 0 0 1 .713-.519h1.547A.75.75 0 0 0 9.125 10v-.25A3.625 3.625 0 0 1 12.75 6.125h1.25A3.625 3.625 0 0 1 17.625 9.75v.25a.75.75 0 0 0 .75.75h1.547a.75.75 0 0 1 .713.519l1.115 3.34a.75.75 0 0 1-.228.834A12.433 12.433 0 0 1 12 18.25Z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-sm" style="color:white; margin:0; font-weight:600;">Support</p>
                                <p class="text-sm" style="margin:8px 0 0 0; color: rgba(255,255,255,0.78);">Need help? Ask the chatbot on the bottom-right — it is always on.</p>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-12 flex flex-col gap-4" style="margin-top:16px;" class="md:mt-0">
                        <h4 class="font-semibold text-sm" style="color:white;">Credits</h4>
                        <div class="flex flex-wrap gap-3 text-sm" style="color: rgba(255, 255, 255, 0.92);">
                            <span style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18); padding: 12px 14px; border-radius: 14px; font-weight: 700;">Lou Vincent Baroro — Developer</span>
                            <span style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18); padding: 12px 14px; border-radius: 14px; font-weight: 700;">Karl Calitamon — UX/UI Designer</span>
                        </div>
                    </div>
                </div>

                <div style="border-top: 1px solid rgba(255,255,255,0.12); flex-wrap: wrap;" class="pt-4 text-sm flex flex-col sm:flex-row items-center sm:items-center sm:justify-between gap-2 sm:gap-4">
                    <p style="margin:0; color: rgba(255,255,255,0.75);">&copy; 2025 Ctrl+P · ISUFST Dingle Campus</p>
                    <p style="margin:0; color: rgba(255,255,255,0.65);" class="text-xs">All rights reserved.</p>
                </div>
            </div>
        </footer>
        @endunless
    </div>

    <!-- Toast Notification Component -->
    <div 
        x-data="{
            show: false,
            message: '',
            type: 'success',
            init() {
                @if(session('success'))
                    this.showToast('{{ session('success') }}', 'success');
                @endif
                @if(session('error'))
                    this.showToast('{{ session('error') }}', 'error');
                @endif
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
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                        text: 'CICT AI is not available right now. Please try again later.',
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
                    'shop': '{{ route('shop.index') }}',
                    'services': '{{ route('services.index') }}',
                    'orders': '{{ route('account.orders') }}',
                    'contact': '{{ route('contact.index') }}'
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
