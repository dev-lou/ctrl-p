<x-app-layout>
    @section('title', 'Services - CICT Merch')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap');

        body { background: #F8FAFC !important; font-family: 'Inter', sans-serif; color: #111827; font-size: 16px; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }

        .section-title { color: #0F172A !important; font-weight: 800; font-size: 2.1rem; margin-bottom: 8px; letter-spacing: -0.35px; }
        .section-subtitle { color: #6B7280 !important; font-size: 0.96rem; font-weight: 500; margin-bottom: 28px; }
        @media (max-width: 768px) { .section-title, .section-subtitle { text-align: center; } }

        .bento-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; grid-auto-flow: dense; grid-auto-rows: minmax(200px, auto); }
        @media (max-width: 1024px) { .bento-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 640px) { .bento-grid { grid-template-columns: 1fr; } }

        .bento-card { background: #FFFFFF; border: 1px solid #E5E7EB; box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06); border-radius: 14px; padding: 20px; display: flex; flex-direction: column; gap: 10px; min-height: 200px; transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; align-items: flex-start; }
        .bento-card:hover { box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08); transform: translateY(-3px); border-color: #8B0000; }

        .service-card { background: #FFFFFF; border: 1px solid #E5E7EB; box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06); border-radius: 14px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden; }
        .service-card:hover { box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08); transform: translateY(-3px); border-color: #8B0000; }

        .service-card h3, .bento-card h3 { color: #0F172A; font-weight: 800; font-size: 1.08rem; margin: 0; letter-spacing: -0.15px; }
        .service-card p, .bento-card p { color: #4B5563; font-size: 14px; line-height: 1.6; margin: 0; }

        .service-icon { background: #FCEEEF; color: #8B0000; border: 1px solid #F4D8D8; border-radius: 12px; margin: 0; }

        .price-display { background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); color: #FFFFFF; padding: 12px 14px; border-radius: 12px; margin-top: 10px; text-align: left; border: 1px solid rgba(255, 255, 255, 0.14); box-shadow: 0 10px 24px rgba(139, 0, 0, 0.25); }
        .price-display p { color: #FFFFFF !important; margin: 0; font-size: 12.5px; }

        .price-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: auto; }
        .price-item { background: #F7F8FB; border: 1px solid #E8EBF0; border-radius: 12px; padding: 14px; display: flex; flex-direction: column; gap: 4px; transition: all 0.2s ease; }
        .price-item-label { font-size: 11.5px; color: #667085; text-transform: uppercase; letter-spacing: 0.4px; font-weight: 700; }
        .price-item-value { color: #8B0000; font-weight: 800; font-size: 17px; }
        .price-item:hover { border-color: #8B0000; box-shadow: 0 10px 24px rgba(15,23,42,0.10); }

        .paper-badge { display: inline-block; background: #FCEEEF; color: #8B0000; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; }

        .instruction-card { background: #FFFFFF; border: 1px solid #E8EBF0; border-radius: 16px; box-shadow: 0 12px 36px rgba(15, 23, 42, 0.06); padding: 44px; margin-bottom: 32px; }
        .instruction-steps { display: grid; grid-template-columns: repeat(2, 1fr); gap: 32px; margin-bottom: 28px; }
        @media (max-width: 768px) { .instruction-steps { grid-template-columns: repeat(2, 1fr); gap: 16px; } }
        .instruction-step { display: flex; flex-direction: column; align-items: center; text-align: center; gap: 10px; }
        .step-number { background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); color: #FFFFFF; width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px; }
        .step-content h4 { color: #0F172A !important; font-weight: 800; font-size: 1.05rem; margin: 0; }
        .step-content p { color: #475467 !important; font-size: 14px; line-height: 1.6; margin: 0; }
        .cta-section { text-align: center; margin-top: 36px; padding-top: 24px; border-top: 1px solid #E8EBF0; }

        .messenger-btn { display: inline-block; background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); color: #FFFFFF; padding: 14px 38px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 15px; transition: all 0.3s ease; box-shadow: 0 10px 24px rgba(139, 0, 0, 0.24); }
        .messenger-btn:hover { transform: translateY(-2px); box-shadow: 0 14px 30px rgba(139, 0, 0, 0.28); }

        .officer-card { background: #FFFFFF; border: 1px solid #E8EBF0; border-radius: 14px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06); padding: 26px 22px; text-align: center; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column; gap: 8px; min-height: 200px; }
        .officer-card:hover { box-shadow: 0 14px 34px rgba(15, 23, 42, 0.1); transform: translateY(-3px); border-color: #8B0000; }
        .officer-name { color: #0F172A !important; font-weight: 800; font-size: 1.08rem; margin: 0; letter-spacing: -0.1px; }
        .officer-title { color: #8B0000 !important; font-weight: 700; font-size: 11.5px; letter-spacing: 0.6px; margin: 0; text-transform: uppercase; }
        .officer-btn { display: inline-block; background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); color: #FFFFFF; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; transition: all 0.3s ease; box-shadow: 0 10px 24px rgba(139, 0, 0, 0.18); }
        .officer-btn:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(139, 0, 0, 0.24); }
        .officer-notice { background: #FFFFFF; border: 1px solid #E8EBF0; border-radius: 12px; padding: 22px; margin-top: 28px; font-size: 15px; color: #475467 !important; line-height: 1.7; text-align: center; box-shadow: inset 0 1px 0 #F4F5F7; }
        .officer-notice strong { color: #8B0000 !important; font-size: 16px; }

        .hours-card { background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); border-radius: 14px; box-shadow: 0 12px 30px rgba(139, 0, 0, 0.2); padding: 48px 32px; text-align: center; margin-top: 48px; }
        .hours-card h3 { color: #FFFFFF !important; font-weight: 800; font-size: 1.8rem; margin-bottom: 12px; }
        .hours-content { color: rgba(255, 255, 255, 0.95) !important; font-size: 16px; font-weight: 500; line-height: 1.8; margin: 0; }
        .hours-time { color: #FFFFFF !important; font-weight: 800; font-size: 20px; margin: 8px 0; }
        .hours-note { color: rgba(255, 255, 255, 0.8) !important; font-size: 13px; margin-top: 12px; }
    </style>
    
    <!-- Hero Section -->
    <div style="background: linear-gradient(135deg, rgba(139, 0, 0, 0.88) 0%, rgba(160, 0, 0, 0.86) 100%), url('https://www.sumnerone.com/hs-fs/hubfs/Essential%20Printing%20Services%20_%20SumnerOne.jpg?width=663&height=347&name=Essential%20Printing%20Services%20_%20SumnerOne.jpg') center/cover; min-height: 85vh; display: flex; align-items: center; justify-content: center; position: relative; margin-top: -80px; padding-top: 220px; padding-bottom: 140px; border-radius: 0 0 32px 32px; box-shadow: inset 0 -80px 160px rgba(0,0,0,0.18);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="text-align: center; color: white; z-index: 10;">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="mb-4 mt-8" style="font-size: 56px; font-weight: 900; color: #FFFFFF; text-shadow: 0 4px 12px rgba(0, 0, 0, 0.4); letter-spacing: -2px;">Services & Solutions</h1>
                <p style="font-size: 20px; color: rgba(255, 255, 255, 0.95); max-width: 600px; margin: 0 auto; text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);">Print, IT, and digital support for students, orgs, and events   fast and reliable</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div style="background: #F7F8FB; min-height: auto; width: 100%; padding-top: 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="background: #F7F8FB; padding: 80px 0;">
        
        <!-- Services grouped by category -->
        @forelse($groupedServices as $category => $categoryServices)
        <div style="margin-bottom: 96px;">
            <h2 class="section-title">{{ $category }}</h2>
            @php $catDesc = $categoryDescriptions[$category] ?? null; @endphp
            <p class="section-subtitle">{{ $catDesc ?: 'Pick a service to get a quick quote and timeline' }}</p>
            <div class="bento-grid">
                @foreach($categoryServices as $service)
                    @php
                        $startingPrice = $service->price_bw ?? $service->price_color;
                        $priceLabel = $service->price_label ? $service->price_label : 'per unit';
                    @endphp
                    <div class="bento-card reveal-on-scroll" data-reveal-delay="0">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="service-icon w-14 h-14 rounded-lg flex items-center justify-center">
                                <span style="font-size: 26px;">{{ $service->icon ?? '🖨️' }}</span>
                            </div>
                            <div>
                                <h3 style="margin:0;">{{ $service->title }}</h3>
                                <div style="color:#8B0000; font-weight:700; font-size:12px; letter-spacing:0.5px; text-transform:uppercase;">{{ $service->category ?? 'Service' }}</div>
                            </div>
                        </div>
                        <p style="margin:0; color:#555; line-height:1.7;">{{ $service->description }}</p>
                        @if($startingPrice)
                        <div class="price-display" style="margin-top:auto;">
                            <p style="font-size: 13px; opacity: 0.9; margin-bottom: 4px;">Starting from</p>
                            <p style="font-size: 26px; font-weight: 800;">₱{{ number_format($startingPrice, 2) }}/{{ $priceLabel }}</p>
                        </div>
                        @endif
                        @if($service->options && $service->options->count())
                            <div style="margin-top: 14px;">
                                <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center gap-2 text-[#8B0000] font-semibold hover:underline">
                                    View details
                                    <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @empty
            <div class="text-center text-gray-500" style="margin-bottom: 96px;">No services available right now.</div>
        @endforelse

        <!-- Submission Instructions Section -->
        <div style="margin-bottom: 96px;">
            <h2 class="section-title">How to Place a Service Request</h2>
            <p class="section-subtitle">A simple 4-step flow for any service we offer</p>
            <div class="instruction-card reveal-on-scroll" data-reveal-delay="0">
                <div class="instruction-steps">
                    <div class="instruction-step reveal-on-scroll" data-reveal-delay="0">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Tell us what you need</h4>
                            <p>Share the service type and the outcome you're aiming for</p>
                        </div>
                    </div>

                    <div class="instruction-step reveal-on-scroll" data-reveal-delay="100">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Send files or details</h4>
                            <p>Upload documents, specs, sizes, or reference photos</p>
                        </div>
                    </div>

                    <div class="instruction-step reveal-on-scroll" data-reveal-delay="200">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>We confirm price & timing</h4>
                            <p>We’ll reply with cost, options, and schedule before we start</p>
                        </div>
                    </div>

                    <div class="instruction-step reveal-on-scroll" data-reveal-delay="300">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h4>Approve & receive</h4>
                            <p>Approve the quote, then pick up or receive the completed work</p>
                        </div>
                    </div>
                </div>

                <div class="cta-section">
                    <a href="https://www.messenger.com/e2ee/t/780806171591045" target="_blank" class="messenger-btn">
                        <svg class="w-4 h-4 inline-block mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.42.09.574-.182.574-.407v-1.77c-2.84.603-3.437-1.184-3.437-1.184-.38-.975-.93-1.235-.93-1.235-.76-.52.056-.508.056-.508.847.06 1.293.867 1.293.867.75 1.288 1.96.916 2.44.7.075-.546.292-.916.532-1.126-1.855-.21-3.8-.927-3.8-4.106 0-.91.325-1.655.865-2.242-.087-.21-.375-1.056.082-2.2 0 0 .704-.224 2.304.848.668-.186 1.383-.278 2.093-.282.71.004 1.425.096 2.093.282 1.6-1.072 2.303-.848 2.303-.848.457 1.144.17 1.99.084 2.2.54.587.865 1.332.865 2.242 0 3.188-1.948 3.893-3.81 4.098.3.258.573.77.573 1.55v2.3c0 .227.153.502.576.407C20.565 21.795 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                        </svg>
                        Chat with us on Messenger
                    </a>
                </div>
            </div>
        </div>

        <!-- Officers in Charge Section -->
        <div style="margin-bottom: 96px;">
            <h2 class="section-title">Service Contacts</h2>
            <p class="section-subtitle">Reach our team for printing, IT, or digital requests</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($officers as $officer)
                    <div class="officer-card reveal-on-scroll" data-reveal-delay="0">
                        <h4 class="officer-name">{{ $officer->name }}</h4>
                        <p class="officer-title">{{ $officer->title ?? 'SERVICE OFFICER' }}</p>
                        @if($officer->messenger_url)
                            <a href="{{ $officer->messenger_url }}" target="_blank" class="officer-btn">Message on FB</a>
                        @else
                            <span style="color: #666666; font-size: 14px;">No messenger link available.</span>
                        @endif
                    </div>
                @empty
                    <div class="col-span-4 text-center text-gray-500">Officers are being updated. Please check back soon.</div>
                @endforelse
            </div>

            <div class="officer-notice">
                <p><strong>📌 Important Note</strong></p>
                <p>If the Student Council office is closed, please contact any of our officers directly via Facebook Messenger for assistance with any service request.</p>
            </div>
        </div>

        <!-- Operating Hours Section -->
        <div class="hours-card reveal-on-scroll" data-reveal-delay="0">
            <h3>Operating Hours</h3>
            <div class="hours-content">
                <p style="margin: 0;">Monday – Friday</p>
                <p class="hours-time">8:00 AM – 5:00 PM</p>
                <p class="hours-note">Closed on weekends and holidays</p>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
