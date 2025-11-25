<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div style="background: #FFFAF1; min-height: 100vh; width: 100%; padding-top: 100px;">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap');

        body {
            background: #FFFAF1 !important;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        .animated-gradient-receipt {
            background: #FFFAF1;
            min-height: 100vh;
        }

        #receipt-content {
            background: white;
            max-width: 800px;
            margin: 0 auto;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            page-break-inside: avoid;
        }

        .receipt-header {
            border-bottom: 3px solid #8B0000;
            padding-bottom: 16px;
            margin-bottom: 18px;
        }

        .company-name {
            color: #8B0000;
            font-size: 24px;
            font-weight: 800;
            margin: 0;
        }

        .company-tagline {
            color: #666666;
            font-size: 12px;
            font-weight: 500;
            margin: 2px 0 0 0;
        }

        .section-title {
            color: #1a1a1a;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin: 12px 0 8px 0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            font-size: 12px;
        }

        .detail-label {
            color: #666666;
            font-weight: 600;
        }

        .detail-value {
            color: #1a1a1a;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
            font-size: 12px;
        }

        thead {
            background: #F9F9F9;
            border-top: 2px solid #E8E8E8;
            border-bottom: 2px solid #E8E8E8;
        }

        th {
            padding: 8px;
            text-align: left;
            font-weight: 800;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1a1a1a;
        }

        td {
            padding: 8px;
            font-size: 12px;
            color: #1a1a1a;
            border-bottom: 1px solid #E8E8E8;
        }

        tbody tr:hover {
            background: #F9F9F9;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .totals-section {
            margin: 12px 0;
            padding: 12px 0;
            border-top: 2px solid #E8E8E8;
            border-bottom: 2px solid #E8E8E8;
        }

        .total-row {
            display: flex;
            justify-content: flex-end;
            gap: 30px;
            padding: 6px 0;
            font-size: 12px;
        }

        .total-row.final {
            border-top: 1px solid #E8E8E8;
            padding-top: 8px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        .total-label {
            color: #666666;
            font-weight: 600;
            min-width: 120px;
            text-align: right;
        }

        .total-value {
            color: #1a1a1a;
            font-weight: 700;
            min-width: 100px;
            text-align: right;
        }

        .total-value.final {
            color: #8B0000;
            font-weight: 800;
            font-size: 20px;
        }

        .footer-section {
            text-align: center;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 2px solid #E8E8E8;
        }

        .thank-you {
            color: #1a1a1a;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .footer-text {
            color: #666666;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .qr-placeholder {
            width: 100%;
            margin: 12px 0;
            padding: 12px;
            background: #F9F9F9;
            border: 2px solid #E8E8E8;
            border-radius: 4px;
            text-align: center;
            display: block;
        }

        .barcode-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            width: 100%;
        }

        .barcode {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 2px;
            height: 60px;
            background: white;
            padding: 8px;
            border: 1px solid #ddd;
            width: 100%;
            min-height: 60px;
        }

        .barcode-bar {
            background: #000000;
            width: 4px;
            border-radius: 1px;
            flex: 1;
            min-width: 2px;
        }

        .timestamp {
            color: #999999;
            font-size: 12px;
            margin-top: 16px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            padding: 0;
            background: transparent;
            box-shadow: none;
            margin-bottom: 24px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.25);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #A00000 0%, #B00000 100%);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.35);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: transparent;
            color: #8B0000;
            border: 2px solid #8B0000;
        }

        .btn-secondary:hover {
            background: #8B0000;
            color: white;
            transform: translateY(-2px);
        }

        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .action-buttons {
                display: none !important;
                visibility: hidden !important;
            }

            #receipt-content {
                box-shadow: none;
                border-radius: 0;
                padding: 16px;
                margin: 0;
                max-width: 100%;
                page-break-inside: avoid;
                page-break-before: avoid;
                page-break-after: avoid;
            }

            .barcode {
                background: white !important;
                border: 1px solid #000 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            .barcode-bar {
                background: #000000 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            .qr-placeholder {
                background: white !important;
                border: 1px solid #000 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            * {
                page-break-inside: avoid;
            }
        }

        @media print and (max-height: 842px) {
            body { font-size: 11px; }
            #receipt-content { padding: 12px; }
            .section-title { margin: 8px 0 6px 0; }
            th, td { padding: 6px; font-size: 10px; }
        }

        @media print and (max-height: 1191px) {
            body { font-size: 12px; }
            #receipt-content { padding: 20px; }
        }

        @media (max-width: 640px) {
            #receipt-content {
                padding: 24px;
            }

            .company-name {
                font-size: 24px;
            }

            th, td {
                padding: 10px 8px;
                font-size: 13px;
            }
        }
    </style>
    
    <div class="animated-gradient-receipt py-16 mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Action Buttons - Top -->
            <div class="action-buttons mb-8">
                <a href="<?php echo e(route('account.orders')); ?>" class="btn btn-secondary">← Back to Orders</a>
                <button onclick="printReceipt()" class="btn btn-primary">🖨️ Print</button>
                <button onclick="generatePDF()" class="btn btn-primary">📥 Download PDF</button>
            </div>

            <div id="receipt-content">
                <!-- Receipt Header -->
                <div class="receipt-header">
                    <p class="company-name">🏪 <?php echo e(config('app.name', 'IGP Hub')); ?></p>
                    <p class="company-tagline">Student Council Inventory & Services</p>
                </div>

                <!-- Receipt Title -->
                <div style="text-align: center; margin-bottom: 32px;">
                    <h1 style="color: #1a1a1a; font-size: 24px; font-weight: 800; margin: 0 0 4px 0;">Order Receipt</h1>
                    <p style="color: #666666; font-size: 14px; margin: 0;">Order #<?php echo e(str_pad($order->id, 6, '0', STR_PAD_LEFT)); ?></p>
                </div>

                <!-- Customer Information -->
                <div class="detail-row">
                    <div>
                        <div class="section-title">Bill To</div>
                        <div style="color: #1a1a1a; font-weight: 700; font-size: 15px; margin-bottom: 4px;">
                            <?php echo e($order->customer ? $order->customer->name : auth()->user()->name); ?>

                        </div>
                        <div style="color: #666666; font-size: 14px;">
                            <?php echo e($order->customer ? $order->customer->email : auth()->user()->email); ?>

                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div class="section-title">Order Details</div>
                        <div class="detail-row" style="justify-content: flex-end; padding: 4px 0;">
                            <span class="detail-label" style="margin-right: 40px;">Date:</span>
                            <span class="detail-value"><?php echo e($order->created_at->format('M d, Y')); ?></span>
                        </div>
                        <div class="detail-row" style="justify-content: flex-end; padding: 4px 0;">
                            <span class="detail-label" style="margin-right: 40px;">Status:</span>
                            <span class="detail-value"><?php echo e(ucfirst($order->status)); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Items Table -->
                <div style="margin-top: 32px;">
                    <h3 class="section-title">Order Items</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th class="text-center" style="width: 80px;">Qty</th>
                                <th class="text-right" style="width: 120px;">Unit Price</th>
                                <th class="text-right" style="width: 120px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div style="font-weight: 700; margin-bottom: 4px;"><?php echo e($item->product->name); ?></div>
                                        <?php if($item->variant): ?>
                                            <div style="color: #666666; font-size: 13px;">🎨 <?php echo e($item->variant->name); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center" style="font-weight: 700;"><?php echo e($item->quantity); ?></td>
                                    <td class="text-right" style="font-weight: 700;">₱<?php echo e(number_format($item->unit_price, 2)); ?></td>
                                    <td class="text-right" style="font-weight: 800; color: #8B0000;">₱<?php echo e(number_format($item->total_price, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Service Requests (if any) -->
                <?php if($order->serviceRequests->count() > 0): ?>
                    <div style="margin: 24px 0; padding: 16px; background: #F9F9F9; border-left: 4px solid #8B0000; border-radius: 4px;">
                        <h3 class="section-title" style="margin-top: 0;">🔧 Printing & Customization Services</h3>
                        <?php $__currentLoopData = $order->serviceRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="margin-bottom: 12px;">
                                <div style="color: #1a1a1a; font-weight: 700; font-size: 14px;">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $service->service_type ?? 'Service'))); ?>

                                </div>
                                <div style="color: #666666; font-size: 13px;"><?php echo e($service->specifications ?? 'Custom Service'); ?></div>
                                <?php if($service->is_rush): ?>
                                    <div style="color: #FF5252; font-weight: 700; font-size: 12px; margin-top: 4px;">⚡ Rush Service</div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <!-- Totals Section -->
                <div class="totals-section">
                    <div class="total-row">
                        <span class="total-label">Subtotal:</span>
                        <span class="total-value">₱<?php echo e(number_format($order->items->sum('total_price'), 2)); ?></span>
                    </div>
                    <?php if($order->discount > 0): ?>
                        <div class="total-row">
                            <span class="total-label">Discount:</span>
                            <span class="total-value" style="color: #4CAF50;">-₱<?php echo e(number_format($order->discount, 2)); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="total-row final">
                        <span class="total-label">Total Amount:</span>
                        <span class="total-value final">₱<?php echo e(number_format($order->total, 2)); ?></span>
                    </div>
                </div>

                <!-- Barcode Section -->
                <div class="qr-placeholder">
                    <div class="barcode-container">
                        <div class="barcode">
                            <div class="barcode-bar" style="height: 65%;"></div>
                            <div class="barcode-bar" style="height: 80%;"></div>
                            <div class="barcode-bar" style="height: 45%;"></div>
                            <div class="barcode-bar" style="height: 75%;"></div>
                            <div class="barcode-bar" style="height: 55%;"></div>
                            <div class="barcode-bar" style="height: 90%;"></div>
                            <div class="barcode-bar" style="height: 40%;"></div>
                            <div class="barcode-bar" style="height: 85%;"></div>
                            <div class="barcode-bar" style="height: 60%;"></div>
                            <div class="barcode-bar" style="height: 70%;"></div>
                            <div class="barcode-bar" style="height: 50%;"></div>
                            <div class="barcode-bar" style="height: 88%;"></div>
                            <div class="barcode-bar" style="height: 48%;"></div>
                            <div class="barcode-bar" style="height: 78%;"></div>
                            <div class="barcode-bar" style="height: 62%;"></div>
                            <div class="barcode-bar" style="height: 82%;"></div>
                            <div class="barcode-bar" style="height: 52%;"></div>
                            <div class="barcode-bar" style="height: 92%;"></div>
                            <div class="barcode-bar" style="height: 58%;"></div>
                            <div class="barcode-bar" style="height: 76%;"></div>
                            <div class="barcode-bar" style="height: 68%;"></div>
                            <div class="barcode-bar" style="height: 84%;"></div>
                            <div class="barcode-bar" style="height: 54%;"></div>
                            <div class="barcode-bar" style="height: 86%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="footer-section">
                    <p class="thank-you">Thank You for Your Order!</p>
                    <p class="footer-text">For inquiries or concerns about your order, please contact the CICT Student Council Office.</p>
                    <p class="timestamp">Receipt generated on <?php echo e(now()->format('M d, Y \a\t g:i A')); ?></p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        function printReceipt() {
            window.print();
        }

        async function generatePDF() {
            const receiptElement = document.getElementById('receipt-content');
            const orderId = '<?php echo e(str_pad($order->id, 6, '0', STR_PAD_LEFT)); ?>';
            
            try {
                const btn = event.target;
                const originalText = btn.innerHTML;
                btn.innerHTML = '⏳ Generating...';
                btn.disabled = true;

                const canvas = await html2canvas(receiptElement, {
                    scale: 2,
                    useCORS: true,
                    logging: false,
                    backgroundColor: '#ffffff'
                });

                const { jsPDF } = window.jspdf;
                const imgData = canvas.toDataURL('image/png');
                
                const contentWidth = canvas.width;
                const contentHeight = canvas.height;
                const ratio = contentWidth / contentHeight;
                
                const pdfWidth = 210;
                const pdfHeight = pdfWidth / ratio;
                
                const pdf = new jsPDF({
                    orientation: 'p',
                    unit: 'mm',
                    format: [pdfWidth, pdfHeight]
                });
                
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save(`receipt-${orderId}.pdf`);

                btn.innerHTML = originalText;
                btn.disabled = false;

                alert('✓ Receipt downloaded successfully!');
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Error generating PDF. Please try again.');
                const btn = event.target;
                btn.innerHTML = '📥 Download PDF';
                btn.disabled = false;
            }
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\orders\receipt.blade.php ENDPATH**/ ?>