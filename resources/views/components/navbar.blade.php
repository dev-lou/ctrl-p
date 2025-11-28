@props([])

<div x-data="{ 
    mobileMenuOpen: false,
    closeMobileMenu() {
        this.mobileMenuOpen = false;
        document.body.style.overflow = '';
    },
    openMobileMenu() {
        this.mobileMenuOpen = true;
        document.body.style.overflow = 'hidden';
    }
}" x-cloak>

<style>
    /* Hide Alpine elements until Alpine has initialized to avoid flash of unstyled content */
    [x-cloak] { display: none !important; }
    .navbar-glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(139, 0, 0, 0.15), 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .navbar-link {
        font-size: 15px;
        font-weight: 600;
        color: #000000;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        display: inline-block;
        font-family: 'Inter', sans-serif;
        padding-bottom: 6px;
    }

    .navbar-link.active {
        color: #8B0000;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .navbar-link.active::after {
        width: 100%;
        box-shadow: 0 2px 8px rgba(139, 0, 0, 0.3);
    }

    .navbar-link:hover {
        color: #8B0000;
        transform: translateY(-2px);
    }

    .navbar-link::after {
        content: '';
        position: absolute;
        bottom: 0px;
        left: 0;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #8B0000 0%, #FFD700 50%, #8B0000 100%);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        border-radius: 2px;
    }

    .navbar-link:hover::after {
        width: 100%;
        box-shadow: 0 2px 6px rgba(139, 0, 0, 0.2);
    }

    /* Dropdown Header Hover */
    .dropdown-header {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .dropdown-header:hover {
        background: linear-gradient(135deg, rgba(218, 165, 32, 0.25) 0%, rgba(218, 165, 32, 0.15) 100%) !important;
    }

    /* Dropdown Items Hover */
    .dropdown-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .dropdown-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #8B0000;
        transform: translateX(-4px);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(139, 0, 0, 0.1) 0%, rgba(139, 0, 0, 0.05) 100%) !important;
        padding-left: calc(1rem + 4px) !important;
    }

    .dropdown-item:hover::before {
        transform: translateX(0);
    }

    .dropdown-item:hover {
        color: #8B0000 !important;
    }

    /* Logout Button Hover */
    .logout-btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .logout-btn::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #DC2626;
        transform: translateX(-4px);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .logout-btn:hover {
        background: linear-gradient(135deg, rgba(220, 38, 38, 0.15) 0%, rgba(220, 38, 38, 0.05) 100%) !important;
        padding-left: calc(1rem + 4px) !important;
        color: #DC2626 !important;
    }

    .logout-btn:hover::before {
        transform: translateX(0);
    }

    /* CART BADGE - shared style used across navbar, cart header and profile */
    .cart-count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 22px;
        padding: 0 8px;
        font-size: 13px;
        font-weight: 700;
        color: #ffffff;
        background: #ff0000;
        border-radius: 9999px;
        line-height: 1;
    }

    /* small adjustment for absolute placement used in navbar */
    .cart-count-badge--nav {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(50%, -50%);
    }

    /* Mobile Menu Styles */
    .mobile-drawer {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        width: 320px;
        max-width: 85vw;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(12px);
        box-shadow: -4px 0 24px rgba(0, 0, 0, 0.2);
        z-index: 100;
        overflow-y: auto;
    }

    .mobile-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 99;
    }

    .mobile-nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        font-size: 16px;
        font-weight: 600;
        color: #000;
        transition: all 0.2s ease;
        border-left: 4px solid transparent;
    }

    .mobile-nav-link.active {
        background: linear-gradient(90deg, rgba(139, 0, 0, 0.1) 0%, transparent 100%);
        border-left-color: #8B0000;
        color: #8B0000;
    }

    .mobile-nav-link:hover {
        background: rgba(139, 0, 0, 0.05);
    }

    .mobile-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }

    /* Ensure touch targets are minimum 44px */
    @media (max-width: 768px) {
        .touch-target {
            min-width: 44px;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        /* Mobile-friendly notification dropdown */
        .notifications-dropdown {
            position: fixed !important;
            left: 0 !important;
            right: 0 !important;
            top: 64px !important; /* below navbar */
            width: 100vw !important;
            margin: 0 !important;
            border-radius: 0 !important;
            max-width: 100vw !important;
            z-index: 2147483648 !important; /* ensure notifications appear above chat widget */
            box-shadow: 0 8px 24px rgba(0,0,0,0.18) !important;
        }
        .notifications-dropdown .overflow-y-auto {
            max-height: calc(100vh - 140px) !important;
            overflow-y: auto !important;
        }
    }
</style>

<div style="position: fixed; top: 16px; left: 16px; right: 16px; z-index: 50;">
    <div style="max-width: 80rem; margin: 0 auto;">
        <nav class="navbar-glass flex justify-between items-center px-6 py-4" style="border: 1px solid rgba(255, 255, 255, 0.2);">
        
        <!-- Logo -->
        <div class="flex items-center">
            <a href="/" class="text-2xl font-bold text-black" style="font-family: 'Inter', sans-serif; font-size: 24px;">{{ config('app.name', 'CICT') }}</a>
        </div>

        <!-- Navigation Links (Center - Hidden on Mobile) -->
        <div class="hidden md:flex items-center gap-12">
            <a href="/" class="navbar-link {{ request()->is('/') ? 'active' : '' }}">
                Home
            </a>
            <a href="{{ route('shop.index') }}" class="navbar-link {{ request()->routeIs('shop.*') ? 'active' : '' }}">
                Shop
            </a>
            <a href="{{ route('services.index') }}" class="navbar-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                Services
            </a>
            <a href="{{ route('contact.index') }}" class="navbar-link {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                Contact
            </a>
        </div>

        <!-- Right Side: Cart & Auth -->
        <div class="flex items-center gap-4">
            <!-- Cart Button (Visible on both mobile and desktop) -->
            @auth
                <a href="{{ route('cart.index') }}" class="relative p-2.5 rounded-lg transition-all duration-200 hover:bg-black/10 text-black touch-target" title="Shopping Cart">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @php
                        // Sum total quantity across cart items so badge shows total items (not distinct products)
                        $cartItems = session()->get('cart', []);
                        $cartCount = 0;
                        foreach ($cartItems as $ci) {
                            $cartCount += $ci['quantity'] ?? 1;
                        }
                    @endphp
                    @if($cartCount > 0)
                        <span class="cart-count-badge cart-count-badge--nav animate-pulse">{{ $cartCount }}</span>
                    @endif
                </a>

                <!-- Notification Bell (Visible on both mobile and desktop) -->
                <div 
                    x-data="{
                        open: false,
                        unreadCount: {{ auth()->user()->unreadNotifications()->count() }},
                        notifications: [],
                        async fetchNotifications() {
                            try {
                                const response = await fetch('/notifications/unread');
                                const data = await response.json();
                                this.unreadCount = data.unread_count || 0;
                                this.notifications = data.notifications || [];
                            } catch (error) {
                                console.error('Failed to fetch notifications:', error);
                            }
                        },
                        async markAsRead(id) {
                            try {
                                await fetch(`/notifications/${id}/read`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
                                this.fetchNotifications();
                            } catch (error) {
                                console.error('Failed to mark notification as read:', error);
                            }
                        },
                        init() {
                            this.fetchNotifications();
                            setInterval(() => this.fetchNotifications(), 30000);
                        }
                    }"
                    class="relative"
                >
                    <button
                        @click="open = !open"
                        class="relative p-2.5 rounded-lg transition-all duration-200 hover:bg-black/10 text-black touch-target"
                        title="Notifications"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span 
                            x-cloak
                            x-show="unreadCount > 0" 
                            x-text="unreadCount"
                            class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 rounded-full animate-pulse" 
                            style="background: #ff0000; min-width: 20px; height: 20px;"
                        ></span>
                    </button>

                    <!-- Notification Dropdown (Desktop and Mobile) -->
                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="notifications-dropdown absolute right-0 mt-3 rounded-xl shadow-xl z-50 overflow-hidden"
                        style="width: min(480px, calc(100vw - 32px)); background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); display: none;"
                    >
                        <div class="px-4 py-3 flex items-center justify-between" style="border-bottom: 1px solid rgba(0, 0, 0, 0.1); background: rgba(218, 165, 32, 0.1);">
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm font-bold text-black">Notifications</h3>
                                <span x-cloak x-show="unreadCount > 0" class="text-xs font-semibold text-white px-2 py-1 rounded-full" style="background: #ff0000;" x-text="unreadCount + ' new'"></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <button @click="open = false" class="p-1 rounded-md text-black hover:bg-black/5" title="Close notifications">✕</button>
                            </div>
                        </div>

                        <div class="overflow-y-auto">
                            <template x-if="notifications.length === 0">
                                <div class="px-4 py-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    <p class="text-sm">No new notifications</p>
                                </div>
                            </template>

                            <template x-for="(notification, index) in notifications.slice(0, 2)" :key="notification.id">
                                <div 
                                    @click="markAsRead(notification.id); open = false; window.location.href = notification.link || '#'"
                                    class="px-4 py-3 hover:bg-black/5 cursor-pointer transition-colors"
                                    style="border-bottom: 1px solid rgba(0, 0, 0, 0.05);"
                                >
                                    <div class="flex items-start gap-3">
                                        <div 
                                            class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0"
                                            :style="notification.type === 'order' ? 'background: #3b82f6;' : 
                                                    notification.type === 'stock' ? 'background: #f59e0b;' :
                                                    notification.type === 'review' ? 'background: #10b981;' : 
                                                    'background: #6366f1;'"
                                        >
                                            <span x-text="notification.type === 'order' ? '📦' : 
                                                         notification.type === 'stock' ? '⚠️' :
                                                         notification.type === 'review' ? '⭐' : 
                                                         '🔔'" class="text-xl"></span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-black" x-text="notification.title"></p>
                                            <p class="text-xs text-gray-600 mt-1" x-text="notification.message"></p>
                                            <p class="text-xs text-gray-400 mt-1" x-text="notification.time"></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <a 
                            href="{{ route('notifications.index') }}"
                            class="block px-4 py-3 text-center text-sm font-semibold transition-colors"
                            style="border-top: 1px solid rgba(0, 0, 0, 0.1); background: rgba(218, 165, 32, 0.05); color: #8B0000;"
                            onmouseover="this.style.background='rgba(218, 165, 32, 0.1)';"
                            onmouseout="this.style.background='rgba(218, 165, 32, 0.05)';"
                        >
                            View All Notifications
                        </a>
                    </div>
                </div>
            @endauth

            <!-- User Menu / Auth Dropdown (Desktop only) -->
            @auth
                <div x-data="{ menuOpen: false }" class="relative hidden md:flex">
                    <button
                        @click="menuOpen = !menuOpen"
                        class="flex items-center gap-1.5 p-1.5 rounded-lg transition-all duration-200 hover:bg-black/10 text-black"
                        title="Account Menu"
                    >
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover border-2 border-gray-200">
                        @else
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xs border-2 border-white" style="background: linear-gradient(135deg, #daa520 0%, #ffd700 100%);">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': menuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        x-show="menuOpen"
                        @click.outside="menuOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                        class="absolute right-0 w-64 rounded-xl shadow-2xl z-50 overflow-hidden"
                        style="top: calc(100% + 0.75rem); background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(12px); border: 1px solid rgba(139, 0, 0, 0.1); display: none;"
                        @click="if ($event.target.closest('a, button, form')) setTimeout(() => menuOpen = false, 100)"
                    >
                        <!-- User Info Header -->
                        <div class="dropdown-header px-4 py-4 flex items-center gap-3" style="border-bottom: 1px solid rgba(0, 0, 0, 0.08); background: linear-gradient(135deg, rgba(218, 165, 32, 0.12) 0%, rgba(218, 165, 32, 0.06) 100%);">
                            @if(auth()->user()->profile_picture)
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="{{ auth()->user()->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                            @else
                                <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold shadow-sm border-2 border-white" style="background: linear-gradient(135deg, #daa520 0%, #ffd700 100%);">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-black truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-600 truncate">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item block px-4 py-3 text-sm font-semibold text-black transition-colors flex items-center gap-3" style="border-bottom: 1px solid rgba(0, 0, 0, 0.05);">
                                <span class="text-lg">🛠️</span>
                                <span>Admin Dashboard</span>
                            </a>
                        @endif

                        <a href="{{ route('profile.show') }}" class="dropdown-item block px-4 py-3 text-sm font-semibold text-black transition-colors flex items-center gap-3">
                            <span class="text-lg">👤</span>
                            <span>My Profile</span>
                        </a>
                        
                        <a href="{{ route('account.orders') }}" class="dropdown-item block px-4 py-3 text-sm font-semibold text-black transition-colors flex items-center gap-3" style="border-bottom: 1px solid rgba(0, 0, 0, 0.05);">
                            <span class="text-lg">📦</span>
                            <span>My Orders</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="block" style="border-top: 1px solid rgba(0, 0, 0, 0.08);">
                            @csrf
                            <button type="submit" class="logout-btn w-full text-left px-4 py-3 text-sm font-bold transition-colors text-red-600 flex items-center gap-3">
                                <span class="text-lg">🚪</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Login / Register Buttons (Desktop only) -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors" style="color: #8B0000; background: transparent; border: 2px solid #8B0000; font-family: 'Inter', sans-serif; font-size: 15px; font-weight: 700;" onmouseover="this.style.background='rgba(139, 0, 0, 0.1)'; this.style.color='#6B0000';" onmouseout="this.style.background='transparent'; this.style.color='#8B0000';">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-semibold rounded-lg text-white transition-all" style="background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); font-family: 'Inter', sans-serif; font-size: 15px; font-weight: 700; box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);" onmouseover="this.style.background='linear-gradient(135deg, #A00000 0%, #C00000 100%)'; this.style.boxShadow='0 6px 16px rgba(139, 0, 0, 0.4)';" onmouseout="this.style.background='linear-gradient(135deg, #8B0000 0%, #A00000 100%)'; this.style.boxShadow='0 4px 12px rgba(139, 0, 0, 0.3)';">
                        Sign Up
                    </a>
                </div>
            @endauth

            <!-- Mobile Menu Button -->
            <button 
                @click="openMobileMenu()"
                class="md:hidden p-2.5 rounded-lg transition-all duration-200 hover:bg-black/10 text-black touch-target"
                aria-label="Open menu"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        </nav>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div 
    x-show="mobileMenuOpen" 
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="closeMobileMenu()"
    class="mobile-overlay"
    style="display: none;"
></div>

<!-- Mobile Menu Drawer (Slide from right) -->
<div 
    x-show="mobileMenuOpen"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
    class="mobile-drawer"
    style="display: none;"
>
    <!-- Mobile Menu Header -->
    <div class="flex items-center justify-between p-4 border-b border-gray-200" style="background: linear-gradient(135deg, rgba(218, 165, 32, 0.1) 0%, rgba(218, 165, 32, 0.05) 100%);">
        <h2 class="text-xl font-bold text-black" style="font-family: 'Inter', sans-serif;">Menu</h2>
        <button 
            @click="closeMobileMenu()"
            class="p-2 rounded-lg hover:bg-black/10 transition-colors touch-target"
            aria-label="Close menu"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    @auth
        <!-- User Profile Section (Mobile) -->
        <div class="p-4 border-b border-gray-200" style="background: linear-gradient(135deg, rgba(139, 0, 0, 0.05) 0%, transparent 100%);">
            <div class="flex items-center gap-3">
                @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="w-12 h-12 rounded-lg object-cover border-2 border-gray-300">
                @else
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center text-white font-bold" style="background: linear-gradient(135deg, #daa520 0%, #ffd700 100%);">
                        {{ auth()->user()->name[0] ?? 'U' }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-black truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-600 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    @endauth

    <!-- Navigation Links -->
    <nav class="py-2">
        <a 
            href="/" 
            @click="closeMobileMenu()"
            class="mobile-nav-link {{ request()->is('/') ? 'active' : '' }}"
        >
            <svg class="mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span>Home</span>
        </a>

        <a 
            href="{{ route('shop.index') }}" 
            @click="closeMobileMenu()"
            class="mobile-nav-link {{ request()->routeIs('shop.*') ? 'active' : '' }}"
        >
            <svg class="mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <span>Shop</span>
        </a>

        <a 
            href="{{ route('services.index') }}" 
            @click="closeMobileMenu()"
            class="mobile-nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}"
        >
            <svg class="mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span>Services</span>
        </a>

        <a 
            href="{{ route('contact.index') }}" 
            @click="closeMobileMenu()"
            class="mobile-nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}"
        >
            <svg class="mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span>Contact</span>
        </a>

        @auth
            <div class="h-px bg-gray-200 my-2"></div>

            @if (auth()->user()->isAdmin())
                <a 
                    href="{{ route('admin.dashboard') }}" 
                    @click="closeMobileMenu()"
                    class="mobile-nav-link"
                >
                    <svg class="mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Admin Dashboard</span>
                </a>
            @endif

            <a 
                href="{{ route('profile.show') }}" 
                @click="closeMobileMenu()"
                class="mobile-nav-link"
            >
                <svg class="mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>My Profile</span>
            </a>

            <a 
                href="{{ route('account.orders') }}" 
                @click="closeMobileMenu()"
                class="mobile-nav-link"
            >
                <svg class="mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span>My Orders</span>
            </a>

            <a 
                href="{{ route('cart.index') }}" 
                @click="closeMobileMenu()"
                class="mobile-nav-link"
            >
                <svg class="mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span>Shopping Cart</span>
            </a>

            <div class="h-px bg-gray-200 my-2"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit" 
                    class="mobile-nav-link w-full text-left text-red-600 hover:bg-red-50"
                >
                    <svg class="mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        @else
            <div class="p-4 space-y-3">
                <a 
                    href="{{ route('login') }}" 
                    @click="closeMobileMenu()"
                    class="block w-full text-center px-4 py-3 text-sm font-semibold rounded-lg transition-colors" 
                    style="color: #8B0000; background: transparent; border: 2px solid #8B0000;"
                >
                    Log In
                </a>
                <a 
                    href="{{ route('register') }}" 
                    @click="closeMobileMenu()"
                    class="block w-full text-center px-4 py-3 text-sm font-semibold rounded-lg text-white transition-all" 
                    style="background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);"
                >
                    Sign Up
                </a>
            </div>
        @endauth
    </nav>
</div>

</div>