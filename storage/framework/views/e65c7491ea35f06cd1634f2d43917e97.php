<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt #<?php echo e(str_pad($order->id, 6, '0', STR_PAD_LEFT)); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        #receipt-content {
            background: white;
            max-width: 380px;
            margin: 0 auto;
            padding: 20px 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0,0,0,0.05);
            page-break-inside: avoid;
            position: relative;
        }

        #receipt-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #8B0000 0%, #FFD700 100%);
        }

        .receipt-header {
            text-align: center;
            padding-bottom: 12px;
            margin-bottom: 12px;
            border-bottom: 2px dashed #ddd;
        }

        .company-name {
            color: #1a1a1a;
            font-size: 22px;
            font-weight: 900;
            margin: 0 0 4px 0;
            letter-spacing: 0.5px;
        }

        .company-tagline {
            color: #666;
            font-size: 11px;
            font-weight: 500;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .receipt-title {
            text-align: center;
            margin: 10px 0;
            padding: 8px 0;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.05) 0%, rgba(255, 215, 0, 0.05) 100%);
            border-radius: 6px;
        }

        .receipt-title h1 {
            color: #1a1a1a;
            font-size: 16px;
            font-weight: 800;
            margin: 0 0 4px 0;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .order-number {
            color: #8B0000;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Courier New', monospace;
            margin: 0;
        }

        .info-section {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px dashed #ddd;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            font-size: 12px;
        }

        .info-label {
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 12px;
        }

        .items-section {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px dashed #ddd;
        }

        .section-header {
            color: #1a1a1a;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 1px solid #eee;
        }

        .item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dotted #eee;
        }

        .item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .item-name {
            color: #1a1a1a;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .item-variant {
            color: #666;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        .item-qty {
            color: #666;
            font-weight: 600;
        }

        .item-price {
            color: #1a1a1a;
            font-weight: 700;
        }

        .item-total {
            color: #8B0000;
            font-weight: 800;
            font-size: 13px;
        }

        .totals-section {
            margin: 10px 0;
            padding: 10px 0 8px 0;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            font-size: 13px;
        }

        .total-row.final {
            margin-top: 8px;
            padding: 12px 0 8px 0;
            border-top: 2px solid #1a1a1a;
            font-size: 16px;
        }

        .total-label {
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }

        .total-label.final-label {
            color: #1a1a1a;
            font-weight: 800;
            font-size: 13px;
        }

        .total-value {
            color: #1a1a1a;
            font-weight: 700;
        }

        .total-value.final {
            color: #8B0000;
            font-weight: 900;
            font-size: 20px;
            letter-spacing: -0.5px;
        }

        .barcode-section {
            margin: 12px 0;
            padding: 10px 0;
            text-align: center;
            border-top: 1px dashed #ddd;
            border-bottom: 1px dashed #ddd;
        }

        .barcode-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .barcode {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 2px;
            height: 60px;
            background: white;
            padding: 8px 0;
            width: 100%;
        }

        .barcode-bar {
            background: #000;
            width: 100%;
            border-radius: 0;
            flex: 1;
        }

        .barcode-number {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 3px;
            color: #1a1a1a;
            margin-top: 6px;
        }

        .footer-section {
            text-align: center;
            margin-top: 12px;
            padding-top: 10px;
            border-top: 2px dashed #ddd;
        }

        .thank-you {
            color: #1a1a1a;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-text {
            color: #666;
            font-size: 10px;
            line-height: 1.6;
            margin: 6px 0;
        }

        .timestamp {
            color: #999;
            font-size: 10px;
            margin-top: 12px;
            font-family: 'Courier New', monospace;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            background: white;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            max-width: 380px;
            margin: 0 auto 20px auto;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
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
            background: white;
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

            #receipt-content {
                box-shadow: none;
                padding: 12px 16px;
                margin: 0 auto;
                max-width: 380px;
                page-break-inside: avoid;
            }

            #receipt-content::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 6px;
                background: linear-gradient(90deg, #8B0000 0%, #FFD700 100%);
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .action-buttons {
                display: none !important;
            }

            .barcode {
                background: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .barcode-bar {
                background: #000 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            @page {
                margin: 10mm;
                size: A4;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 10px;
            }

            #receipt-content {
                padding: 24px 20px;
                max-width: 100%;
            }

            .action-buttons {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="<?php echo e(route('account.orders')); ?>" class="btn btn-secondary">← Back</a>
        <button onclick="printReceipt()" class="btn btn-primary">🖨️ Print</button>
        <button onclick="generatePDF()" class="btn btn-primary">📥 Download</button>
    </div>

    <div id="receipt-content">
        <!-- Receipt Header -->
        <div class="receipt-header">
            <p class="company-name">🏪 <?php echo e(config('app.name', 'IGP Hub')); ?></p>
            <p class="company-tagline">Student Council Store</p>
            <p class="footer-text" style="margin-top: 8px;">ISUFST Dingle Campus</p>
        </div>

        <!-- Receipt Title -->
        <div class="receipt-title">
            <h1>Order Receipt</h1>
            <p class="order-number">#<?php echo e(str_pad($order->id, 6, '0', STR_PAD_LEFT)); ?></p>
        </div>

        <!-- Order Info -->
        <div class="info-section">
            <div class="info-row">
                <span class="info-label">Customer:</span>
                <span class="info-value"><?php echo e($order->customer ? $order->customer->name : auth()->user()->name); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Date:</span>
                <span class="info-value"><?php echo e($order->created_at->format('M d, Y g:i A')); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value" style="color: #8B0000;"><?php echo e(strtoupper($order->status)); ?></span>
            </div>
        </div>

        <!-- Items -->
        <div class="items-section">
            <div class="section-header">Items Ordered</div>
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                    <div class="item-name"><?php echo e($item->product->name); ?></div>
                    <?php if($item->variant): ?>
                        <div class="item-variant">Variant: <?php echo e($item->variant->name); ?></div>
                    <?php endif; ?>
                    <div class="item-details">
                        <span class="item-qty"><?php echo e($item->quantity); ?> x ₱<?php echo e(number_format($item->unit_price, 2)); ?></span>
                        <span class="item-total">₱<?php echo e(number_format($item->total_price, 2)); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Totals -->
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
                <span class="total-label final-label">Total:</span>
                <span class="total-value final">₱<?php echo e(number_format($order->total, 2)); ?></span>
            </div>
        </div>

        <!-- Barcode -->
        <div class="barcode-section">
            <div class="barcode-container">
                <div class="barcode">
                    <?php
                        // Generate more bars for fuller width coverage - fake barcode pattern
                        $heights = [75, 45, 85, 55, 90, 40, 80, 60, 95, 50, 70, 88, 42, 78, 65, 92, 48, 82, 58, 86, 52, 76, 68, 84, 62, 94, 46, 72, 56, 89, 64, 81, 54, 91, 44, 74, 66, 87, 57, 93, 51, 79, 63, 83, 59, 77, 67, 85, 53, 88, 61, 96, 47, 73, 69, 82, 55, 90, 49, 71, 65, 86, 58, 92, 52, 78, 64, 88, 56, 84, 60, 94, 48, 76, 62, 89, 54, 81, 66, 91, 50, 75, 68, 87, 57, 93];
                    ?>
                    <?php $__currentLoopData = $heights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $height): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="barcode-bar" style="height: <?php echo e($height); ?>%;"></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="barcode-number">*<?php echo e(str_pad($order->id, 6, '0', STR_PAD_LEFT)); ?>*</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-section">
            <p class="thank-you">Thank You!</p>
            <p class="footer-text">For inquiries, contact the CICT Student Council Office</p>
            <p class="footer-text">This is an official receipt for your order</p>
            <p class="timestamp"><?php echo e(now()->format('Y-m-d H:i:s')); ?></p>
        </div>
    </div>

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
                    scale: 3,
                    useCORS: true,
                    logging: false,
                    backgroundColor: '#ffffff'
                });

                const { jsPDF } = window.jspdf;
                const imgData = canvas.toDataURL('image/png');
                
                const imgWidth = 210;
                const pageHeight = 297;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                
                const pdf = new jsPDF('p', 'mm', 'a4');
                
                let heightLeft = imgHeight;
                let position = 0;
                
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
                
                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save(`receipt-${orderId}.pdf`);

                btn.innerHTML = originalText;
                btn.disabled = false;
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Error generating PDF. Please try printing instead.');
                const btn = event.target;
                btn.innerHTML = '📥 Download';
                btn.disabled = false;
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\orders\pdf.blade.php ENDPATH**/ ?>