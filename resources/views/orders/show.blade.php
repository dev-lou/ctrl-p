<x-app-layout :title="'Order Details - Ctrl+P'">
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

        .shell { max-width: 1100px; margin: 0 auto; padding: 120px 24px 80px; }
        .hero { display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-bottom:18px; }
        .hero h1 { margin:0; font-size:32px; font-weight:800; letter-spacing:-0.4px; color:var(--ink); }
        .hero p { margin:6px 0 0 0; color:var(--muted); max-width:640px; line-height:1.6; }
        .eyebrow { text-transform: uppercase; letter-spacing:0.18em; font-size:11px; font-weight:700; color:var(--accent); margin:0; }
        .chip { display:inline-flex; align-items:center; gap:6px; padding:8px 12px; border-radius:999px; background: rgba(15,23,42,0.06); color:var(--ink); font-weight:700; }

        .grid { display:grid; grid-template-columns:1fr; gap:14px; }
        @media(min-width: 1024px) { .grid { grid-template-columns: 2fr 1fr; } }

        .card { background: var(--surface); border:1px solid var(--border); border-radius:18px; box-shadow: 0 16px 48px rgba(15,23,42,0.06); padding:18px; }
        .section-title { margin:0 0 12px 0; font-weight:800; color:var(--ink); font-size:18px; }

        .item { display:grid; grid-template-columns:auto 1fr auto; gap:12px; padding:12px 0; border-bottom:1px solid var(--border); align-items:center; }
        .item:last-child { border-bottom:none; }
        .thumb { width:80px; height:80px; border-radius:12px; overflow:hidden; border:1px solid var(--border); background:#fff; display:grid; place-items:center; }
        .thumb img { width:100%; height:100%; object-fit:cover; }
        .placeholder { font-size:20px; color:var(--muted); }
        .item h4 { margin:0; font-weight:800; color:var(--ink); }
        .item p { margin:4px 0 0 0; color:var(--muted); font-weight:600; font-size:13px; }
        .price { font-weight:800; color:var(--accent); }
        .muted { color:var(--muted); font-weight:600; font-size:13px; }

        .meta-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); gap:10px; }
        .meta-block { padding:12px; border:1px solid var(--border); border-radius:12px; background:#fff; }
        .meta-label { color:var(--muted); font-weight:700; font-size:12px; }
        .meta-value { color:var(--ink); font-weight:800; font-size:18px; }

        .status { padding:8px 12px; border-radius:10px; font-weight:800; font-size:12px; border:1px solid transparent; }
        .status.pending { background: rgba(218,165,32,0.14); color:#a16207; border-color: rgba(218,165,32,0.3); }
        .status.completed { background: rgba(52,211,153,0.14); color:#0f766e; border-color: rgba(52,211,153,0.3); }
        .status.cancelled { background: rgba(248,113,113,0.14); color:#b91c1c; border-color: rgba(248,113,113,0.3); }

        .actions { display:flex; flex-wrap:wrap; gap:8px; margin-top:10px; }
        .btn { padding:10px 14px; border-radius:12px; border:1px solid var(--border); background:#fff; font-weight:700; cursor:pointer; text-decoration:none; color:var(--ink); }
        .btn.primary { background: linear-gradient(135deg, var(--accent), var(--accent-2)); color:#fff; border:none; box-shadow:0 12px 30px rgba(139,0,0,0.18); }
        .btn.secondary { border-color: var(--accent); color: var(--accent); }
        .btn.danger { border-color: #dc2626; color:#dc2626; }
        .btn:hover { transform: translateY(-1px); box-shadow:0 10px 24px rgba(15,23,42,0.08); }

        .summary-row { display:flex; justify-content:space-between; align-items:center; margin:10px 0; color:var(--muted); font-weight:700; }
        .summary-total { display:flex; justify-content:space-between; align-items:center; margin:14px 0; font-weight:900; color:var(--ink); font-size:20px; }

        .note { margin-top:14px; display:flex; gap:10px; align-items:flex-start; color:var(--muted); font-weight:600; font-size:13px; }
        .tag { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:10px; background: rgba(139,0,0,0.08); color: var(--accent); font-weight:700; }

        .timeline { display:grid; gap:10px; }
        .timeline-row { display:flex; gap:12px; align-items:flex-start; padding:12px; border:1px solid var(--border); border-radius:12px; background:#fff; }
        .dot { width:12px; height:12px; border-radius:50%; margin-top:4px; }
        .dot.complete { background:#22c55e; }
        .dot.pending { background:#facc15; }

        @media(max-width: 768px) { .shell { padding-top: 90px; } }
    </style>

    <div class="shell">
        <div class="hero">
            <div>
                <p class="eyebrow">Order</p>
                <h1>Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
                <p>Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}</p>
            </div>
            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                <span class="chip">Total {{ $order->items->count() }} items</span>
                <span class="status {{ $order->status === 'completed' ? 'completed' : ($order->status === 'cancelled' ? 'cancelled' : 'pending') }}">{{ ucfirst($order->status) }}</span>
            </div>
        </div>

        <div class="grid">
            <section class="card">
                <h3 class="section-title">Items</h3>
                @foreach ($order->items as $item)
                    <div class="item">
                        <div class="thumb">
                            @if(optional($item->product)->image_path)
                                <img src="{{ optional($item->product)->image_url }}" alt="{{ optional($item->product)->name ?? 'Product' }}">
                            @else
                                <div class="placeholder">📦</div>
                            @endif
                        </div>
                        <div>
                            <h4>{{ optional($item->product)->name ?? $item->product_name ?? 'Product' }}</h4>
                            @if($item->variant || $item->variant_name)
                                <p>Variant: {{ optional($item->variant)->name ?? $item->variant_name }}</p>
                            @endif
                            <p class="muted">Qty: {{ $item->quantity }}</p>
                        </div>
                        <div style="text-align:right;">
                            <div class="price">₱{{ number_format($item->unit_price, 2) }}</div>
                            <div class="muted">₱{{ number_format($item->unit_price * $item->quantity, 2) }}</div>
                        </div>
                    </div>
                @endforeach
            </section>

            <aside class="card">
                <h3 class="section-title">Summary</h3>
                <div class="summary-row"><span>Subtotal</span><span class="price">₱{{ number_format($order->subtotal, 2) }}</span></div>
                <div class="summary-total"><span>Total</span><span class="price">₱{{ number_format($order->total, 2) }}</span></div>

                <div class="actions">
                    <a class="btn primary" href="{{ route('orders.receipt.pdf', $order) }}">Receipt</a>
                    <a class="btn secondary" href="{{ route('account.orders') }}">Back to orders</a>
                    @if($order->canBeCancelled())
                        <form method="POST" action="{{ route('orders.cancel', $order) }}" onsubmit="confirmCancel(event, this);">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn danger">Cancel</button>
                        </form>
                    @endif
                </div>

                <div class="note">
                    <span class="tag">Pickup</span>
                    <div>CICT Student Council Office - Mon-Fri, 8:00 AM - 5:00 PM</div>
                </div>
            </aside>
        </div>

        <div class="card" style="margin-top:14px;">
            <h3 class="section-title">Timeline</h3>
            <div class="timeline">
                <div class="timeline-row">
                    <div class="dot complete"></div>
                    <div>
                        <div class="muted">Placed</div>
                        <div class="price" style="color:var(--ink);">{{ $order->created_at->format('M d, Y \a\t g:i A') }}</div>
                    </div>
                </div>
                @if ($order->completed_at)
                    <div class="timeline-row">
                        <div class="dot complete"></div>
                        <div>
                            <div class="muted">Completed</div>
                            <div class="price" style="color:var(--ink);">{{ $order->completed_at->format('M d, Y \a\t g:i A') }}</div>
                        </div>
                    </div>
                @else
                    <div class="timeline-row">
                        <div class="dot pending"></div>
                        <div>
                            <div class="muted">Pending completion</div>
                            <div class="price" style="color:var(--ink);">Processing</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCancel(event, form) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Cancel order?',
                text: 'This will cancel the order.',
                showCancelButton: true,
                confirmButtonColor: '#8B0000',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Cancel order'
            }).then(result => { if (result.isConfirmed) form.submit(); });
        }
    </script>
</x-app-layout>
