<x-app-layout>
    @section('title', $service->title . ' - CICT Merch')

    <style>
        body { background: #FFFAF1 !important; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        .page-shell {
            max-width: 1100px;
            margin: 0 auto;
            padding: 48px 24px 64px;
        }
        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            align-items: stretch;
        }
        .card {
            background: #fff;
            border: 1px solid #F0F0F0;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.06);
            padding: 28px;
        }
        .paper-card {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .paper-card.short { height: 300px; padding: 24px 28px; }
        .paper-card.standard { height: 420px; padding: 40px 28px; }
        .paper-card.long { height: 540px; padding: 56px 28px; }
        .paper-card:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.1); transform: translateY(-4px); border-color: #8B0000; }
        .paper-card h4 { color: #1a1a1a; font-weight: 700; margin: 0 0 16px; }
        .paper-card.short h4 { font-size: 1.6rem; }
        .paper-card.standard h4 { font-size: 2.2rem; }
        .paper-card.long h4 { font-size: 2.8rem; }
        .paper-badge {
            display: inline-block;
            background: #F0F0F0;
            color: #666666;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .paper-card-dims { color: #888; font-size: 13px; margin-bottom: 24px; font-weight: 500; }
        .price-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: auto; }
        .price-item { background: linear-gradient(135deg, #FAFAFA 0%, #F5F5F5 100%); padding: 24px 16px; border-radius: 10px; border: 1px solid #F0F0F0; transition: all 0.3s ease; display: flex; flex-direction: column; justify-content: center; min-height: 80px; }
        .price-item:hover { background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); border-color: #8B0000; }
        .price-item-label { font-size: 12px; color: #999999; margin-bottom: 8px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px; transition: color 0.3s ease; }
        .price-item:hover .price-item-label { color: rgba(255, 255, 255, 0.8); }
        .price-item-value { color: #8B0000; font-weight: 700; font-size: 20px; transition: color 0.3s ease; }
        .price-item:hover .price-item-value { color: #FFFFFF; }
        .back-link { color: #8B0000; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; }
    </style>

    <div class="page-shell" style="padding-top: 120px;">
        <div style="margin-bottom: 18px;">
            <a href="{{ route('services.index') }}" class="back-link">← Back to services</a>
        </div>

        <div class="card" style="margin-bottom: 32px; display:flex; flex-direction:column; gap:14px;">
            <div style="display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
                <div style="width:52px; height:52px; border-radius:12px; background:linear-gradient(135deg,#8B0000 0%,#A00000 100%); color:#fff; display:grid; place-items:center; font-size:28px;">{{ $service->icon ?? '🖨️' }}</div>
                <div>
                    <h1 style="margin:0; font-size:28px; font-weight:800;">{{ $service->title }}</h1>
                    <div style="color:#666; font-size:14px;">{{ $service->category ?? 'General' }}</div>
                </div>
            </div>
            <p style="margin:0; color:#444; line-height:1.6;">{{ $service->description }}</p>
        </div>

        @if($options->count())
            <div style="margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
                <div>
                    <h2 style="margin:0; font-size:22px; font-weight:800;">Options & Variants</h2>
                    <p style="margin:6px 0 0; color:#777;">Choose the variant that fits your need.</p>
                </div>
            </div>
            <div class="options-grid">
                @foreach($options as $option)
                    <div class="paper-card {{ $option->size_class ?? 'standard' }}">
                        @if($option->badge)
                            <span class="paper-badge">{{ $option->badge }}</span>
                        @endif
                        <h4 style="margin:0; font-weight:800; font-size:1.25rem; color:#1a1a1a;">{{ $option->name }}</h4>
                        @if($option->dimensions)
                            <div class="paper-card-dims">{{ $option->dimensions }}</div>
                        @endif
                        <div class="price-grid">
                            <div class="price-item">
                                <div class="price-item-label">{{ $option->price_bw_label ?? 'Price' }}</div>
                                <div class="price-item-value">{{ $option->price_bw ? '₱'.number_format($option->price_bw, 2) : '—' }}</div>
                            </div>
                            <div class="price-item">
                                <div class="price-item-label">{{ $option->price_color_label ?? 'Secondary' }}</div>
                                <div class="price-item-value">{{ $option->price_color ? '₱'.number_format($option->price_color, 2) : '—' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
