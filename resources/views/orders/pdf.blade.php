<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        :root {
            --ink: #0f172a;
            --muted: #475569;
            --border: rgba(15,23,42,0.08);
            --accent: #8B0000;
            --surface: #ffffff;
            --bg: #f8fafc;
        }

        body { background: var(--bg); margin:0; padding:24px; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        .page { max-width: 900px; margin: 0 auto; }
        .actions { display:flex; gap:10px; flex-wrap:wrap; justify-content:flex-end; margin-bottom:14px; }
        .btn { padding:10px 14px; border-radius:10px; border:1px solid var(--border); background:#fff; font-weight:700; cursor:pointer; text-decoration:none; color:var(--ink); }
        .btn.primary { background: linear-gradient(135deg, var(--accent), #A00000); color:#fff; border:none; box-shadow:0 12px 36px rgba(139,0,0,0.15); }
        .btn.secondary { color: var(--accent); border-color: var(--accent); }
        .btn:disabled { opacity:0.7; cursor:not-allowed; }

        .paper { background: var(--surface); border:1px solid var(--border); border-radius:14px; box-shadow:0 20px 60px rgba(15,23,42,0.08); padding:28px; }
        .header { display:flex; justify-content:space-between; gap:16px; border-bottom:2px solid var(--border); padding-bottom:14px; margin-bottom:14px; }
        .brand { font-weight:900; font-size:22px; color:var(--accent); letter-spacing:-0.3px; }
        .tagline { color:var(--muted); font-size:12px; margin-top:4px; }
        .title { text-align:center; margin:10px 0 4px 0; font-size:22px; font-weight:900; color:var(--ink); }
        .subline { text-align:center; color:var(--muted); font-weight:700; font-size:13px; margin:0 0 18px 0; }

        .grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); gap:12px; margin-bottom:18px; }
        .panel { border:1px solid var(--border); border-radius:12px; padding:12px; }
        .label { text-transform: uppercase; letter-spacing:0.14em; font-size:11px; font-weight:800; color:var(--muted); margin-bottom:6px; }
        .value { font-weight:800; color:var(--ink); font-size:15px; }
        .value.small { font-weight:700; color:var(--muted); font-size:13px; }

        table { width:100%; border-collapse:collapse; margin-top:4px; }
        thead th { text-align:left; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); padding:10px 8px; border-bottom:1px solid var(--border); }
        tbody td { padding:10px 8px; font-size:13px; color:var(--ink); border-bottom:1px solid var(--border); }
        .text-right { text-align:right; }
        .text-center { text-align:center; }
        .muted { color:var(--muted); font-weight:600; font-size:12px; }

        .totals { margin-top:14px; border-top:1px solid var(--border); padding-top:10px; }
        .total-row { display:flex; justify-content:flex-end; gap:16px; padding:6px 0; font-weight:700; color:var(--muted); }
        .total-row strong { color:var(--ink); min-width:140px; text-align:right; }
        .grand { font-size:18px; color:var(--accent); }

        .barcode { margin-top:16px; padding:12px; border:1px dashed var(--border); border-radius:10px; text-align:center; color:var(--muted); font-weight:700; }
        .footer { margin-top:16px; border-top:1px solid var(--border); padding-top:10px; color:var(--muted); font-weight:600; font-size:12px; text-align:center; }

        @media print {
            body { background:#fff; padding:0; }
            .actions { display:none !important; }
            .page { padding:0; margin:0; }
            .paper { box-shadow:none; border:1px solid #d1d5db; border-radius:0; }
            @page { size: A4; margin: 12mm; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="actions">
            <a href="{{ route('account.orders') }}" class="btn secondary">Back to orders</a>
            <button class="btn" onclick="window.print()">Print</button>
            <button class="btn primary" id="pdf-btn" onclick="generatePDF(event)">Download PDF</button>
        </div>

        <div class="paper" id="receipt-content">
            <div class="header">
                <div>
                    <div class="brand">{{ config('app.name', 'IGP Hub') }}</div>
                    <div class="tagline">Official receipt • CICT Student Council Office</div>
                </div>
                <div style="text-align:right;">
                    <div class="value">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                    <div class="value small">{{ $order->created_at->format('M d, Y \a\t g:i A') }}</div>
                </div>
            </div>

            <div class="title">Payment Receipt</div>
            <div class="subline">Status: {{ ucfirst($order->status) }}</div>

            <div class="grid">
                <div class="panel">
                    <div class="label">Bill to</div>
                    <div class="value">{{ $order->customer ? $order->customer->name : auth()->user()->name }}</div>
                    <div class="value small">{{ $order->customer ? $order->customer->email : auth()->user()->email }}</div>
                </div>
                <div class="panel">
                    <div class="label">Fulfillment</div>
                    <div class="value">Pickup</div>
                    <div class="value small">CICT Student Council Office · Mon–Fri, 8:00 AM – 5:00 PM</div>
                </div>
                <div class="panel">
                    <div class="label">Reference</div>
                    <div class="value">{{ strtoupper(substr(md5($order->id . $order->created_at), 0, 8)) }}</div>
                    <div class="value small">Keep this for verification</div>
                </div>
            </div>

            <div class="panel" style="padding:0; border:none;">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th class="text-center" style="width:80px;">Qty</th>
                            <th class="text-right" style="width:120px;">Unit</th>
                            <th class="text-right" style="width:120px;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="value" style="font-size:13px;">{{ optional($item->product)->name ?? $item->product_name ?? 'Product' }}</div>
                                    @if($item->variant || $item->variant_name)
                                        <div class="muted">Variant: {{ optional($item->variant)->name ?? $item->variant_name }}</div>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">₱{{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-right">₱{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="totals">
                <div class="total-row"><span class="muted">Subtotal</span><strong>₱{{ number_format($order->items->sum('total_price'), 2) }}</strong></div>
                @if($order->discount > 0)
                    <div class="total-row"><span class="muted">Discount</span><strong>-₱{{ number_format($order->discount, 2) }}</strong></div>
                @endif
                <div class="total-row grand"><span class="muted">Total due</span><strong>₱{{ number_format($order->total, 2) }}</strong></div>
            </div>

            <div class="barcode">Receipt timestamp {{ now()->format('M d, Y \a\t g:i A') }}</div>
            <div class="footer">Please present this receipt when claiming items. For questions, visit the CICT Student Council Office.</div>
        </div>
    </div>

    <script>
        async function generatePDF(event) {
            const btn = event?.target;
            if (btn) { btn.disabled = true; btn.textContent = 'Generating...'; }

            try {
                const receiptElement = document.getElementById('receipt-content');
                const orderId = '{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}';

                const canvas = await html2canvas(receiptElement, { scale: 2, useCORS: true, logging: false, backgroundColor: '#ffffff' });
                const { jsPDF } = window.jspdf;
                const imgData = canvas.toDataURL('image/png');

                const pdf = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });
                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const imgWidth = pageWidth;
                const imgHeight = canvas.height * (imgWidth / canvas.width);
                const yOffset = Math.max((pageHeight - imgHeight) / 2, 10);

                pdf.addImage(imgData, 'PNG', 0, yOffset, imgWidth, imgHeight);
                pdf.save(`receipt-${orderId}.pdf`);
            } catch (error) {
                console.error('PDF generation failed', error);
                alert('Could not generate PDF. Please try again.');
            } finally {
                if (btn) { btn.disabled = false; btn.textContent = 'Download PDF'; }
            }
        }
    </script>
</body>
</html>
