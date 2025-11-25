<?php if (isset($component)) { $__componentOriginale0f1cdd055772eb1d4a99981c240763e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f1cdd055772eb1d4a99981c240763e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('page-title', 'Buy List Management'); ?>

    <style>
        /* Modern admin table styling with dark theme compatibility */
        #buyListTable {
            /* make table fit container and distribute columns cleanly */
            width: 100%;
            table-layout: fixed; /* prevents the table from expanding with long content */
            border-collapse: separate;
            border-spacing: 0;
            font-family: 'Inter', 'Roboto', 'Arial', sans-serif;
            font-size: 13px;
            box-sizing: border-box;
        }

        #buyListTable thead th {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: #ffffff;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 12px;
            border: 1px solid #3b82f6;
            border-right: 1px solid rgba(59, 130, 246, 0.3);
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        #buyListTable tbody tr {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(8px);
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(71, 85, 105, 0.4);
        }

        #buyListTable tbody tr:hover {
            background: rgba(51, 65, 85, 0.8);
            transform: translateX(2px);
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
        }

        #buyListTable tbody tr.selected {
            background: rgba(30, 58, 138, 0.5) !important;
            border-left: 3px solid #3b82f6;
        }

        #buyListTable tbody tr.row-new {
            background: rgba(34, 197, 94, 0.15);
            border-left: 3px solid #22c55e;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #buyListTable tbody td {
            border: 1px solid rgba(71, 85, 105, 0.3);
            border-top: 1px solid rgba(71, 85, 105, 0.2);
            padding: 0;
            color: #e2e8f0;
            vertical-align: middle;
            position: relative;
        }

        .cell-content {
            padding: 10px 12px;
            min-height: 38px;
            cursor: cell;
            display: flex;
            align-items: center;
            width: 100%;
            color: #e2e8f0;
        }

        /* target long text columns so the table won't expand and cause extra right padding */
        .col-item-name .cell-content {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* notes should be able to wrap */
        .col-notes .cell-content {
            white-space: normal;
            word-break: break-word;
        }

        .cell-content:hover {
            background-color: rgba(59, 130, 246, 0.1);
            outline: 1px solid #3b82f6;
            outline-offset: -1px;
        }

        .cell-content.editing {
            padding: 0;
            background: rgba(15, 23, 42, 0.95);
            outline: 2px solid #3b82f6;
            outline-offset: -2px;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .cell-content input,
        .cell-content select,
        .cell-content textarea {
            width: 100%;
            padding: 10px 12px;
            border: none;
            background: rgba(15, 23, 42, 0.95);
            color: #f1f5f9;
            font-family: 'Inter', 'Roboto', 'Arial', sans-serif;
            font-size: 13px;
            outline: none;
        }

        .cell-content input::placeholder,
        .cell-content textarea::placeholder {
            color: #64748b;
        }

        .cell-content textarea {
            resize: vertical;
            min-height: 70px;
        }

        /* Column widths */
        .col-item-name { width: 25%; min-width: 160px; }
        .col-quantity { width: 10%; text-align: center; }
        .col-price { width: 15%; text-align: center; }
        .col-priority { width: 12%; text-align: center; }
        .col-bought { width: 10%; text-align: center; }

        /* center content for small compact columns */
        .col-quantity .cell-content,
        .col-price .cell-content,
        .col-priority .cell-content,
        .col-bought .cell-content {
            justify-content: center;
            text-align: center;
        }
        .col-notes { width: 20%; }
        .col-actions { width: 8%; text-align: center; }

        /* Priority badges - Enhanced for dark theme */
        .priority-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .priority-high {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: #ffffff;
        }

        .priority-medium {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #ffffff;
        }

        .priority-low {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: #ffffff;
        }

        /* Bought status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .bought-true {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: #ffffff;
        }

        .bought-false {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #ffffff;
        }

        /* Action buttons */
        .action-btn {
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            background: rgba(71, 85, 105, 0.4);
            color: #cbd5e1;
        }

        .action-btn:hover {
            background: rgba(71, 85, 105, 0.8);
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .action-btn.save {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
        }

        .action-btn.save:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4);
        }

        .action-btn.delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #ffffff;
        }

        .action-btn.delete:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        /* Table container */
        .table-container {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(59, 130, 246, 0.1);
        }

        .table-wrapper {
            overflow-x: auto;
            overflow-y: auto;
            max-height: calc(100vh - 280px);
        }

        /* Custom scrollbar for dark theme */
        .table-wrapper::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 10px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #94a3b8;
        }

        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 12px;
            color: #e2e8f0;
            font-weight: 500;
        }

        .empty-state p {
            color: #64748b;
        }

        /* SweetAlert2 Dark Theme Overrides */
        .swal2-popup.dark-popup {
            background: linear-gradient(135deg, #1a1f2e 0%, #0f1419 100%) !important;
            border: 2px solid #3b82f6 !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6) !important;
        }

        .swal2-popup.dark-popup .swal2-title {
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 1.5rem !important;
        }

        .swal2-popup.dark-popup .swal2-html-container {
            color: #e2e8f0 !important;
            font-size: 1rem !important;
        }

        .swal2-popup.dark-popup .swal2-confirm {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4) !important;
            font-weight: 600 !important;
        }

        .swal2-popup.dark-popup .swal2-cancel {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%) !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
            font-weight: 600 !important;
        }

        .swal2-popup.dark-popup .swal2-icon.swal2-warning {
            border-color: #f59e0b !important;
            color: #f59e0b !important;
        }

        .swal2-popup.dark-popup .swal2-icon.swal2-error {
            border-color: #ef4444 !important;
            color: #ef4444 !important;
        }

        .swal2-popup.dark-popup .swal2-icon.swal2-success {
            border-color: #22c55e !important;
            color: #22c55e !important;
        }

        /* Toast notifications - readable styling */
        .swal2-toast-readable {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4) !important;
            border: 2px solid rgba(255, 255, 255, 0.2) !important;
            font-weight: 600 !important;
        }

        /* Header controls */
        .header-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding: 20px 0;
        }

        .add-row-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .add-row-btn:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }

        .add-row-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }

        /* Price styling */
        .price-text {
            font-family: 'Roboto Mono', 'Courier New', monospace;
            color: #22c55e;
            font-size: 12px;
            font-weight: 600;
        }

        .placeholder-text {
            color: #64748b;
        }
    </style>

    <!-- Header Section -->
    <div class="header-controls">
        <div>
            <h2 style="font-size: 28px; font-weight: 700; color: #f1f5f9; margin: 0 0 6px 0; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                📋 Buy List Management
            </h2>
            <p style="font-size: 14px; color: #94a3b8; margin: 0;">
                Click any cell to edit • Changes save automatically
            </p>
        </div>
        <button onclick="addNewRow()" class="add-row-btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
            </svg>
            Add New Item
        </button>
    </div>

    <!-- Buy List Table -->
    <div class="table-container">
        <div class="table-wrapper">
            <table id="buyListTable">
                <colgroup>
                    <col style="width:25%;">
                    <col style="width:10%;">
                    <col style="width:15%;">
                    <col style="width:12%;">
                    <col style="width:10%;">
                    <col style="width:20%;">
                    <col style="width:8%;">
                </colgroup>
                <thead>
                    <tr>
                        <th class="col-item-name">Item Name</th>
                        <th class="col-quantity">Qty</th>
                        <th class="col-price">Estimated Price</th>
                        <th class="col-priority">Priority</th>
                        <th class="col-bought">Purchased</th>
                        <th class="col-notes">Notes</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody id="itemsContainer">
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr data-id="<?php echo e($item->id); ?>">
                            <td class="col-item-name">
                                <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="item_name"><?php echo e($item->item_name); ?></div>
                            </td>
                            <td class="col-quantity">
                                <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="quantity"><?php echo e($item->quantity ?? 1); ?></div>
                            </td>
                            <td class="col-price">
                                <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="price">
                                    <?php if($item->estimated_price_min && $item->estimated_price_max): ?>
                                        <span class="price-text">₱<?php echo e(number_format($item->estimated_price_min, 2)); ?> - ₱<?php echo e(number_format($item->estimated_price_max, 2)); ?></span>
                                    <?php else: ?>
                                        <span class="placeholder-text">—</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="col-priority">
                                <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="priority">
                                    <span class="priority-badge priority-<?php echo e($item->priority); ?>"><?php echo e(ucfirst($item->priority)); ?></span>
                                </div>
                            </td>
                            <td class="col-bought">
                                <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="is_bought">
                                    <span class="status-badge bought-<?php echo e($item->is_bought ? 'true' : 'false'); ?>">
                                        <?php echo e($item->is_bought ? '✓ Yes' : '✗ No'); ?>

                                    </span>
                                </div>
                            </td>
                            <td class="col-notes">
                                <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="notes"><?php echo e($item->notes ?? '—'); ?></div>
                            </td>
                            <td class="col-actions">
                                <button class="action-btn delete" onclick="deleteItem(<?php echo e($item->id); ?>)">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr id="emptyState">
                            <td colspan="7">
                                <div class="empty-state">
                                    <svg width="80" height="80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin: 0 auto 20px; opacity: 0.4;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <h3>No items in your buy list</h3>
                                    <p>Click "Add New Item" to create your first restock entry</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let editingCell = null;

        function editCell(cellContent) {
            if (cellContent.classList.contains('editing')) return;

            // Close and save previous edit automatically
            if (editingCell && editingCell !== cellContent) {
                const prevInput = editingCell.querySelector('input, select, textarea');
                if (prevInput) {
                    const prevField = editingCell.getAttribute('data-field');
                    const prevRow = editingCell.closest('tr');
                    const prevRowId = prevRow.getAttribute('data-id');
                    const prevOriginalHTML = editingCell.getAttribute('data-original-html');
                    saveCell(editingCell, prevField, prevRow, prevRowId, prevOriginalHTML);
                }
            }

            const field = cellContent.getAttribute('data-field');
            const row = cellContent.closest('tr');
            const rowId = row.getAttribute('data-id');
            let originalValue = cellContent.textContent.trim();

            cellContent.classList.add('editing');
            const originalHTML = cellContent.innerHTML;
            cellContent.setAttribute('data-original-html', originalHTML); // Store for later use

            let input;

            if (field === 'quantity') {
                input = document.createElement('input');
                input.type = 'number';
                input.min = '1';
                input.value = originalValue;
            } else if (field === 'priority') {
                input = document.createElement('select');
                input.innerHTML = `
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                `;
                input.value = originalValue.toLowerCase();
            } else if (field === 'is_bought') {
                input = document.createElement('select');
                input.innerHTML = `
                    <option value="0">✗ No</option>
                    <option value="1">✓ Yes</option>
                `;
                input.value = originalValue.includes('Yes') ? '1' : '0';
            } else if (field === 'price') {
                    input = document.createElement('input');
                    input.type = 'text';
                    input.setAttribute('inputmode', 'numeric');
                    input.placeholder = 'e.g., 100 or 100-200';
                    const priceText = cellContent.textContent.trim();
                    // normalize by removing currency symbols and any spaces so value = 100 or 100-200
                    input.value = priceText !== '—' ? priceText.replace(/₱/g, '').replace(/\s+/g, '').trim() : '';

                    // restrict characters while typing: only digits and a single hyphen
                    input.addEventListener('input', function(e) {
                        let v = e.target.value || '';
                        // remove spaces and invalid chars
                        v = v.replace(/\s+/g, '');
                        v = v.replace(/[^0-9-]/g, '');
                        // keep only the first hyphen
                        const parts = v.split('-');
                        if (parts.length > 2) {
                            v = parts[0] + '-' + parts.slice(1).join('');
                        }
                        // strip leading hyphens only (allow trailing hyphen while typing)
                        v = v.replace(/^-+/, '');
                        e.target.value = v;
                    });
            } else if (field === 'notes') {
                input = document.createElement('textarea');
                input.value = originalValue !== '—' ? originalValue : '';
                input.rows = 3;
            } else {
                input = document.createElement('input');
                input.type = 'text';
                input.value = originalValue === 'Click to enter' ? '' : originalValue;
            }

            cellContent.innerHTML = '';
            cellContent.appendChild(input);
            input.focus();
            
            if (input.type === 'text' || input.tagName === 'TEXTAREA') {
                input.select();
            }

            // Save on Enter (optional - for quick save)
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && (field !== 'notes' || e.shiftKey)) {
                    e.preventDefault();
                    input.blur(); // Trigger blur to save
                } else if (e.key === 'Escape') {
                    cancelEdit(cellContent, originalHTML);
                }
            });

            // Auto-save on blur (when user clicks away or tabs out)
            input.addEventListener('blur', () => {
                // Small delay to allow click on another cell to register first
                setTimeout(() => {
                    if (cellContent.classList.contains('editing')) {
                        saveCell(cellContent, field, row, rowId, originalHTML);
                    }
                }, 50);
            });

            // For select dropdowns, save immediately on change
            if (input.tagName === 'SELECT') {
                input.addEventListener('change', () => {
                    saveCell(cellContent, field, row, rowId, originalHTML);
                });
            }

            editingCell = cellContent;
        }

        function cancelEdit(cellContent, originalHTML) {
            if (!originalHTML) {
                originalHTML = cellContent.getAttribute('data-original-html');
            }
            if (originalHTML) {
                cellContent.innerHTML = originalHTML;
            }
            cellContent.classList.remove('editing');
            cellContent.removeAttribute('data-original-html');
            if (editingCell === cellContent) {
                editingCell = null;
            }
        }

        function saveCell(cellContent, field, row, rowId, originalHTML) {
            const input = cellContent.querySelector('input, select, textarea');
            if (!input) return;
            
            let value = input.value.trim();

            // Validate price format (allow empty, single number, or range like 100-200)
            if (field === 'price' && value) {
                // normalize common spacing (in case input came from formatted text like '₱100 - ₱600')
                value = value.replace(/\s+/g, '');
                const ok = /^\d+(?:-\d+)?$/.test(value);
                if (!ok) {
                    Swal.fire({
                        title: 'Invalid Price Format',
                        text: 'Estimated Price must be a number (e.g. 100) or a range (e.g. 100-200).',
                        icon: 'warning',
                        confirmButtonColor: '#f59e0b',
                        confirmButtonText: 'Got it',
                        customClass: { popup: 'dark-popup' }
                    });
                    input.focus();
                    return;
                }
            }

            cellContent.classList.remove('editing');
            cellContent.removeAttribute('data-original-html');

            // Format display value
            let displayValue = value || '—';
            
            if (field === 'priority') {
                displayValue = `<span class="priority-badge priority-${value}">${value.charAt(0).toUpperCase() + value.slice(1)}</span>`;
            } else if (field === 'is_bought') {
                const isBought = value === '1';
                displayValue = `<span class="status-badge bought-${isBought}">${isBought ? '✓ Yes' : '✗ No'}</span>`;
            }
            if (field === 'price' && value) {
                // format single or range (e.g. "100" or "100-200") to show currency and spacing
                const parts = value.split('-').map(p => p.trim());
                if (parts.length === 2 && parts[1] !== '') {
                    displayValue = `<span class="price-text">₱${parts[0]} - ₱${parts[1]}</span>`;
                } else {
                    displayValue = `<span class="price-text">₱${parts[0]}</span>`;
                }
            } else if (!value) {
                displayValue = '<span class="placeholder-text">—</span>';
            }

            cellContent.innerHTML = displayValue;

            // Save to database if row has ID
            if (rowId && rowId !== 'new') {
                updateItemField(rowId, field, value);
            }

            if (editingCell === cellContent) {
                editingCell = null;
            }
        }

        function addNewRow() {
            const container = document.getElementById('itemsContainer');
            const emptyState = document.getElementById('emptyState');

            if (emptyState) {
                emptyState.remove();
            }

            const newRow = document.createElement('tr');
            newRow.setAttribute('data-id', 'new');
            newRow.classList.add('row-new');
            newRow.innerHTML = `
                <td class="col-item-name">
                    <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="item_name"><span class="placeholder-text">Click to enter item name</span></div>
                </td>
                <td class="col-quantity">
                    <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="quantity">1</div>
                </td>
                <td class="col-price">
                    <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="price"><span class="placeholder-text">—</span></div>
                </td>
                <td class="col-priority">
                    <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="priority">
                        <span class="priority-badge priority-medium">Medium</span>
                    </div>
                </td>
                <td class="col-bought">
                    <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="is_bought">
                        <span class="status-badge bought-false">✗ No</span>
                    </div>
                </td>
                <td class="col-notes">
                    <div class="cell-content" tabindex="0" onclick="editCell(this)" onkeydown="if(event.key==='Enter'){ editCell(this); }" data-field="notes"><span class="placeholder-text">—</span></div>
                </td>
                <td class="col-actions">
                    <button class="action-btn save" onclick="saveNewRow(this.closest('tr'))" title="Save Item">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </button>
                    <button class="action-btn delete" onclick="deleteNewRow(this.closest('tr'))" title="Cancel">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                    </button>
                </td>
            `;

            container.appendChild(newRow);
            newRow.querySelector('[data-field="item_name"]').click();
        }

        function saveNewRow(row) {
            const itemName = row.querySelector('[data-field="item_name"]').textContent.trim();

            if (!itemName || itemName === 'Click to enter item name' || itemName === '' || itemName === '—') {
                Swal.fire({
                    title: 'Item Name Required',
                    text: 'Please enter an item name before saving.',
                    icon: 'warning',
                    confirmButtonColor: '#f59e0b',
                    confirmButtonText: 'OK',
                    customClass: { popup: 'dark-popup' }
                });
                return;
            }

            const quantity = parseInt(row.querySelector('[data-field="quantity"]').textContent.trim()) || 1;
            const priceText = row.querySelector('[data-field="price"]').textContent.trim();
            let priceMin = null, priceMax = null;

            if (priceText !== '—') {
                // normalize by removing currency symbols and spaces before validating
                const cleaned = priceText.replace(/₱/g, '').replace(/\s+/g, '').trim();
                // validate allowed formats: 100 or 100-200
                if (!/^\d+(?:-\d+)?$/.test(cleaned)) {
                    Swal.fire({
                        title: 'Invalid Price Format',
                        text: 'Estimated Price must be a number (e.g. 100) or a range (e.g. 100-200).',
                        icon: 'warning',
                        confirmButtonColor: '#f59e0b',
                        confirmButtonText: 'Got it',
                        customClass: { popup: 'dark-popup' }
                    });
                    return;
                }

                const prices = cleaned.split('-').map(p => parseFloat(p.trim()));
                if (prices.length === 2) {
                    [priceMin, priceMax] = prices;
                } else if (prices.length === 1 && !isNaN(prices[0])) {
                    priceMin = priceMax = prices[0];
                }
            }

            const priority = row.querySelector('[data-field="priority"] span').textContent.toLowerCase();
            const isBought = row.querySelector('[data-field="is_bought"]').textContent.includes('Yes') ? 1 : 0;
            const notes = row.querySelector('[data-field="notes"]').textContent.trim();

            fetch('<?php echo e(route("admin.buy-list.store")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    item_name: itemName,
                    quantity: quantity,
                    estimated_price_min: priceMin,
                    estimated_price_max: priceMax,
                    priority: priority,
                    is_bought: isBought,
                    notes: notes !== '—' ? notes : null
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    row.setAttribute('data-id', data.item.id);
                    row.classList.remove('row-new');
                    
                    row.querySelector('.col-actions').innerHTML = `
                        <button class="action-btn delete" onclick="deleteItem(${data.item.id})">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                            </svg>
                        </button>
                    `;

                    Swal.fire({
                        title: 'Item Saved',
                        text: 'The item has been added successfully.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                        background: 'linear-gradient(135deg, #22c55e 0%, #16a34a 100%)',
                        color: '#ffffff',
                        iconColor: '#ffffff',
                        customClass: { popup: 'swal2-toast-readable' }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Save Failed',
                    text: 'Failed to save item. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK',
                    customClass: { popup: 'dark-popup' }
                });
            });
        }

        function deleteNewRow(row) {
            row.remove();
            
            const container = document.getElementById('itemsContainer');
            if (container.children.length === 0) {
                container.innerHTML = `
                    <tr id="emptyState">
                        <td colspan="7">
                            <div class="empty-state">
                                <svg width="80" height="80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin: 0 auto 20px; opacity: 0.4;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h3>No items in your buy list</h3>
                                <p>Click "Add New Item" to create your first restock entry</p>
                            </div>
                        </td>
                    </tr>
                `;
            }
        }

        function updateItemField(itemId, field, value) {
            let payload = {};

            if (field === 'item_name') {
                payload.item_name = value;
            } else if (field === 'quantity') {
                payload.quantity = parseInt(value) || 1;
            } else if (field === 'price') {
                let priceMin = null, priceMax = null;
                if (value) {
                    const prices = value.replace(/₱/g, '').split('-').map(p => parseFloat(p.trim()));
                    if (prices.length === 2) {
                        [priceMin, priceMax] = prices;
                    } else if (prices.length === 1 && !isNaN(prices[0])) {
                        priceMin = priceMax = prices[0];
                    }
                }
                payload.estimated_price_min = priceMin;
                payload.estimated_price_max = priceMax;
            } else if (field === 'priority') {
                payload.priority = value;
            } else if (field === 'is_bought') {
                payload.is_bought = value === '1';
            } else if (field === 'notes') {
                payload.notes = value || null;
            }

            fetch(`<?php echo e(route('admin.buy-list.update', '')); ?>/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Error updating item:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function deleteItem(itemId) {
            Swal.fire({
                title: 'Delete Item?',
                text: 'This item will be permanently removed from the buy list.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                customClass: { popup: 'dark-popup' }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`<?php echo e(route('admin.buy-list.destroy', '')); ?>/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const row = document.querySelector(`tr[data-id="${itemId}"]`);
                            row.remove();
                            
                            const container = document.getElementById('itemsContainer');
                            if (container.children.length === 0) {
                                container.innerHTML = `
                                    <tr id="emptyState">
                                        <td colspan="7">
                                            <div class="empty-state">
                                                <svg width="80" height="80" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin: 0 auto 20px; opacity: 0.4;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <h3>No items in your buy list</h3>
                                                <p>Click "Add New Item" to create your first restock entry</p>
                                            </div>
                                        </td>
                                    </tr>
                                `;
                            }
                            
                            Swal.fire({
                                title: 'Deleted',
                                text: 'The item has been removed.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end',
                                background: 'linear-gradient(135deg, #22c55e 0%, #16a34a 100%)',
                                color: '#ffffff',
                                iconColor: '#ffffff',
                                customClass: { popup: 'swal2-toast-readable' }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Delete Failed',
                            text: 'Failed to delete item. Please try again.',
                            icon: 'error',
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'OK',
                            customClass: { popup: 'dark-popup' }
                        });
                    });
                }
            });
        }

        function showNotification(message, type = 'info') {
            Swal.fire({
                text: message,
                icon: type,
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                background: type === 'success' ? '#e6f4ea' : '#e8f0fe',
                color: type === 'success' ? '#137333' : '#1a73e8'
            });
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $attributes = $__attributesOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $component = $__componentOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__componentOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\admin\buy-list\index.blade.php ENDPATH**/ ?>