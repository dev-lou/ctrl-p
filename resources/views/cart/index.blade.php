<x-app-layout :title="'Cart - Ctrl+P'">
    <style>
        :root {
            --ink: #0f172a;
            --muted: #475569;
            --surface: #ffffff;
            --border: rgba(15,23,42,0.08);
            --accent: #8B0000;
            --accent-2: #A00000;
            --bg: #f8fafc;
        }

        body { background: var(--bg) !important; }

        .cart-shell { max-width: 1200px; margin: 0 auto; padding: 120px 24px 80px; }
        .cart-hero { display:flex; justify-content:space-between; gap:16px; flex-wrap:wrap; margin-bottom:24px; }
        .cart-hero h1 { margin:0; font-size:32px; font-weight:800; letter-spacing:-0.4px; color:var(--ink); }
        .cart-hero p { margin:6px 0 0 0; color:var(--muted); max-width:640px; line-height:1.6; }
        .eyebrow { text-transform: uppercase; letter-spacing: 0.18em; font-size: 11px; font-weight: 700; color: var(--accent); margin: 0; }
        .chip { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background: rgba(15,23,42,0.06); font-weight:700; color:var(--ink); }
        .pill-link { display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:12px; text-decoration:none; font-weight:700; border:1px solid var(--border); color:var(--ink); background:#fff; }
        .pill-link:hover { border-color: var(--accent); color: var(--accent); }

        .cart-grid { display:grid; grid-template-columns:1fr; gap:16px; }
        @media(min-width: 992px) { .cart-grid { grid-template-columns: 2fr 1fr; } }

        .card { background: var(--surface); border:1px solid var(--border); border-radius:18px; box-shadow: 0 16px 48px rgba(15,23,42,0.06); }
        .card.pad { padding:18px; }

        .item { display:grid; grid-template-columns: auto 1fr; gap:14px; padding:14px; border-bottom:1px solid var(--border); align-items:center; }
        .item:last-child { border-bottom:none; }
        .thumb { width:96px; height:96px; border-radius:12px; overflow:hidden; background:#fff; border:1px solid var(--border); display:grid; place-items:center; }
        .thumb img { width:100%; height:100%; object-fit:cover; }
        .placeholder { font-size:20px; color:var(--muted); }
        .item-head h3 { margin:0; font-size:17px; font-weight:800; color:var(--ink); }
        .item-head p { margin:4px 0 0 0; color:var(--muted); font-weight:600; font-size:13px; }
        .meta-row { display:flex; justify-content:space-between; align-items:center; gap:12px; margin-top:10px; flex-wrap:wrap; }
        .qty { display:inline-flex; align-items:center; gap:4px; border:1px solid var(--border); border-radius:12px; padding:6px; background:#fff; }
        .qty button { border:none; background: rgba(15,23,42,0.05); padding:8px 10px; border-radius:10px; font-weight:800; cursor:pointer; color:var(--ink); }
        .qty button:hover { background: rgba(139,0,0,0.14); color: var(--accent); }
        .qty input { width:52px; text-align:center; border:none; background:transparent; font-weight:700; color:var(--ink); }
        .price { font-weight:800; color:var(--accent); }
        .subtle { color:var(--muted); font-weight:600; font-size:13px; }
        .remove { border:none; background: rgba(139,0,0,0.08); color: var(--accent); padding:10px 12px; border-radius:10px; font-weight:700; cursor:pointer; }
        .remove:hover { background: rgba(139,0,0,0.16); }

        .summary h3 { margin:0 0 6px 0; font-weight:800; color:var(--ink); }
        .summary-row { display:flex; justify-content:space-between; align-items:center; margin:10px 0; color:var(--muted); font-weight:700; }
        .summary-total { display:flex; justify-content:space-between; align-items:center; margin:14px 0; font-weight:900; color:var(--ink); font-size:20px; }
        .primary-btn { width:100%; padding:14px; border-radius:12px; border:none; background: linear-gradient(135deg, var(--accent), var(--accent-2)); color:#fff; font-weight:800; cursor:pointer; box-shadow:0 14px 36px rgba(139,0,0,0.2); }
        .primary-btn:hover { transform: translateY(-1px); box-shadow:0 16px 40px rgba(139,0,0,0.25); }
        .ghost-btn { width:100%; padding:12px; border-radius:12px; border:1px solid var(--border); background:#fff; font-weight:700; cursor:pointer; color:var(--ink); }
        .ghost-btn:hover { border-color: var(--accent); color: var(--accent); }

        .note { margin-top:14px; display:flex; gap:10px; align-items:flex-start; color:var(--muted); font-weight:600; font-size:13px; }
        .tag { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:10px; background: rgba(139,0,0,0.08); color: var(--accent); font-weight:700; }

        .empty { text-align:center; padding:80px 24px; }
        .empty h2 { margin:12px 0 8px; font-size:28px; font-weight:900; color:var(--ink); }
        .empty p { margin:0 0 16px 0; color:var(--muted); font-weight:600; }

        @media(max-width: 768px) {
            .cart-shell { padding-top: 90px; }
            .item { grid-template-columns: 1fr; }
            .thumb { width:100%; height:180px; }
            .meta-row { align-items:flex-start; }
            .cart-grid { gap:12px; }
        }
    </style>

    @php
        $totalQty = 0;
        foreach ($items as $it) { $totalQty += $it['quantity'] ?? 1; }
    @endphp

    <div class="cart-shell">
        <div class="cart-hero">
            <div>
                <p class="eyebrow">Cart</p>
                <h1>Your bag</h1>
                <p>Review your picks, tweak quantities, and checkout fast. Pickup at the Council office.</p>
            </div>
            <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                <span class="chip">{{ $totalQty }} {{ $totalQty === 1 ? 'item' : 'items' }}</span>
                <a href="{{ route('shop.index') }}" class="pill-link">← Continue shopping</a>
            </div>
        </div>

        @if(session('success'))
            <div class="card pad" style="border-color: rgba(56,189,248,0.3); background: rgba(56,189,248,0.08); color:#0ea5e9; font-weight:700;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="card pad" style="border-color: rgba(248,113,113,0.4); background: rgba(248,113,113,0.1); color:#dc2626; font-weight:700;">
                {{ session('error') }}
            </div>
        @endif

        @if(count($items) > 0)
            <div class="cart-grid">
                <section class="card">
                    @foreach($items as $item)
                        <div class="item" data-key="{{ $item['key'] }}">
                            <div class="thumb">
                                @if($item['product']->image_path)
                                    <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}">
                                @else
                                    <div class="placeholder"></div>
                                @endif
                            </div>
                            <div>
                                <div class="item-head">
                                    <h3><a href="{{ route('shop.show', $item['product']) }}" style="color:inherit; text-decoration:none;">{{ $item['product']->name }}</a></h3>
                                    @if($item['variant'])
                                        <p>Variant: {{ $item['variant']->name }}</p>
                                    @endif
                                </div>
                                <div class="meta-row">
                                    <span class="subtle">₱{{ number_format($item['price'], 2) }} each</span>
                                    <div class="qty" aria-label="Quantity">
                                        <button type="button" onclick="changeQty('{{ $item['key'] }}', -1)">-</button>
                                        <input type="number" min="1" value="{{ $item['quantity'] }}" readonly class="qty-input" data-qty="{{ $item['key'] }}">
                                        <button type="button" onclick="changeQty('{{ $item['key'] }}', 1)">+</button>
                                    </div>
                                    <span class="price" data-subtotal="{{ $item['key'] }}">₱{{ number_format($item['total'], 2) }}</span>
                                    <form id="remove-form-{{ $item['key'] }}" action="{{ route('cart.destroy', $item['key']) }}" method="POST" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="remove" onclick="confirmRemove('{{ $item['key'] }}')">Remove</button>
                                    </form>
                                    <input type="hidden" class="price-value" data-price-key="{{ $item['key'] }}" value="{{ $item['price'] }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>

                <aside class="card pad summary">
                    <h3>Order summary</h3>
                    <div class="summary-row"><span>Subtotal</span><span class="price" data-summary-subtotal>{{ number_format($subtotal, 2) }}</span></div>
                    <div class="summary-total"><span>Total</span><span class="price" data-summary-total>{{ number_format($total, 2) }}</span></div>

                    @auth
                        <button class="primary-btn" onclick="window.location='{{ route('checkout.index') }}'">Proceed to checkout</button>
                    @else
                        <a href="{{ route('login') }}" class="primary-btn" style="display:inline-flex; justify-content:center; text-decoration:none;">Sign in to checkout</a>
                    @endauth

                    <button class="ghost-btn" style="margin-top:10px;" onclick="window.location='{{ route('shop.index') }}'">Add more items</button>

                        <div class="note">
                        <span class="tag">Pickup</span>
                        <div>CICT Student Council Office · Mon–Fri, 8:00 AM – 5:00 PM</div>
                    </div>
                </aside>
            </div>
        @else
            <div class="card pad empty">
                <div style="font-size:40px;">🛒</div>
                <h2>Your cart is empty</h2>
                <p>Find something you like and it will show up here.</p>
                <a class="primary-btn" style="display:inline-block; text-decoration:none; width:auto; padding-inline:18px;" href="{{ route('shop.index') }}">Start shopping</a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function changeQty(key, delta) {
            const input = document.querySelector(`[data-qty="${key}"]`);
            if (!input) return;
            let next = parseInt(input.value, 10) + delta;
            if (next < 1) return;
            input.value = next;
            persistQty(key, next);
            updateSubtotal(key, next);
        }

        function persistQty(key, qty) {
            fetch(`/cart/${key}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: qty })
            }).catch(() => {});
        }

        function updateSubtotal(key, qty) {
            const priceEl = document.querySelector(`[data-price-key="${key}"]`);
            const subtotalEl = document.querySelector(`[data-subtotal="${key}"]`);
            if (!priceEl || !subtotalEl) return;
            const price = parseFloat(priceEl.value || 0);
            const subtotal = price * qty;
            subtotalEl.textContent = `₱${subtotal.toFixed(2)}`;
            recalcTotals();
        }

        function recalcTotals() {
            let subtotal = 0;
            document.querySelectorAll('[data-subtotal]').forEach(el => {
                const val = parseFloat(el.textContent.replace('₱',''));
                subtotal += isNaN(val) ? 0 : val;
            });
            const subtotalTarget = document.querySelector('[data-summary-subtotal]');
            const totalTarget = document.querySelector('[data-summary-total]');
            if (subtotalTarget) subtotalTarget.textContent = `₱${subtotal.toFixed(2)}`;
            if (totalTarget) totalTarget.textContent = `₱${subtotal.toFixed(2)}`;
        }

        function confirmRemove(key) {
            Swal.fire({
                icon: 'question',
                title: 'Remove item?',
                text: 'This will remove the item from your cart.',
                showCancelButton: true,
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Remove',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    document.getElementById(`remove-form-${key}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
