<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales Receipt #{{ $order->id }}</title>
    <style>
        /* CRITICAL FIX: Use DejaVu Sans for Unicode Support */
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path("fonts/DejaVuSans.ttf") }}') format("truetype");
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path("fonts/DejaVuSans-Bold.ttf") }}') format("truetype");
            font-weight: bold;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Apply the new font globally */
        html, body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #1a1a1a;
            line-height: 1.5;
            background: white;
        }

        @page {
            size: A4 portrait;
            margin: 20mm;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .receipt-container {
            width: 100%;
            margin: 0;
            padding: 0;
            font-size: 11px;
            line-height: 1.4;
            page-break-inside: avoid;
        }

        /* ============================================
           SECTION 1: HEADER BLOCK (Fixed Height)
           ============================================ */
        .header-section {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 12px 8px;
            border-bottom: 2px solid #8b0000;
            page-break-inside: avoid;
            text-align: center;
        }

        .header-left {
            display: block;
            margin-bottom: 8px;
        }

        .header-right {
            display: block;
            text-align: center;
        }

        .business-info h1 {
            font-size: 24px;
            font-weight: 900;
            color: #8b0000;
            margin-bottom: 2px;
            margin-left: 0;
            letter-spacing: 1px;
        }

        .business-info p {
            font-size: 10px;
            color: #000000;
            margin-bottom: 1px;
            margin-left: 0;
            font-weight: 600;
        }

        .document-info h2 {
            font-size: 13px;
            font-weight: 800;
            color: #8b0000;
            margin-bottom: 6px;
            letter-spacing: 1px;
            margin-right: 0;
            margin-top: 8px;
        }

        .document-info-row {
            font-size: 10px;
            margin-bottom: 3px;
            color: #000000;
            margin-right: 0;
            display: block;
            font-weight: 600;
        }

        .document-info-row strong {
            font-weight: 700;
            color: #8b0000;
        }

        .receipt-number {
            font-size: 18px;
            font-weight: 900;
            color: #8b0000;
            margin-top: 8px;
            margin-right: 0;
            display: block;
            letter-spacing: 0.5px;
        }

        /* ============================================
           SECTION 2: CUSTOMER & ORDER INFO BLOCK
           ============================================ */
        .customer-order-section {
            display: table;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px 8px;
            border-bottom: 1px solid #d0d0d0;
            page-break-inside: avoid;
        }

        .customer-info {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }

        .order-info {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: left;
        }

        .info-block-label {
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            color: #8b0000;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }

        .info-block-content {
            font-size: 10px;
            color: #000000;
            margin-bottom: 2px;
        }

        .info-block-content strong {
            font-weight: 700;
            color: #000000;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .status-pending {
            background-color: #ffe6e6;
            color: #8b0000;
        }

        .status-confirmed {
            background-color: #ffe6e6;
            color: #8b0000;
        }

        .status-completed {
            background-color: #ffe6e6;
            color: #8b0000;
        }

        .status-cancelled {
            background-color: #ffe6e6;
            color: #8b0000;
        }

        /* ============================================
           SECTION 3: LINE ITEMS TABLE (Main Content)
           ============================================ */
        .items-section {
            margin-bottom: 15px;
            page-break-inside: avoid;
            padding: 0 8px;
        }

        .items-section-title {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            color: #8b0000;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .items-table thead {
            background-color: #8b0000;
            color: white;
        }

        .items-table thead th {
            padding: 6px 4px;
            text-align: left;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border: 1px solid #8b0000;
        }

        .items-table thead th.text-center {
            text-align: center;
        }

        .items-table thead th.text-right {
            text-align: right;
            padding-right: 6px;
        }

        .items-table tbody tr {
            border-bottom: 1px solid #e0e0e0;
        }

        .items-table tbody tr:nth-child(odd) {
            background-color: #fafafa;
        }

        .items-table tbody td {
            padding: 5px 4px;
            font-size: 10px;
            color: #000000;
        }

        .items-table tbody td.text-center {
            text-align: center;
        }

        .items-table tbody td.text-right {
            text-align: right;
            padding-right: 6px;
        }

        .item-number {
            font-weight: 700;
            color: #8b0000;
        }

        .item-name {
            font-weight: 700;
            color: #000000;
        }

        .item-variant {
            font-size: 9px;
            color: #555555;
            margin-top: 1px;
        }

        .item-price {
            font-weight: 700;
            color: #2d3748;
        }

        /* ============================================
           SECTION 4: SUMMARY & FOOTER BLOCK
           ============================================ */
        .summary-footer-section {
            display: table;
            width: 100%;
            margin-top: 15px;
            page-break-inside: avoid;
            padding: 0 8px;
        }

        .summary-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }

        .summary-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .terms-section {
            font-size: 9px;
            color: #000000;
            padding: 10px;
            background-color: #ffffff;
            border-left: 3px solid #8b0000;
            border-radius: 2px;
            line-height: 1.4;
        }

        .terms-title {
            font-weight: 700;
            color: #8b0000;
            margin-bottom: 4px;
            font-size: 9px;
            text-transform: uppercase;
        }

        .terms-content {
            font-size: 8px;
            line-height: 1.3;
        }

        .financial-summary {
            margin-bottom: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
            font-size: 10px;
            color: #000000;
            border-bottom: 1px dotted #d0d0d0;
        }

        .summary-row-label {
            font-weight: 600;
        }

        .summary-row-value {
            font-weight: 700;
            text-align: right;
            color: #8b0000;
        }

        .summary-row.discount .summary-row-value {
            color: #0369a1;
        }

        .summary-row.tax .summary-row-value {
            color: #2d3748;
        }

        .summary-row.grand-total {
            padding: 8px;
            font-size: 12px;
            font-weight: 800;
            color: white;
            background: linear-gradient(135deg, #8b0000 0%, #a50000 100%);
            border: none;
            border-radius: 3px;
            margin-top: 5px;
        }

        .summary-row.grand-total .summary-row-label {
            font-size: 12px;
            color: white;
        }

        .summary-row.grand-total .summary-row-value {
            font-size: 14px;
            color: #FFFFFF;
        }

        .payment-info {
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px solid #d0d0d0;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 10px;
        }

        .payment-row-label {
            font-weight: 600;
            color: #000000;
        }

        .payment-row-value {
            font-weight: 700;
            color: #8b0000;
        }

        /* ============================================
           PAGE FOOTER
           ============================================ */
        .page-footer {
            margin-top: 20px;
            padding-top: 10px;
            padding-left: 8px;
            padding-right: 8px;
            border-top: 2px solid #8b0000;
            text-align: center;
            font-size: 9px;
            color: #000000;
            page-break-inside: avoid;
        }

        .footer-text {
            font-weight: 700;
            color: #8b0000;
            margin-bottom: 2px;
        }

        .footer-subtext {
            font-size: 8px;
            color: #718096;
            margin-bottom: 2px;
        }

        .footer-timestamp {
            font-size: 8px;
            color: #a0aec0;
            margin-top: 3px;
        }

        @media print {
            html, body {
                margin: 0;
                padding: 0;
                width: 100%;
            }
            .receipt-container {
                box-shadow: none;
                margin: 0;
                padding: 0;
            }
            * {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        
        <!-- ============================================
             SECTION 1: HEADER BLOCK
             ============================================ -->
        <div class="header-section">
            <div class="header-left">
                <div class="business-info">
                    <h1>{{ strtoupper(config('app.name', 'IGP Hub')) }}</h1>
                    <p>Student Council Office</p>
                    <p>Official Sales Receipt</p>
                </div>
            </div>
            <div class="header-right">
                <div class="document-info">
                    <h2>SALES RECEIPT</h2>
                    <div class="document-info-row"><strong>Receipt #:</strong> IGP-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }} <strong style="margin-left: 15px;">Date:</strong> {{ $order->created_at->format('M d, Y') }} <strong style="margin-left: 15px;">Time:</strong> {{ $order->created_at->format('g:i A') }} <strong style="margin-left: 15px;">Payment:</strong> Cash/GCash</div>
                    <div class="receipt-number">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                </div>
            </div>
        </div>

        <!-- ============================================
             SECTION 2: CUSTOMER & ORDER INFO
             ============================================ -->
        <div class="customer-order-section">
            <div class="customer-info">
                <div class="info-block-label">Sold To:</div>
                <div class="info-block-content">
                    <strong>{{ $order->customer ? $order->customer->name : 'N/A' }}</strong>
                </div>
                <div class="info-block-content">
                    {{ $order->customer ? $order->customer->email : 'N/A' }}
                </div>
                @if($order->customer && $order->customer->phone)
                    <div class="info-block-content">
                        {{ $order->customer->phone }}
                    </div>
                @endif
            </div>
            <div class="order-info">
                <div class="info-block-label">Order ID:</div>
                <div class="info-block-content">
                    <strong>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong>
                </div>
                <div class="info-block-label" style="margin-top: 4px;">Status:</div>
                <span class="status-badge status-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                <div class="info-block-label" style="margin-top: 4px;">Processed By:</div>
                <div class="info-block-content">Student Council Staff</div>
            </div>
        </div>

        <!-- ============================================
             SECTION 3: LINE ITEMS TABLE
             ============================================ -->
        <div class="items-section">
            <div class="items-section-title">Line Items</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 40%;">Product / Service Description</th>
                        <th style="width: 20%;">Variant / Notes</th>
                        <th class="text-center" style="width: 8%;">Qty.</th>
                        <th class="text-right" style="width: 13%;">Unit Price</th>
                        <th class="text-right" style="width: 14%;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $index => $item)
                        <tr>
                            <td class="item-number">{{ $index + 1 }}</td>
                            <td>
                                <span class="item-name">{{ substr(optional($item->product)->name ?? $item->product_name ?? 'Product', 0, 35) }}</span>
                            </td>
                            <td>
                                @if($item->variant || $item->variant_name)
                                    <span class="item-variant">{{ substr(optional($item->variant)->name ?? $item->variant_name, 0, 25) }}</span>
                                @else
                                    <span class="item-variant">Standard</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-right">
                                <span class="item-price">₱{{ number_format($item->unit_price, 2) }}</span>
                            </td>
                            <td class="text-right">
                                <span class="item-price">₱{{ number_format($item->total_price, 2) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ============================================
             SECTION 4: SUMMARY & FOOTER
             ============================================ -->
        <div class="summary-footer-section">
            <div class="summary-left">
                <div class="terms-section">
                    <div class="terms-title">Terms & Conditions</div>
                    <div class="terms-content">
                        • All services are final and non-refundable<br>
                        • Merchandise must be collected within 7 days<br>
                        • Keep receipt for warranty and exchange claims<br>
                        • For concerns, contact Student Council Office
                    </div>
                </div>
            </div>
            <div class="summary-right">
                <div class="financial-summary">
                    <div class="summary-row">
                        <span class="summary-row-label">Subtotal:</span>
                        <span class="summary-row-value">₱{{ number_format($order->items->sum('total_price'), 2) }}</span>
                    </div>
                    @if($order->discount > 0)
                        <div class="summary-row discount">
                            <span class="summary-row-label">Discount:</span>
                            <span class="summary-row-value">-₱{{ number_format($order->discount, 2) }}</span>
                        </div>
                    @endif
                    <div class="summary-row grand-total">
                        <span class="summary-row-label">GRAND TOTAL:</span>
                        <span class="summary-row-value">₱{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                <div class="payment-info">
                    <div class="payment-row">
                        <span class="payment-row-label">Amount Paid:</span>
                        <span class="payment-row-value">₱{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================
             PAGE FOOTER
             ============================================ -->
        <div class="page-footer">
            <p class="footer-text">Thank you for your purchase!</p>
            <p class="footer-subtext">{{ config('app.name', 'IGP Hub') }} - Student Council Merchandise & Services</p>
            <p class="footer-timestamp">Generated {{ now()->format('M d, Y H:i:s') }} • Receipt #IGP-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>

    </div>
</body>
</html>
