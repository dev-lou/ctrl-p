<x-app-layout :title="'Notifications - Ctrl+P'">
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

        .shell { max-width: 900px; margin: 0 auto; padding: 120px 20px 80px; }
        .hero { display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; align-items:flex-end; margin-bottom:18px; }
        .hero h1 { margin:0; font-size:32px; font-weight:800; color:var(--ink); }
        .hero p { margin:6px 0 0 0; color:var(--muted); line-height:1.6; }
        .eyebrow { text-transform: uppercase; letter-spacing:0.18em; font-size:11px; font-weight:700; color:var(--accent); margin:0; }

        .pill { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background:rgba(139,0,0,0.08); color:var(--accent); font-weight:800; font-size:12px; }
        .hero-actions { display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
        .btn { padding:10px 14px; border-radius:12px; border:1px solid var(--border); background:#fff; font-weight:700; cursor:pointer; color:var(--ink); text-decoration:none; }
        .btn.primary { background: linear-gradient(135deg, var(--accent), var(--accent-2)); color:#fff; border:none; box-shadow:0 10px 30px rgba(139,0,0,0.16); }
        .btn:hover { transform: translateY(-1px); box-shadow:0 8px 20px rgba(15,23,42,0.08); }

        .list { display:grid; gap:12px; }
        .card { background: var(--surface); border:1px solid var(--border); border-radius:16px; padding:16px; display:flex; gap:12px; align-items:flex-start; box-shadow:0 12px 36px rgba(15,23,42,0.05); }
        .card.unread { border-left:4px solid var(--accent); background: #fff9f5; }
        .icon { width:46px; height:46px; border-radius:12px; display:grid; place-items:center; font-size:22px; font-weight:700; }
        .content h3 { margin:0 0 6px 0; font-size:16px; font-weight:800; color:var(--ink); }
        .content p { margin:0 0 8px 0; color:var(--muted); font-size:14px; line-height:1.6; }
        .meta { display:flex; gap:14px; align-items:center; flex-wrap:wrap; font-size:13px; color:var(--muted); font-weight:600; }
        .meta a { color:var(--accent); font-weight:700; }
        .actions { margin-left:auto; display:flex; gap:8px; align-items:center; }
        .mini { padding:8px 10px; border-radius:10px; border:1px solid var(--border); background:#fff; font-weight:700; font-size:12px; cursor:pointer; color:var(--ink); }
        .mini:hover { border-color: var(--accent); color: var(--accent); }

        .empty { text-align:center; padding:50px 20px; border:1px dashed var(--border); border-radius:16px; background:#fff; color:var(--muted); }
        .empty h3 { margin:10px 0 6px 0; font-size:18px; font-weight:800; color:var(--ink); }

        @media(max-width: 640px) {
            .card { flex-direction:column; }
            .actions { width:100%; justify-content:flex-start; }
        }
    </style>

    <div class="shell">
        @php $unreadCount = $notifications->where('is_read', false)->count(); @endphp
        <div class="hero">
            <div>
                <p class="eyebrow">Inbox</p>
                <h1>Notifications</h1>
                <p>Order updates, status changes, and reminders live here.</p>
            </div>
            <div class="hero-actions">
                <span class="pill">Unread {{ $unreadCount }}</span>
                @if($unreadCount > 0)
                    <button class="btn primary" onclick="markAllAsRead()">Mark all as read</button>
                @endif
            </div>
        </div>

        <div class="list">
            @forelse($notifications as $notification)
                @php
                    $icon = '🔔';
                    $tint = '#e0f2fe';
                    if ($notification->type === 'order_completed') {
                        $icon = '✅';
                        $tint = '#dcfce7';
                    } elseif ($notification->type === 'order_status_changed') {
                        $icon = '🔄';
                        $tint = '#fef9c3';
                    }
                @endphp
                <article class="card {{ $notification->is_read ? 'read' : 'unread' }}">
                    <div class="icon" style="background: {{ $tint }};">{{ $icon }}</div>
                    <div class="content">
                        <h3>{{ $notification->title }}</h3>
                        <p>{{ $notification->message }}</p>
                        <div class="meta">
                            <span>{{ $notification->created_at->diffForHumans() }}</span>
                            @if($notification->data && isset($notification->data['order_id']))
                                <a href="{{ route('orders.show', $notification->data['order_id']) }}">View order</a>
                            @endif
                        </div>
                    </div>
                    <div class="actions">
                        @if(!$notification->is_read)
                            <button class="mini" onclick="markAsRead({{ $notification->id }}, this)">Mark read</button>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty">
                    <div style="font-size:48px;">🔕</div>
                    <h3>Nothing new</h3>
                    <p>We will let you know when there are updates.</p>
                </div>
            @endforelse
        </div>

        @if($notifications->hasPages())
            <div style="margin-top:16px;">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        function markAsRead(notificationId, button) {
            if (button) { button.disabled = true; }
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => response.json())
            .then(data => { if (data.success) location.reload(); })
            .catch(() => { if (button) { button.disabled = false; } });
        }

        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => response.json())
            .then(data => { if (data.success) location.reload(); });
        }
    </script>
</x-app-layout>
