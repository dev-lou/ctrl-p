<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => config('app.name', 'IGP Hub') . ' - Student Council Inventory & Services']));

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

foreach (array_filter((['title' => config('app.name', 'IGP Hub') . ' - Student Council Inventory & Services']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <!-- Global debug flag and console silencer for production -->
    <script>
        window.APP_DEBUG = <?php echo json_encode(config('app.debug'), 15, 512) ?>;
        if (!window.APP_DEBUG) {
            // Replace console methods with no-ops in production to avoid noisy logs
            console.log = function() {};
            console.debug = function() {};
            console.info = function() {};
            console.warn = function() {};
        }
    </script>
    <?php $viteManifestPath = public_path('build/manifest.json'); ?>
    <?php if(file_exists($viteManifestPath)): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php else: ?>
        <!-- Vite manifest not found; fallback to static assets -->
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <?php endif; ?>
    
    <!-- Page Transition Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('css/page-transitions.css')); ?>">

    <style>
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        @keyframes slideInUp {
            from { 
                opacity: 0; 
                transform: translateY(20px) scale(0.95);
            }
            to { 
                opacity: 1; 
                transform: translateY(0) scale(1);
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .chat-window-enter {
            animation: slideInUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .message-enter {
            animation: fadeIn 0.2s ease-out;
        }
        /* Custom scrollbar for chat */
        #cict-chat-messages::-webkit-scrollbar {
            width: 6px;
        }
        #cict-chat-messages::-webkit-scrollbar-track {
            background: transparent;
        }
        #cict-chat-messages::-webkit-scrollbar-thumb {
            background: rgba(139, 0, 0, 0.2);
            border-radius: 3px;
        }
        #cict-chat-messages::-webkit-scrollbar-thumb:hover {
            background: rgba(139, 0, 0, 0.3);
        }
        /* On mobile reduce area and avoid overlapping notification dropdown */
        @media (max-width: 768px) {
            #cict-chatbot {
                right: 8px !important;
                bottom: 8px !important;
            }
            #cict-chatbot-window {
                right: 8px !important;
                left: 8px !important;
                width: calc(100% - 16px) !important;
                bottom: 8px !important;
                border-radius: 12px !important;
                height: calc(100vh - 120px) !important;
            }
        }
        [x-cloak] { display: none !important; }
        
        /* Scroll Reveal Animations */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px) scale(0.96);
            transition: opacity 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                        transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: opacity, transform;
        }
        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        /* Respect reduced motion preference */
        @media (prefers-reduced-motion: reduce) {
            .reveal-on-scroll {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }
    </style>
</head>
<body class="bg-white text-gray-900 font-inter antialiased">
    <div class="min-h-screen flex flex-col">
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
        <footer class="bg-gray-900 text-gray-300 py-8 border-t border-gray-800 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm">&copy; 2025 Ctrl+P. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Chatbot widget (bottom-right) - pure JS implementation (no Alpine directives) -->
    <div id="cict-chatbot" class="fixed z-50" style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 2147483647 !important; pointer-events: auto !important;">

        <!-- Floating button -->
        <button aria-label="Open CICT AI Assistant" id="cict-chatbot-btn" class="group relative w-16 h-16 rounded-full shadow-xl flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-[0_20px_60px_rgba(139,0,0,0.4)]" style="background: linear-gradient(135deg,#8B0000 0%,#A00000 100%); animation: bounce-slow 2s infinite; display:flex !important; pointer-events: auto !important;">
            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <svg class="w-7 h-7 text-white relative z-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <span class="absolute -top-0.5 -right-0.5 w-3 h-3 bg-green-500 rounded-full border-2 border-white animate-pulse shadow-lg"></span>
        </button>

        <!-- Chat window (fixed & topmost) -->
        <!--
            Notes:
            - Keep this fixed to bottom-right so it always stays visible while scrolling
            - Use max-height based on viewport so the window grows upward instead of increasing bottom space
            - Reduced width and increased height per user request
        -->
        <div id="cict-chatbot-window" class="hidden fixed right-6 w-80 rounded-2xl shadow-2xl flex flex-col overflow-hidden chat-window" role="dialog" aria-label="CICT Assistant" aria-hidden="true" style="display:none; background: rgba(255,255,255,0.98); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(139,0,0,0.1); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25), 0 0 0 1px rgba(139,0,0,0.05); z-index:2147483647 !important; bottom:24px; height:480px; width:320px;">

            <!-- Header -->
            <div class="px-3 py-2.5 flex items-center justify-between" style="background: linear-gradient(135deg,#8B0000 0%,#A00000 100%); color:white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm ring-1 ring-white/30">
                        <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L9.19 8.63L2 11.5L9.19 14.37L12 21L14.81 14.37L22 11.5L14.81 8.63L12 2Z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs font-bold">CICT AI</div>
                        <div class="text-[10px] opacity-90 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                            <span>Online</span>
                        </div>
                    </div>
                </div>
                <button id="cict-chatbot-close" aria-label="Close chat" class="p-1.5 rounded-lg hover:bg-white/10 transition-colors duration-200">
                    <svg class="w-4 h-4 stroke-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Messages area (scrollable) -->
            <div id="cict-chat-messages" class="flex-1 overflow-y-auto p-3 scroll-smooth" style="background: linear-gradient(to bottom, #FFFAF1 0%, #FFF8E7 100%); padding-bottom:96px;">
                <!-- messages rendered here by JS -->
            </div>

            <!-- Loading indicator -->
            <div id="cict-chat-loading" style="display:none; padding:8px 16px; background:transparent;">
                <div class="flex justify-start"><div class="bg-white border border-gray-200 rounded-2xl px-4 py-3 shadow-sm"><div class="flex gap-1"><span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></span><span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay:150ms"></span><span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay:300ms"></span></div></div></div>
            </div>

            <!-- Input area -->
            <div class="p-2.5 border-t border-gray-200 bg-white">
                <form id="cict-chat-form" class="flex gap-2 items-center">
                    <input id="cict-chat-input" name="message" aria-label="Chat message" type="text" placeholder="Type message..." class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:border-maroon-500 focus:ring-1 focus:ring-maroon-200 focus:outline-none transition-all duration-200 text-sm" />
                    <button id="cict-chat-send" type="submit" class="rounded-lg text-white flex items-center justify-center transition-all duration-200 hover:shadow-md active:scale-95 flex-shrink-0" style="background: linear-gradient(135deg,#8B0000 0%,#A00000 100%); width:38px; height:38px;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path></svg>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Scroll Reveal Animation Script -->
    <script>
        (function() {
            // Respect reduced motion preference
            if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                return;
            }
            
            document.addEventListener('DOMContentLoaded', function() {
                const revealElements = document.querySelectorAll('.reveal-on-scroll');
                if (!revealElements.length) return;
                
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        const el = entry.target;
                        const delay = parseInt(el.dataset.revealDelay || '0', 10);
                        
                        if (entry.isIntersecting) {
                            // Element is entering viewport - animate in
                            setTimeout(function() {
                                el.classList.add('revealed');
                            }, delay);
                        } else {
                            // Element left viewport - reset for next scroll
                            el.classList.remove('revealed');
                        }
                    });
                }, {
                    root: null,
                    rootMargin: '0px 0px -50px 0px',
                    threshold: 0.1
                });
                
                revealElements.forEach(function(el) {
                    observer.observe(el);
                });
            });
        })();
    </script>
    
    <!-- Chatbot (vanilla JS): renders messages, handles send & quick actions, always-on-top -->
    <script>
        (function() {
            // Routes & tokens from Blade
            const CHAT_POST = '<?php echo e(route('chatbot.chat')); ?>';
            const QUICK_ROUTES = {
                shop: '<?php echo e(route('shop.index')); ?>',
                services: '<?php echo e(route('services.index')); ?>',
                orders: '<?php echo e(route('account.orders')); ?>',
                contact: '<?php echo e(route('contact.index')); ?>'
            };
            const CSRF = '<?php echo e(csrf_token()); ?>';

            function $(sel, root=document) { return root.querySelector(sel); }
            function $all(sel, root=document) { return Array.from(root.querySelectorAll(sel)); }

            const root = document.getElementById('cict-chatbot');
            if (!root) return;

            // Ensure the widget is appended to document.body — this avoids clipping or transforms
            // from ancestor elements that can make fixed-positioned children invisible.
            try {
                if (root.parentElement && root.parentElement !== document.body) {
                    document.body.appendChild(root);
                    // Debug log removed for production
                }
            } catch (e) {
                // Silently handle widget positioning error
            }

            const btn = $('#cict-chatbot-btn', root);
            const win = $('#cict-chatbot-window', root);
            const messagesEl = $('#cict-chat-messages', root);
            const loadingEl = $('#cict-chat-loading', root);
            const form = $('#cict-chat-form', root);
            const input = $('#cict-chat-input', root);
            const closeBtn = $('#cict-chatbot-close', root);

            let state = { open: false, loading: false, messages: [] };

            function timeNow() {
                return new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }

            function escapeHtml(str) {
                return String(str).replace(/[&<>"]|'/g, function(s){ return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[s]; });
            }

            function render() {
                if (!messagesEl) return;
                const logo = `<div class="flex flex-col items-center justify-center py-8 opacity-70">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-3" style="background: linear-gradient(135deg,#8B0000 0%,#A00000 100%); box-shadow: 0 4px 12px rgba(139,0,0,0.3);">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L9.19 8.63L2 11.5L9.19 14.37L12 21L14.81 14.37L22 11.5L14.81 8.63L12 2Z"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-700 mb-1">CICT AI</div>
                        <div class="text-xs text-gray-500">How can I help you today?</div>
                    </div>
                </div>`;
                
                const messages = state.messages.map((m, idx) => {
                    const wrapper = m.type === 'user' ? 'flex justify-end' : 'flex justify-start';
                    const bubble = m.type === 'user' 
                        ? 'bg-blue-500 text-white shadow-sm hover:shadow-md' 
                        : 'bg-white border border-gray-200 shadow-sm hover:shadow-md';
                    const timeClass = m.type === 'user' ? 'text-blue-100' : 'text-gray-500';
                    const roundedClass = m.type === 'user' ? 'rounded-xl rounded-br-sm' : 'rounded-xl rounded-bl-sm';
                    // render links if any
                    let linksHtml = '';
                    if (m.links && Array.isArray(m.links) && m.links.length) {
                        linksHtml = '<div class="mt-3 flex gap-2 flex-wrap">' + m.links.map(l => `<a href="${encodeURI(l.url)}" class="text-xs bg-white/90 border border-gray-200 text-maroon-700 px-2 py-1 rounded-full hover:bg-maroon-50 shadow-sm" target="_blank" rel="noopener noreferrer">${escapeHtml(l.text)}</a>`).join('') + '</div>';
                    }

                    return `<div class="${wrapper} message-enter" style="animation-delay: ${idx * 0.05}s"><div class="${bubble} ${roundedClass} max-w-[85%] px-3 py-2 transition-shadow duration-200"><div class="text-sm leading-relaxed break-words overflow-wrap-anywhere whitespace-pre-wrap">${escapeHtml(m.text)}</div>${linksHtml}<div class="text-[10px] mt-1 ${timeClass} opacity-65">${escapeHtml(m.time)}</div></div></div>`;
                }).join('');
                
                messagesEl.innerHTML = logo + (state.messages.length > 0 ? '<div class="space-y-2 mt-4">' + messages + '</div>' : '');

                // Ensure the newest message is fully visible instead of being cut off while waiting for a reply.
                // Use a small timeout to allow the browser to render and measure elements before scrolling.
                setTimeout(() => {
                    try {
                        const entries = messagesEl.querySelectorAll('.message-enter');
                        if (entries && entries.length) {
                            const last = entries[entries.length - 1];
                            last.scrollIntoView({ behavior: 'smooth', block: 'end', inline: 'nearest' });
                        } else {
                            messagesEl.scrollTop = messagesEl.scrollHeight;
                        }
                    } catch (e) {
                        messagesEl.scrollTop = messagesEl.scrollHeight;
                    }
                }, 40);
            }

            function openChat() {
                state.open = true;
                // remove any Tailwind 'hidden' class and ensure the window is visually on top and clickable
                if (win.classList.contains('hidden')) win.classList.remove('hidden');
                win.style.removeProperty('display'); // clear prior inline style then set important below
                win.style.setProperty('display', 'flex', 'important');
                win.style.visibility = 'visible';
                win.style.setProperty('z-index', '2147483647', 'important');
                win.style.setProperty('pointer-events', 'auto', 'important');
                win.classList.add('chat-window-enter');
                win.setAttribute('aria-hidden', 'false');
                    if (window.APP_DEBUG) console.log('CICT chat: openChat - showing window');
                // Force bottom-right anchoring to keep it fixed in the visible area
                win.style.setProperty('right', '24px', 'important');
                win.style.setProperty('bottom', '24px', 'important');
                win.style.removeProperty('left');
                win.style.removeProperty('top');

                btn.style.setProperty('display', 'none', 'important');
                btn.setAttribute('aria-expanded', 'true');
                setTimeout(() => messagesEl.scrollTop = messagesEl.scrollHeight, 80);

                // Debugging: log computed styles and bounding rect to help diagnose visibility problems
                try {
                    const cs = window.getComputedStyle(win);
                    if (window.APP_DEBUG) console.log('CICT chat: computed display=', cs.display, 'visibility=', cs.visibility, 'opacity=', cs.opacity, 'zIndex=', cs.zIndex);
                    const rect = win.getBoundingClientRect();
                    if (window.APP_DEBUG) console.log('CICT chat: bounding rect=', rect);

                    // Log viewport info
                    if (window.APP_DEBUG) console.log('CICT chat: viewport innerHeight=', window.innerHeight, 'innerWidth=', window.innerWidth, 'scrollY=', window.scrollY, 'clientHeight=', document.documentElement.clientHeight);

                    // If the element is partially or fully off-screen (top >= innerHeight OR bottom > innerHeight OR fully above) reposition
                    if (rect.top >= window.innerHeight || rect.bottom > window.innerHeight || rect.bottom <= 0 || rect.top < 0) {
                        console.warn('CICT chat: window off-screen or partially off-screen — repositioning into viewport');

                        // If the chat window is taller than the viewport, make it fit inside the viewport with padding
                        if (rect.height >= window.innerHeight) {
                            const pad = 24;
                            win.style.setProperty('top', pad + 'px', 'important');
                            win.style.setProperty('bottom', 'auto', 'important');
                            win.style.setProperty('height', Math.max(120, window.innerHeight - pad * 2) + 'px', 'important');
                        } else {
                            // Normal case: position the window just above the bottom edge, with 24px margin
                            const targetTop = Math.max(24, window.innerHeight - rect.height - 24);
                            win.style.setProperty('top', targetTop + 'px', 'important');
                            win.style.setProperty('bottom', 'auto', 'important');
                        }

                        // Ensure visible horizontally too (handle left/right off-screen)
                            if (rect.left < 0 || rect.right > window.innerWidth) {
                                // move it fully into the viewport (24px margin from the right)
                                win.style.setProperty('left', Math.max(12, window.innerWidth - rect.width - 24) + 'px', 'important');
                                win.style.setProperty('right', 'auto', 'important');
                            }

                        const newRect = win.getBoundingClientRect();
                        if (window.APP_DEBUG) console.log('CICT chat: new bounding rect=', newRect);
                        // also log computed style after reposition
                        const cs2 = window.getComputedStyle(win);
                        if (window.APP_DEBUG) console.log('CICT chat: computed after reposition display=', cs2.display, 'top=', cs2.top, 'bottom=', cs2.bottom, 'left=', cs2.left, 'right=', cs2.right);
                    }

                    // Walk up ancestors and log any transforms which can affect fixed positioning
                    let node = win.parentElement; let i=0; while(node && i<8) {
                        const pcs = window.getComputedStyle(node);
                        if (pcs.transform && pcs.transform !== 'none' && window.APP_DEBUG) console.log('CICT chat: ancestor transform on', node.tagName, 'transform=', pcs.transform);
                        node = node.parentElement; i++;
                    }
                } catch(e) { console.error('CICT chat: openChat debug error', e); }
            }

            function closeChat() {
                state.open = false;
                win.style.setProperty('display', 'none', 'important');
                win.setAttribute('aria-hidden', 'true');
                if (window.APP_DEBUG) console.log('CICT chat: closeChat - hiding window');
                btn.style.setProperty('display', 'flex', 'important');
                btn.setAttribute('aria-expanded', 'false');
            }

            function setLoading(v) {
                state.loading = !!v;
                if (loadingEl) loadingEl.style.display = state.loading ? 'block' : 'none';
                if (input) input.disabled = state.loading;
                // when entering loading state, ensure the most recent message remains visible
                if (state.loading && messagesEl) {
                    setTimeout(() => {
                        try {
                            const entries = messagesEl.querySelectorAll('.message-enter');
                            if (entries && entries.length) entries[entries.length - 1].scrollIntoView({ block: 'end' });
                        } catch (e) { messagesEl.scrollTop = messagesEl.scrollHeight; }
                    }, 40);
                }
            }

            async function sendMessage(text) {
                if (!text || !text.trim()) return;
                state.messages.push({ type: 'user', text: text.trim(), time: timeNow() });
                render();
                setLoading(true);
                try {
                    const res = await fetch(CHAT_POST, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                        body: JSON.stringify({ message: text.trim() })
                    });
                    const data = await res.json();
                    if (data && data.success) {
                        const botMsg = { type: 'bot', text: data.message, time: timeNow() };
                        if (data.quick_links && Array.isArray(data.quick_links) && data.quick_links.length) botMsg.links = data.quick_links;
                        state.messages.push(botMsg);
                    } else {
                        state.messages.push({ type: 'bot', text: data.error || 'Sorry — something went wrong. Try again later.', time: timeNow() });
                    }
                } catch (err) {
                    console.error('Chat send error', err);
                    state.messages.push({ type: 'bot', text: 'Connection error. Please try again later.', time: timeNow() });
                } finally {
                    setLoading(false);
                    render();
                }
            }

            // initialize
            state.messages.push({ type: 'bot', text: 'Hi! 👋 I\'m the CICT AI Assistant — how can I help?', time: timeNow() });
            render();

            // ensure the button is visible and clickable
            if (btn) {
                // make sure the floating button is interactive and on top
                btn.style.setProperty('display', 'flex', 'important');
                btn.style.setProperty('z-index', '2147483647', 'important');
                btn.style.setProperty('pointer-events', 'auto', 'important');
                btn.addEventListener('click', function(e) { if (window.APP_DEBUG) console.log('CICT chat: button clicked'); e.preventDefault(); openChat(); });
            }

            if (closeBtn) closeBtn.addEventListener('click', function(e) { if (window.APP_DEBUG) console.log('CICT chat: close clicked'); e.preventDefault(); closeChat(); });

            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const v = input ? input.value : '';
                    if (!v || !v.trim()) return;
                    if (input) input.value = '';
                    sendMessage(v);
                });
            }

            // wire quick action buttons
            $all('[data-quick]', root).forEach(el => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    const key = el.getAttribute('data-quick');
                    if (key && QUICK_ROUTES[key]) window.location.href = QUICK_ROUTES[key];
                });
            });

            // keep widget on top and fixed while scrolling (already fixed by layout, ensure style)
            win.style.setProperty('position', 'fixed', 'important');
            win.style.setProperty('z-index', '2147483647', 'important');

            if (window.APP_DEBUG) console.log('CICT chat widget (vanilla) initialized');
        })();
    </script>
    
    <!-- Page Transition Script -->
    <script src="<?php echo e(asset('js/page-transitions.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/components/app-layout.blade.php ENDPATH**/ ?>