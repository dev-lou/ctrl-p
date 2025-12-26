<x-app-layout :title="'My Profile - Ctrl+P'">
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

        .profile-shell { max-width: 1200px; margin: 0 auto; padding: 120px 24px 80px; }
        .profile-hero { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px 16px; margin-bottom: 28px; }
        .profile-hero h1 { margin: 0; font-size: 32px; font-weight: 800; letter-spacing: -0.4px; color: var(--ink); }
        .profile-hero p { margin: 6px 0 0 0; color: var(--muted); max-width: 720px; line-height: 1.6; }
        .eyebrow { text-transform: uppercase; letter-spacing: 0.18em; font-size: 11px; font-weight: 700; color: var(--accent); margin: 0; }
        .meta-chip { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px; background: rgba(15,23,42,0.05); color: var(--ink); font-weight:700; font-size:12px; }

        .profile-grid { display:grid; grid-template-columns:1fr; gap:16px; }
        @media (min-width: 992px) { .profile-grid { grid-template-columns: 340px 1fr; } }

        .card { background: var(--surface); border:1px solid var(--border); border-radius:18px; box-shadow: 0 16px 48px rgba(15,23,42,0.06); padding: 20px; }
        .card.accent { background: linear-gradient(150deg, rgba(139,0,0,0.08), rgba(255,215,0,0.06)); border:1px solid rgba(139,0,0,0.1); box-shadow: 0 20px 60px rgba(139,0,0,0.1); }

        .avatar-row { display:flex; gap:18px; align-items:center; }
        .avatar-shell { width:96px; height:96px; border-radius:50%; background:#fff; border:4px solid #fff; box-shadow:0 12px 30px rgba(0,0,0,0.12); overflow:hidden; flex-shrink:0; }
        .avatar-shell img { width:100%; height:100%; object-fit:cover; display:block; }
        .avatar-placeholder { width:100%; height:100%; display:grid; place-items:center; font-size:34px; background: linear-gradient(140deg, var(--accent), var(--accent-2)); color:#fff; }
        .profile-meta h3 { margin:0; font-size:20px; font-weight:800; color: var(--ink); letter-spacing:-0.3px; }
        .profile-meta p { margin:6px 0 0 0; color: var(--muted); font-weight:600; }
        .upload-btn { margin-top:10px; padding:10px 14px; border-radius:12px; background: var(--ink); color:#fff; border:none; font-weight:700; cursor:pointer; box-shadow:0 12px 32px rgba(15,23,42,0.2); transition: transform .15s ease, box-shadow .15s ease; }
        .upload-btn:hover { transform: translateY(-1px); box-shadow:0 14px 34px rgba(15,23,42,0.24); }

        .meta-list { display:grid; gap:10px; margin-top:14px; }
        .stat-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap:12px; margin-top:18px; }
        .stat { padding:14px; border:1px solid var(--border); border-radius:14px; background:#fff; display:grid; gap:6px; transition: transform .15s ease, box-shadow .15s ease; text-decoration:none; }
        .stat:hover { transform: translateY(-2px); box-shadow:0 12px 28px rgba(15,23,42,0.08); }
        .stat-title { font-weight:700; color: var(--ink); display:flex; gap:8px; align-items:center; }
        .stat-value { font-size:26px; font-weight:800; color: var(--accent); }
        .stat-label { color: var(--muted); }

        .stack { display:flex; flex-direction:column; gap:16px; }
        .card-head { display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:12px; }
        .card-head h3 { margin:0; font-size:18px; font-weight:800; color: var(--ink); }
        .field-row { display:flex; justify-content:space-between; gap:12px; align-items:center; padding:12px 0; border-bottom:1px solid var(--border); }
        .field-row:last-child { border-bottom:none; }
        .field-label { font-weight:700; color: var(--ink); font-size:14px; }
        .field-value { color: var(--muted); font-weight:600; }
        .field-actions { display:flex; gap:8px; flex-shrink:0; }
        .pill { padding:8px 12px; border-radius:10px; border:1px solid var(--border); background:#fff; font-weight:700; cursor:pointer; }
        .pill.primary { background: linear-gradient(135deg, var(--accent), var(--accent-2)); color:#fff; border:none; box-shadow:0 12px 30px rgba(139,0,0,0.18); }
        .edit-form { margin-top:10px; display:none; }
        .edit-form input { width:100%; padding:12px; border:1px solid var(--border); border-radius:12px; font-size:15px; }

        .form-grid { display:grid; gap:14px; }
        .form-grid label { display:block; margin-bottom:6px; font-weight:700; color: var(--ink); font-size:14px; }
        .form-grid input { width:100%; padding:12px; border:1px solid var(--border); border-radius:12px; font-size:15px; }
        .input-wrap { position: relative; }
        .input-wrap input { padding-right: 46px; }
        .toggle-visibility { position:absolute; right:10px; top:50%; transform:translateY(-50%); border:none; background:rgba(15,23,42,0.06); color:var(--ink); padding:6px 10px; border-radius:10px; font-weight:700; cursor:pointer; }
        .toggle-visibility:hover { background:rgba(139,0,0,0.14); color:var(--accent); }

        .quick-links { display:flex; flex-wrap:wrap; gap:10px; }
        .quick-link { padding:10px 14px; border-radius:12px; background: rgba(15,23,42,0.05); color: var(--ink); font-weight:700; text-decoration:none; }
        .quick-link:hover { background: rgba(139,0,0,0.12); color: var(--accent); }

        @media (max-width: 768px) {
            .profile-shell { padding-top: 90px; }
            .profile-hero h1 { font-size: 26px; }
            .avatar-row { align-items:flex-start; }
            .field-row { flex-direction: column; align-items: flex-start; }
            .field-actions { width: 100%; }
            .pill { width: 100%; text-align: center; }
        }
    </style>

    @php
        $user = auth()->user();
        $rawRoles = $user->roles ?? [];
        $rolesArray = [];
        if (is_string($rawRoles)) {
            $decoded = json_decode($rawRoles, true);
            if (is_array($decoded)) {
                $rolesArray = $decoded;
            } else {
                $rolesArray = array_filter(array_map('trim', explode(',', $rawRoles)));
            }
        } elseif (is_array($rawRoles)) {
            $rolesArray = $rawRoles;
        } else {
            $rolesArray = (array) $rawRoles;
        }

        $cartItems = session()->get('cart', []);
        $cartCount = 0;
        foreach ($cartItems as $item) {
            $cartCount += $item['quantity'] ?? 1;
        }
    @endphp

    <div class="profile-shell">
        <div class="profile-hero">
            <div>
                <p class="eyebrow">Profile</p>
                <h1>Account overview</h1>
                <p>Update your personal details, keep your password secure, and jump quickly to your go-to actions.</p>
            </div>
            <div class="meta-chip">Member since {{ $user->created_at->format('M Y') }}</div>
        </div>

        <div class="profile-grid">
            <aside class="card accent">
                <div class="avatar-row">
                    <div class="avatar-shell">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
                        @else
                            <div class="avatar-placeholder">👤</div>
                        @endif
                    </div>
                    <div class="profile-meta">
                        <h3>{{ $user->name }}</h3>
                        <p>{{ $user->email }}</p>
                        <button type="button" class="upload-btn" onclick="document.getElementById('profile_picture_input').click();">Upload new photo</button>
                        <input type="file" id="profile_picture_input" accept="image/*" onchange="handleProfilePictureUpload(this)" style="display:none;">
                    </div>
                </div>

                <div class="meta-list">
                    <div class="meta-chip">Account type
                        @forelse($rolesArray as $role)
                            <span class="meta-chip" style="background: rgba(139,0,0,0.12); color: var(--accent);">{{ ucfirst($role) }}</span>
                        @empty
                            <span class="meta-chip">Standard</span>
                        @endforelse
                    </div>
                </div>

                <div class="stat-grid">
                    <a href="{{ route('account.orders') }}" class="stat">
                        <div class="stat-title"> Orders</div>
                        <div class="stat-value">{{ $user->orders()->count() }}</div>
                        <div class="stat-label">Total placed</div>
                    </a>
                    <a href="{{ route('cart.index') }}" class="stat">
                        <div class="stat-title"> Cart</div>
                        <div class="stat-value">{{ $cartCount }}</div>
                        <div class="stat-label">Items waiting</div>
                    </a>
                </div>
            </aside>

            <div class="stack">
                <section class="card">
                    <div class="card-head">
                        <div>
                            <p class="eyebrow" style="margin-bottom:4px;">Account</p>
                            <h3>Profile details</h3>
                        </div>
                    </div>

                    <div class="field-row">
                        <div>
                            <div class="field-label">Full name</div>
                            <div class="field-value" id="name-display">{{ $user->name }}</div>
                        </div>
                        <div class="field-actions">
                            <button type="button" class="pill" onclick="editField('name')">Edit</button>
                        </div>
                    </div>
                    <div id="name-edit-form" class="edit-form">
                        <form method="POST" action="{{ route('profile.update-name') }}">
                            @csrf
                            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                                <input type="text" name="name" value="{{ $user->name }}" required autocomplete="name" minlength="2">
                                <button type="submit" class="pill primary">Save</button>
                                <button type="button" class="pill" onclick="editField('name')">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <div class="field-row" style="margin-top:6px;">
                        <div>
                            <div class="field-label">Email address</div>
                            <div class="field-value" id="email-display">{{ $user->email }}</div>
                        </div>
                        <div class="field-actions">
                            <button type="button" class="pill" onclick="editField('email')">Edit</button>
                        </div>
                    </div>
                    <div id="email-edit-form" class="edit-form">
                        <form method="POST" action="{{ route('profile.update-email') }}">
                            @csrf
                            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                                <input type="email" name="email" value="{{ $user->email }}" required autocomplete="email" inputmode="email">
                                <button type="submit" class="pill primary">Save</button>
                                <button type="button" class="pill" onclick="editField('email')">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <div class="field-row" style="margin-top:6px;">
                        <div>
                            <div class="field-label">Account type</div>
                            <div class="field-value">
                                @forelse($rolesArray as $role)
                                    <span class="meta-chip" style="background: rgba(15,23,42,0.06); color:#0f172a;">{{ ucfirst($role) }}</span>
                                @empty
                                    <span class="meta-chip">Standard</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                <section class="card">
                    <div class="card-head">
                        <div>
                            <p class="eyebrow" style="margin-bottom:4px;">Security</p>
                            <h3>Change password</h3>
                        </div>
                    </div>
                    <div class="form-grid">
                        <form method="POST" action="{{ route('profile.update-password') }}" class="form-grid">
                            @csrf
                            <div>
                                <label>Current password</label>
                                <div class="input-wrap">
                                    <input type="password" name="current_password" id="current_password" required autocomplete="current-password">
                                    <button type="button" class="toggle-visibility" data-target="current_password">Show</button>
                                </div>
                                @error('current_password')
                                    <span style="color: #ff0000; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label>New password</label>
                                <div class="input-wrap">
                                    <input type="password" name="password" id="password" required autocomplete="new-password" minlength="8">
                                    <button type="button" class="toggle-visibility" data-target="password">Show</button>
                                </div>
                                @error('password')
                                    <span style="color: #ff0000; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label>Confirm password</label>
                                <div class="input-wrap">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
                                    <button type="button" class="toggle-visibility" data-target="password_confirmation">Show</button>
                                </div>
                            </div>
                            <button type="submit" class="pill primary" style="width:100%; justify-content:center; text-align:center;">Update password</button>
                        </form>
                    </div>
                </section>

                <section class="card">
                    <div class="card-head">
                        <div>
                            <p class="eyebrow" style="margin-bottom:4px;">Shortcuts</p>
                            <h3>Quick actions</h3>
                        </div>
                    </div>
                    <div class="quick-links">
                        <a href="{{ route('shop.index') }}" class="quick-link">Shop</a>
                        <a href="{{ route('account.orders') }}" class="quick-link">Orders</a>
                        <a href="{{ route('cart.index') }}" class="quick-link">Cart</a>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function editField(field) {
            const form = document.getElementById(`${field}-edit-form`);
            const display = document.getElementById(`${field}-display`);
            if (!form) return;
            const isOpen = form.style.display === 'block';
            form.style.display = isOpen ? 'none' : 'block';
            if (display) {
                display.style.display = isOpen ? 'block' : 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.toggle-visibility').forEach(btn => {
                btn.addEventListener('click', () => {
                    const target = document.getElementById(btn.dataset.target);
                    if (!target) return;
                    const isPassword = target.type === 'password';
                    target.type = isPassword ? 'text' : 'password';
                    btn.textContent = isPassword ? 'Hide' : 'Show';
                });
            });

            const flashMessage = @json(session('status') ?? session('success'));
            if (flashMessage) {
                Swal.fire({ icon: 'success', title: 'Saved', text: flashMessage, confirmButtonColor: '#8B0000' });
            }
        });

        function handleProfilePictureUpload(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            const formData = new FormData();
            formData.append('profile_picture', file);

            fetch('{{ route('profile.update-picture') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      Swal.fire({ icon: 'success', title: 'Updated', text: 'Profile photo updated successfully.', confirmButtonColor: '#8B0000' }).then(() => window.location.reload());
                  } else {
                      Swal.fire({ icon: 'error', title: 'Upload Failed', text: data.message || 'Failed to upload image. Please try again.', confirmButtonColor: '#8B0000' });
                  }
              }).catch(() => {
                  Swal.fire({ icon: 'error', title: 'Error', text: 'An error occurred while uploading your image. Please try again.', confirmButtonColor: '#8B0000' });
              });
        }
    </script>
</x-app-layout>
