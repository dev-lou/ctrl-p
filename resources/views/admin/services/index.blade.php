<x-admin-layout>
    @section('page-title', 'Services Manager')

    @php
        $categories = $services
            ->map(function ($svc) {
                return [
                    'name' => $svc->category ?: 'General',
                    'description' => $svc->category_description,
                ];
            })
            ->unique('name')
            ->values();

        if ($categories->where('name', 'General')->isEmpty()) {
            $categories->push(['name' => 'General', 'description' => null]);
        }
    @endphp

    <style>
        /* Admin palette */
        :root {
            --bg-main: linear-gradient(135deg, #0f0f1e 0%, #1a1a3e 50%, #0f0f1e 100%);
            --bg-card: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%);
            --border: #2a3f5f;
            --blue: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%);
            --cyan: #00d9ff;
            --text: #b0bcc4;
            --white: #ffffff;
            --success: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
            --danger: linear-gradient(135deg, #ff6b6b 0%, #cc0000 100%);
        }

        .page-shell {
            background: var(--bg-main);
            border: 2px solid var(--border);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.35);
        }

        .stats-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(15, 111, 221, 0.12);
            border: 1px solid rgba(0, 217, 255, 0.35);
            color: var(--white);
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 20px;
        }

        .service-card {
            background: var(--bg-card);
            border: 2px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.25s ease;
            position: relative;
        }

        .service-card:hover {
            border-color: var(--cyan);
            box-shadow: 0 14px 32px rgba(15, 111, 221, 0.35);
            transform: translateY(-3px);
        }

        .service-card.inactive { opacity: 0.55; }

        .service-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            background: rgba(15, 111, 221, 0.08);
        }

        .service-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: var(--blue);
            display: grid;
            place-items: center;
            font-size: 26px;
            color: var(--white);
            border: 2px solid var(--cyan);
            box-shadow: 0 8px 16px rgba(15, 111, 221, 0.4);
        }

        .service-body {
            padding: 18px 20px 12px;
            color: var(--text);
            font-size: 14px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .meta-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 10px;
            background: rgba(0, 217, 255, 0.12);
            border: 1px solid rgba(0, 217, 255, 0.25);
            color: var(--white);
            font-weight: 600;
            font-size: 12px;
        }

        .price-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 10px;
            background: rgba(76, 175, 80, 0.12);
            border: 1px solid rgba(76, 175, 80, 0.35);
            color: #9ef6a7;
            font-weight: 700;
        }

        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 8px;
            padding: 16px;
            border-top: 1px solid var(--border);
            background: rgba(0, 0, 0, 0.2);
        }

        .btn-ghost {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
            color: var(--white);
            background: transparent;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .btn-ghost:hover { border-color: var(--cyan); color: var(--white); }

        .toggle {
            width: 50px;
            height: 26px;
            border-radius: 20px;
            background: #3a4b68;
            position: relative;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .toggle::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 2px;
            left: 3px;
            border-radius: 50%;
            background: var(--white);
            transition: all 0.2s ease;
        }
        .toggle.active {
            background: var(--success);
            border-color: rgba(76, 175, 80, 0.6);
        }
        .toggle.active::after { left: 26px; }

        /* Officers */
        .officer-card {
            background: var(--bg-card);
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.2s ease;
        }
        .officer-card:hover { border-color: var(--cyan); box-shadow: 0 10px 24px rgba(0, 0, 0, 0.35); }
        .avatar {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: var(--blue);
            border: 2px solid var(--cyan);
            color: var(--white);
            font-weight: 800;
            display: grid;
            place-items: center;
            font-size: 18px;
        }

        /* Modals */
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.75); display: none; align-items: center; justify-content: center; padding: 20px; z-index: 50; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: var(--bg-card); border: 2px solid var(--cyan); border-radius: 16px; width: 100%; max-width: 620px; max-height: 90vh; overflow: auto; box-shadow: 0 14px 40px rgba(0,0,0,0.4); }
        .modal-header { padding: 18px 20px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; color: var(--white); }
        .modal-body { padding: 18px 20px; color: var(--white); }
        .modal-footer { padding: 16px 20px; border-top: 1px solid var(--border); display: flex; gap: 10px; justify-content: flex-end; }
        .input {
            width: 100%;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 14px;
            color: var(--white);
        }
        .input:focus { outline: none; border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(0,217,255,0.15); }
        .label { font-weight: 700; color: var(--text); margin-bottom: 6px; display: block; font-size: 13px; }
        .btn-primary { background: var(--blue); color: var(--white); border: 0; border-radius: 10px; padding: 12px 16px; font-weight: 800; }
        .btn-secondary { background: rgba(255,255,255,0.05); color: var(--text); border: 1px solid var(--border); border-radius: 10px; padding: 12px 16px; font-weight: 700; }

        .icon-grid { display: grid; grid-template-columns: repeat(8, 1fr); gap: 8px; }
        .icon-pick { border: 1px solid var(--border); border-radius: 10px; padding: 8px; text-align: center; cursor: pointer; }
        .icon-pick.selected { border-color: var(--cyan); background: rgba(0,217,255,0.15); }

        .helper-text { color: var(--text); font-size: 12px; margin-top: 6px; }

        .toast { position: fixed; bottom: 24px; right: 24px; padding: 14px 18px; border-radius: 12px; color: #fff; font-weight: 700; z-index: 60; box-shadow: 0 10px 30px rgba(0,0,0,0.35); }
    </style>

    <div class="page-shell">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div>
                <h1 style="color: var(--white); font-size: 26px; font-weight: 900; letter-spacing: 0.5px;">Services Manager</h1>
                <p style="color: var(--text);">Manage services, paper sizes, and printing officers.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="stats-pill">📦 Total: {{ $stats['total_services'] }}</span>
                <span class="stats-pill">✅ Active: {{ $stats['active_services'] }}</span>
                <span class="stats-pill">👥 Officers: {{ $stats['total_officers'] }}</span>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 mb-6">
            <button class="btn-primary" onclick="openServiceModal()">➕ Add Service</button>
            <button class="btn-secondary" onclick="openOfficerModal()">👤 Add Officer</button>
            <a href="{{ route('services.index') }}" target="_blank" class="btn-secondary" style="text-decoration: none;">🔍 View Customer Page</a>
        </div>

        <h2 style="color: var(--white); font-weight: 800; margin-bottom: 10px;">Services</h2>
        <div class="services-grid" id="servicesGrid" style="margin-bottom: 28px;">
            @forelse($services as $service)
                <div class="service-card {{ $service->is_active ? '' : 'inactive' }}" data-id="{{ $service->id }}">
                    <div class="service-head">
                        <div class="flex items-center gap-3">
                            <div class="service-icon">{{ $service->icon ?? '🖨️' }}</div>
                            <div>
                                <div style="color: var(--white); font-weight: 800; font-size: 16px;">{{ $service->title }}</div>
                                <div class="meta-badge">{{ strtoupper($service->category) }}</div>
                            </div>
                        </div>
                        <div class="toggle {{ $service->is_active ? 'active' : '' }}" onclick="toggleService({{ $service->id }})"></div>
                    </div>
                    <div class="service-body">
                        <p style="margin-bottom: 6px;">{{ \Illuminate\Support\Str::limit($service->description, 140) }}</p>
                        <div class="flex flex-wrap gap-2">
                            @php $displayPrice = $service->price_bw ?? $service->price_color; @endphp
                            @if($displayPrice)
                                <span class="price-chip">₱{{ number_format($displayPrice, 2) }}</span>
                            @endif
                            @if($service->price_label)
                                <span class="meta-badge">{{ $service->price_label }}</span>
                            @endif
                            @if($service->options->count())
                                <span class="meta-badge">📄 {{ $service->options->count() }} options</span>
                            @endif
                        </div>
                    </div>
                    <div class="actions">
                        <button class="btn-ghost" onclick="editService({{ $service->id }})">✏️ Edit</button>
                        <button class="btn-ghost" onclick="manageOptions({{ $service->id }})">📄 Options</button>
                        <button class="btn-ghost" style="border-color: rgba(255,107,107,0.5); color: #ffb3b3;" onclick="deleteService({{ $service->id }})">🗑 Delete</button>
                    </div>
                </div>
            @empty
                <div style="color: var(--text);">No services found.</div>
            @endforelse
        </div>

        <div class="mt-10 mb-4 flex items-center justify-between">
            <h2 style="color: var(--white); font-weight: 800;">Printing Officers</h2>
            <button class="btn-secondary" onclick="openOfficerModal()">+ Add Officer</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
            @forelse($officers as $officer)
                <div class="officer-card" data-id="{{ $officer->id }}">
                    <div class="avatar">{{ $officer->initials }}</div>
                    <div class="flex-1 min-w-0">
                        <div style="color: var(--white); font-weight: 800;">{{ $officer->name }}</div>
                        <div style="color: var(--text); font-size: 12px;">{{ $officer->title ?? 'PRINTING OFFICER' }}</div>
                        @if($officer->messenger_url)
                            <a href="{{ $officer->messenger_url }}" target="_blank" style="color: var(--cyan); font-size: 12px;">Messenger</a>
                        @endif
                    </div>
                    <div class="flex gap-2">
                        <button class="btn-ghost" onclick="editOfficer({{ $officer->id }})">✏️</button>
                        <button class="btn-ghost" style="border-color: rgba(255,107,107,0.5); color: #ffb3b3;" onclick="deleteOfficer({{ $officer->id }})">🗑</button>
                    </div>
                </div>
            @empty
                <div style="color: var(--text);">No officers yet.</div>
            @endforelse
        </div>
    </div>

    <!-- Service Modal -->
    <div class="modal-overlay" id="serviceModal">
        <div class="modal-card">
            <div class="modal-header">
                <div id="serviceModalTitle">Add Service</div>
                <button class="btn-ghost" onclick="closeServiceModal()">✕</button>
            </div>
            <form id="serviceForm" onsubmit="submitService(event)">
                @csrf
                <input type="hidden" id="serviceId">
                <div class="modal-body">
                    <label class="label">Icon</label>
                    <input type="hidden" id="serviceIcon" value="🖨️">
                    <div class="icon-grid mb-4">
                        @foreach(['🖨️','🎨','📄','📦','🧾','✂️','🖼️','📐','💡','⚙️','🧵','🛠️','🎁','📊','🧮','🪄'] as $emoji)
                            <div class="icon-pick" data-icon="{{ $emoji }}" onclick="pickIcon('{{ $emoji }}')">{{ $emoji }}</div>
                        @endforeach
                    </div>
                    <div class="helper-text">Choose a simple emoji that matches the service so admins and customers can identify it quickly.</div>

                    <label class="label">Title</label>
                    <input class="input mb-1" id="serviceTitle" placeholder="Ex: Color Printing, Laptop Repair" required>
                    <div class="helper-text">Keep it short and action-oriented. This is the name shown on the customer page.</div>

                    <label class="label">Description</label>
                    <textarea class="input mb-1" id="serviceDescription" rows="3" placeholder="Ex: Vibrant full-color prints for presentations and projects." required></textarea>
                    <div class="helper-text">One or two sentences is enough. Focus on what the service does and who it helps.</div>

                    <div>
                        <label class="label">Price (₱)</label>
                        <input class="input" type="number" step="0.01" id="servicePriceBw" placeholder="Optional">
                    </div>
                    <div class="helper-text">Leave empty for free or on-request services.</div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="label">Price Label</label>
                            <input class="input" id="servicePriceLabel" placeholder="per page, per set, starting rate">
                            <div class="helper-text">Short note that appears beside the price.</div>
                        </div>
                        <div>
                            <label class="label">Category</label>
                            <select class="input" id="serviceCategorySelect" onchange="handleCategoryChange()">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat['name'] }}">{{ $cat['name'] }}</option>
                                @endforeach
                                <option value="__new__">➕ Create new category</option>
                            </select>
                            <div class="helper-text">Choose an existing category or add a new one.</div>
                        </div>
                    </div>

                    <div id="categoryNameGroup" class="mt-3" style="display:none;">
                        <label class="label">New Category Name</label>
                        <input class="input" id="serviceCategory" placeholder="Ex: Document Processing, IT Support" />
                    </div>

                    <div id="categoryDescriptionGroup" class="mt-3">
                        <label class="label">Category Description</label>
                        <textarea class="input" id="serviceCategoryDescription" rows="2" placeholder="Short blurb shown with this category."></textarea>
                        <div class="helper-text">Admins can edit this for existing categories or set it when creating a new one.</div>
                    </div>

                    <div class="flex items-center gap-4 mt-3">
                        <label class="flex items-center gap-2 text-sm" style="color: var(--text);">
                            <input type="checkbox" id="serviceActive" checked> Active
                        </label>
                        <div class="helper-text">Turn off to hide the service from customers without deleting it.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeServiceModal()">Cancel</button>
                    <button type="submit" class="btn-primary" id="serviceSubmitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Options Modal -->
    <div class="modal-overlay" id="optionsModal">
        <div class="modal-card" style="max-width: 720px;">
            <div class="modal-header">
                <div>Manage Options</div>
                <button class="btn-ghost" onclick="closeOptionsModal()">✕</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="currentServiceId">
                <div id="optionsList" class="space-y-2 mb-4"></div>

                <form style="border-top: 1px solid var(--border); padding-top: 12px;" onsubmit="submitOption(event)">
                    @csrf
                    <input type="hidden" id="optId">
                    <h4 style="color: var(--white); font-weight: 800;" id="optFormTitle">Add Option</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="label">Name</label>
                            <input class="input" id="optName" required>
                        </div>
                        <div>
                            <label class="label">Details (optional)</label>
                            <input class="input" id="optDimensions" placeholder="e.g. Duration, size, or variant note">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="label">Price</label>
                            <input class="input" type="number" step="0.01" id="optPriceBw" placeholder="Optional">
                        </div>
                        <div>
                            <label class="label">Secondary price (optional)</label>
                            <input class="input" type="number" step="0.01" id="optPriceColor" placeholder="Optional">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="label">Price label</label>
                            <input class="input" id="optPriceBwLabel" placeholder="e.g. B/W, Standard, Base">
                        </div>
                        <div>
                            <label class="label">Secondary label</label>
                            <input class="input" id="optPriceColorLabel" placeholder="e.g. Colored, Premium">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="label">Badge</label>
                            <input class="input" id="optBadge" placeholder="Featured, Most Popular">
                        </div>
                        <div>
                            <label class="label">Card size</label>
                            <select class="input" id="optSizeClass">
                                <option value="short">Compact</option>
                                <option value="standard" selected>Standard</option>
                                <option value="long">Tall</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center gap-3">
                        <label class="flex items-center gap-2 text-sm" style="color: var(--text);">
                            <input type="checkbox" id="optActive" checked> Active
                        </label>
                        <div class="helper-text">If you need to pause a size, turn it off instead of deleting.</div>
                    </div>
                    <div class="flex gap-2 mt-3">
                        <button type="submit" class="btn-primary" id="optSubmitBtn">Save Option</button>
                        <button type="button" class="btn-secondary" onclick="resetOptionForm()">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Officer Modal -->
    <div class="modal-overlay" id="officerModal">
        <div class="modal-card">
            <div class="modal-header">
                <div id="officerModalTitle">Add Officer</div>
                <button class="btn-ghost" onclick="closeOfficerModal()">✕</button>
            </div>
            <form id="officerForm" onsubmit="submitOfficer(event)">
                @csrf
                <input type="hidden" id="officerId">
                <div class="modal-body">
                    <label class="label">Name</label>
                    <input class="input mb-3" id="officerName" required>

                    <label class="label">Title</label>
                    <input class="input mb-3" id="officerTitle" placeholder="PRINTING OFFICER">

                    <label class="label">Messenger URL</label>
                    <input class="input mb-3" id="officerMessenger" placeholder="https://www.messenger.com/...">

                    <label class="flex items-center gap-2 text-sm" style="color: var(--text);">
                        <input type="checkbox" id="officerActive" checked> Active
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeOfficerModal()">Cancel</button>
                    <button type="submit" class="btn-primary" id="officerSubmitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const servicesData = @json($services);
        const categoryMeta = @json($categories->keyBy('name'));
        const officersData = @json($officers);

        function showToast(msg, type = 'info') {
            const el = document.createElement('div');
            el.className = 'toast';
            el.textContent = msg;
            if (type === 'success') el.style.background = 'var(--success)';
            else if (type === 'error') el.style.background = 'var(--danger)';
            else el.style.background = 'var(--blue)';
            document.body.appendChild(el);
            setTimeout(() => { el.style.opacity = '0'; el.style.transform = 'translateY(10px)'; }, 2500);
            setTimeout(() => el.remove(), 3200);
        }

        // ---------- Service Modal ----------
        function openServiceModal() {
            document.getElementById('serviceModal').classList.add('active');
            document.getElementById('serviceModalTitle').textContent = 'Add Service';
            document.getElementById('serviceSubmitBtn').textContent = 'Create';
            document.getElementById('serviceForm').reset();
            document.getElementById('serviceId').value = '';
            document.getElementById('serviceIcon').value = '🖨️';
            document.querySelectorAll('.icon-pick').forEach(el => el.classList.remove('selected'));
            const categorySelect = document.getElementById('serviceCategorySelect');
            categorySelect.value = categorySelect.options[0]?.value || 'General';
            document.getElementById('serviceCategory').value = '';
            document.getElementById('serviceCategoryDescription').value = categoryMeta[categorySelect.value]?.description || '';
            handleCategoryChange();
        }
        function closeServiceModal() { document.getElementById('serviceModal').classList.remove('active'); }

        function pickIcon(icon) {
            document.getElementById('serviceIcon').value = icon;
            document.querySelectorAll('.icon-pick').forEach(el => el.classList.toggle('selected', el.dataset.icon === icon));
        }

        function editService(id) {
            const svc = servicesData.find(s => s.id === id);
            if (!svc) return;
            openServiceModal();
            document.getElementById('serviceModalTitle').textContent = 'Edit Service';
            document.getElementById('serviceSubmitBtn').textContent = 'Update';
            document.getElementById('serviceId').value = svc.id;
            document.getElementById('serviceTitle').value = svc.title;
            document.getElementById('serviceDescription').value = svc.description;
            document.getElementById('servicePriceBw').value = svc.price_bw || '';
            document.getElementById('servicePriceLabel').value = svc.price_label || '';
            document.getElementById('serviceActive').checked = !!svc.is_active;
            pickIcon(svc.icon || '🖨️');

            const categorySelect = document.getElementById('serviceCategorySelect');
            const currentCategory = svc.category || 'General';
            if ([...categorySelect.options].some(o => o.value === currentCategory)) {
                categorySelect.value = currentCategory;
            } else {
                const opt = document.createElement('option');
                opt.value = currentCategory;
                opt.textContent = currentCategory;
                categorySelect.prepend(opt);
                categorySelect.value = currentCategory;
            }
            document.getElementById('serviceCategory').value = '';
            document.getElementById('serviceCategoryDescription').value = svc.category_description || categoryMeta[currentCategory]?.description || '';
            handleCategoryChange(true);
        }

        function handleCategoryChange(isEdit = false) {
            const select = document.getElementById('serviceCategorySelect');
            const nameGroup = document.getElementById('categoryNameGroup');
            const nameInput = document.getElementById('serviceCategory');
            const descInput = document.getElementById('serviceCategoryDescription');
            const value = select.value;
            const isNew = value === '__new__';
            nameGroup.style.display = isNew ? 'block' : 'none';

            if (!isNew) {
                nameInput.value = '';
                descInput.value = categoryMeta[value]?.description || '';
            } else if (!isEdit) {
                nameInput.value = '';
                descInput.value = '';
            }
        }

        async function submitService(e) {
            e.preventDefault();
            const id = document.getElementById('serviceId').value;
            const isEdit = !!id;
            const selectedCategory = document.getElementById('serviceCategorySelect').value;
            const categoryNameInput = document.getElementById('serviceCategory').value.trim();
            const resolvedCategory = selectedCategory === '__new__' ? categoryNameInput : selectedCategory;
            if (!resolvedCategory) { showToast('Category name is required', 'error'); return; }
            const payload = {
                title: document.getElementById('serviceTitle').value,
                description: document.getElementById('serviceDescription').value,
                icon: document.getElementById('serviceIcon').value,
                price_bw: document.getElementById('servicePriceBw').value || null,
                price_label: document.getElementById('servicePriceLabel').value,
                category: resolvedCategory,
                category_description: document.getElementById('serviceCategoryDescription').value,
                is_active: document.getElementById('serviceActive').checked,
            };
            const url = isEdit ? `/admin/services-management/${id}` : '/admin/services-management';
            const method = isEdit ? 'PATCH' : 'POST';
            try {
                const res = await fetch(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success) {
                    showToast(data.message, 'success');
                    closeServiceModal();
                    setTimeout(() => location.reload(), 700);
                } else {
                    showToast('Failed to save service', 'error');
                }
            } catch (err) {
                showToast('Error saving service', 'error');
            }
        }

        async function deleteService(id) {
            if (!confirm('Delete this service?')) return;
            try {
                const res = await fetch(`/admin/services-management/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); setTimeout(() => location.reload(), 400); }
                else showToast('Delete failed', 'error');
            } catch { showToast('Delete failed', 'error'); }
        }

        async function toggleService(id) {
            try {
                const res = await fetch(`/admin/services-management/${id}/toggle`, {
                    method: 'PATCH',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); setTimeout(() => location.reload(), 300); }
            } catch { showToast('Toggle failed', 'error'); }
        }

        // ---------- Options ----------
        function manageOptions(serviceId) {
            const svc = servicesData.find(s => s.id === serviceId);
            if (!svc) return;
            document.getElementById('currentServiceId').value = serviceId;
            window.currentOptions = svc.options || [];
            resetOptionForm();
            renderOptions(window.currentOptions);
            document.getElementById('optionsModal').classList.add('active');
        }
        function closeOptionsModal() { document.getElementById('optionsModal').classList.remove('active'); }

        function renderOptions(options) {
            const list = document.getElementById('optionsList');
            if (!options.length) {
                list.innerHTML = '<div style="color: var(--text);">No options yet.</div>';
                return;
            }
            list.innerHTML = options.map(opt => `
                <div style="border:1px solid var(--border); border-radius:10px; padding:10px; display:flex; align-items:center; justify-content:space-between; gap:10px;">
                    <div>
                        <div style="color: var(--white); font-weight:800;">${opt.name}</div>
                        <div style="color: var(--text); font-size:12px;">${opt.dimensions || ''}</div>
                        <div style="color: var(--text); font-size:12px;">${opt.price_bw_label || 'Price'}: ${opt.price_bw ? '₱'+parseFloat(opt.price_bw).toFixed(2) : '—'} | ${opt.price_color_label || 'Secondary'}: ${opt.price_color ? '₱'+parseFloat(opt.price_color).toFixed(2) : '—'}</div>
                        ${opt.badge ? `<div style="color: var(--cyan); font-size:12px; font-weight:700; margin-top:4px;">${opt.badge}</div>` : ''}
                    </div>
                    <div class="flex gap-2">
                        <button class="btn-ghost" onclick="editOption(${opt.id})">✏️</button>
                        <button class="btn-ghost" style="border-color: rgba(255,107,107,0.5); color:#ffb3b3;" onclick="deleteOption(${opt.id})">🗑</button>
                    </div>
                </div>
            `).join('');
        }

        function resetOptionForm() {
            document.getElementById('optId').value = '';
            document.getElementById('optName').value = '';
            document.getElementById('optDimensions').value = '';
            document.getElementById('optPriceBw').value = '';
            document.getElementById('optPriceColor').value = '';
            document.getElementById('optPriceBwLabel').value = '';
            document.getElementById('optPriceColorLabel').value = '';
            document.getElementById('optBadge').value = '';
            document.getElementById('optSizeClass').value = 'standard';
            document.getElementById('optActive').checked = true;
            document.getElementById('optFormTitle').textContent = 'Add Option';
            document.getElementById('optSubmitBtn').textContent = 'Save Option';
        }

        function editOption(id) {
            if (!window.currentOptions) return;
            const opt = window.currentOptions.find(o => o.id === id);
            if (!opt) return;
            document.getElementById('optId').value = opt.id;
            document.getElementById('optName').value = opt.name || '';
            document.getElementById('optDimensions').value = opt.dimensions || '';
            document.getElementById('optPriceBw').value = opt.price_bw || '';
            document.getElementById('optPriceColor').value = opt.price_color || '';
            document.getElementById('optPriceBwLabel').value = opt.price_bw_label || '';
            document.getElementById('optPriceColorLabel').value = opt.price_color_label || '';
            document.getElementById('optBadge').value = opt.badge || '';
            document.getElementById('optSizeClass').value = opt.size_class || 'standard';
            document.getElementById('optActive').checked = !!opt.is_active;
            document.getElementById('optFormTitle').textContent = 'Edit Option';
            document.getElementById('optSubmitBtn').textContent = 'Update Option';
        }

        async function submitOption(e) {
            e.preventDefault();
            const serviceId = document.getElementById('currentServiceId').value;
            const optId = document.getElementById('optId').value;
            const payload = {
                name: document.getElementById('optName').value,
                dimensions: document.getElementById('optDimensions').value,
                price_bw: document.getElementById('optPriceBw').value || null,
                price_color: document.getElementById('optPriceColor').value || null,
                price_bw_label: document.getElementById('optPriceBwLabel').value,
                price_color_label: document.getElementById('optPriceColorLabel').value,
                badge: document.getElementById('optBadge').value,
                size_class: document.getElementById('optSizeClass').value,
                is_active: document.getElementById('optActive').checked,
            };
            if (!payload.name) { showToast('Name required', 'error'); return; }

            const isEdit = !!optId;
            const url = isEdit ? `/admin/services-management/options/${optId}` : `/admin/services-management/${serviceId}/options`;
            const method = isEdit ? 'PATCH' : 'POST';
            try {
                const res = await fetch(url, {
                    method,
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success) {
                    showToast(data.message, 'success');
                    setTimeout(() => location.reload(), 500);
                } else {
                    showToast('Save option failed', 'error');
                }
            } catch { showToast('Save option failed', 'error'); }
        }

        async function deleteOption(id) {
            if (!confirm('Delete this option?')) return;
            try {
                const res = await fetch(`/admin/services-management/options/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); setTimeout(() => location.reload(), 400); }
                else showToast('Delete failed', 'error');
            } catch { showToast('Delete failed', 'error'); }
        }

        // ---------- Officers ----------
        function openOfficerModal() {
            document.getElementById('officerModal').classList.add('active');
            document.getElementById('officerForm').reset();
            document.getElementById('officerId').value = '';
            document.getElementById('officerModalTitle').textContent = 'Add Officer';
            document.getElementById('officerSubmitBtn').textContent = 'Save';
        }
        function closeOfficerModal() { document.getElementById('officerModal').classList.remove('active'); }

        function editOfficer(id) {
            const officer = officersData.find(o => o.id === id);
            if (!officer) return;
            openOfficerModal();
            document.getElementById('officerModalTitle').textContent = 'Edit Officer';
            document.getElementById('officerSubmitBtn').textContent = 'Update';
            document.getElementById('officerId').value = officer.id;
            document.getElementById('officerName').value = officer.name;
            document.getElementById('officerTitle').value = officer.title || '';
            document.getElementById('officerMessenger').value = officer.messenger_url || '';
            document.getElementById('officerActive').checked = !!officer.is_active;
        }

        async function submitOfficer(e) {
            e.preventDefault();
            const id = document.getElementById('officerId').value;
            const isEdit = !!id;
            const payload = {
                name: document.getElementById('officerName').value,
                title: document.getElementById('officerTitle').value,
                messenger_url: document.getElementById('officerMessenger').value,
                is_active: document.getElementById('officerActive').checked,
            };
            const url = isEdit ? `/admin/services-management/officers/${id}` : '/admin/services-management/officers';
            const method = isEdit ? 'PATCH' : 'POST';
            try {
                const res = await fetch(url, {
                    method,
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); closeOfficerModal(); setTimeout(() => location.reload(), 500); }
                else showToast('Save failed', 'error');
            } catch { showToast('Save failed', 'error'); }
        }

        async function deleteOfficer(id) {
            if (!confirm('Delete this officer?')) return;
            try {
                const res = await fetch(`/admin/services-management/officers/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); setTimeout(() => location.reload(), 400); }
                else showToast('Delete failed', 'error');
            } catch { showToast('Delete failed', 'error'); }
        }

        // Close modals on overlay click
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', (e) => { if (e.target === overlay) overlay.classList.remove('active'); });
        });
    </script>
</x-admin-layout>
