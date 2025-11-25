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
    <?php $__env->startSection('title', 'Services - CICT Merch'); ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap');

        body {
            background: #FFFAF1 !important;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* Section Headers */
        .section-title {
            color: #1a1a1a !important;
            font-weight: 700;
            font-size: 2.25rem;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .section-subtitle {
            color: #888888 !important;
            font-size: 1rem;
            font-weight: 400;
            margin-bottom: 48px;
        }

        .services-hero {
            background: transparent !important;
        }

        .service-card {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .service-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
            border-color: #8B0000;
        }

        .service-card h3 {
            color: #1a1a1a !important;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.35rem;
            margin-bottom: 12px;
        }

        .service-card p {
            color: #666666 !important;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 0;
        }

        .service-icon {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            border-radius: 10px;
        }

        .price-display {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            padding: 20px;
            border-radius: 10px;
            margin-top: 16px;
            text-align: center;
        }

        .price-display p {
            color: #FFFFFF !important;
            margin: 0;
        }

        /* Paper Size Card */
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

        .paper-card.short {
            height: 300px;
            padding: 24px 28px;
        }

        .paper-card.standard {
            height: 420px;
            padding: 40px 28px;
        }

        .paper-card.long {
            height: 540px;
            padding: 56px 28px;
        }

        .paper-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
            border-color: #8B0000;
        }

        .paper-card h4 {
            color: #1a1a1a !important;
            font-weight: 700;
            margin-bottom: 16px;
            margin-top: 0;
        }

        .paper-card.short h4 {
            font-size: 1.6rem;
        }

        .paper-card.standard h4 {
            font-size: 2.2rem;
        }

        .paper-card.long h4 {
            font-size: 2.8rem;
        }

        .paper-card-dims {
            color: #888888 !important;
            font-size: 13px;
            margin-bottom: 24px;
            font-weight: 500;
        }

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

        .price-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: auto;
        }

        .price-item {
            background: linear-gradient(135deg, #FAFAFA 0%, #F5F5F5 100%);
            padding: 24px 16px;
            border-radius: 10px;
            border: 1px solid #F0F0F0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 80px;
        }

        .price-item:hover {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            border-color: #8B0000;
        }

        .price-item-label {
            font-size: 12px;
            color: #999999 !important;
            margin-bottom: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            transition: color 0.3s ease;
        }

        .price-item:hover .price-item-label {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .price-item-value {
            color: #8B0000 !important;
            font-weight: 700;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .price-item:hover .price-item-value {
            color: #FFFFFF !important;
        }

        /* Instructions Section */
        .instruction-card {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 48px;
            margin-bottom: 32px;
        }

        .instruction-steps {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 48px;
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .instruction-steps {
                grid-template-columns: 1fr;
                gap: 32px;
            }
        }

        .instruction-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .step-number {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 16px;
            flex-shrink: 0;
        }

        .step-content h4 {
            color: #1a1a1a !important;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .step-content p {
            color: #666666 !important;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .cta-section {
            text-align: center;
            margin-top: 40px;
            padding-top: 32px;
            border-top: 1px solid #F0F0F0;
        }

        .messenger-btn {
            display: inline-block;
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            padding: 14px 40px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(139, 0, 0, 0.2);
        }

        .messenger-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(139, 0, 0, 0.3);
        }

        /* Officers Section */
        .officer-card {
            background: #FFFFFF;
            border: 1px solid #F0F0F0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 32px 28px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 200px;
        }

        .officer-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
            border-color: #8B0000;
        }

        .officer-name {
            color: #1a1a1a !important;
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 6px;
            margin-top: 0;
        }

        .officer-title {
            color: #8B0000 !important;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .officer-btn {
            display: inline-block;
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            color: #FFFFFF;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(139, 0, 0, 0.2);
        }

        .officer-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.3);
        }

        .officer-notice {
            background: linear-gradient(135deg, #FFF9F0 0%, #FFFBF5 100%);
            border: 2px solid #FFD9B3;
            border-radius: 12px;
            padding: 24px;
            margin-top: 32px;
            font-size: 15px;
            color: #333333 !important;
            line-height: 1.8;
            text-align: center;
        }

        .officer-notice strong {
            color: #8B0000 !important;
            font-size: 16px;
        }

        .officer-notice p {
            margin: 0;
            color: #555555 !important;
        }

        /* Hours Section */
        .hours-card {
            background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(139, 0, 0, 0.15);
            padding: 48px 32px;
            text-align: center;
            margin-top: 48px;
        }

        .hours-card h3 {
            color: #FFFFFF !important;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 12px;
        }

        .hours-content {
            color: rgba(255, 255, 255, 0.95) !important;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.8;
            margin: 0;
        }

        .hours-time {
            color: #FFFFFF !important;
            font-weight: 700;
            font-size: 20px;
            margin: 8px 0;
        }

        .hours-note {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 13px;
            margin-top: 12px;
        }

        /* Hero Typography */
        .services-hero h1 {
            font-family: 'Poppins', sans-serif;
        }

        .services-hero p {
        }
    </style>
    
    <!-- Hero Section -->
    <div style="background: linear-gradient(135deg, rgba(139, 0, 0, 0.9) 0%, rgba(160, 0, 0, 0.9) 100%), url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=1200&h=500&fit=crop') center/cover; min-height: 550px; display: flex; align-items: center; justify-content: center; position: relative; margin-top: 0;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="text-align: center; color: white; z-index: 10;">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="mb-4 mt-8" style="font-size: 56px; font-weight: 900; color: #FFFFFF; text-shadow: 0 4px 12px rgba(0, 0, 0, 0.4); letter-spacing: -2px;">Printing Services</h1>
                <p style="font-size: 20px; color: rgba(255, 255, 255, 0.95); max-width: 600px; margin: 0 auto; text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);">Fast, affordable, and professional printing solutions for all your needs</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div style="background: #FFFAF1; min-height: auto; width: 100%; padding-top: 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="background: #FFFAF1; padding: 80px 0;">
        
        <!-- Service Options Section -->
        <div style="margin-bottom: 96px;">
            <h2 class="section-title">Service Options</h2>
            <p class="section-subtitle">Choose between black & white or vibrant color printing</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Black & White Printing -->
                <div class="service-card p-8 reveal-on-scroll" data-reveal-delay="0">
                    <div class="service-icon w-16 h-16 rounded-lg flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m0 0H7m10 0v2a2 2 0 01-2 2H9a2 2 0 01-2-2v-2m6-4V9a2 2 0 00-2-2m0 0V7a2 2 0 00-2-2m0 0H7a2 2 0 00-2 2v4m0 0v2a2 2 0 002 2h10a2 2 0 002-2v-2"></path>
                        </svg>
                    </div>
                    <h3>Black & White Printing</h3>
                    <p>High-quality black and white printing on premium paper. Ideal for documents, assignments, and professional materials.</p>
                    <div class="price-display">
                        <p style="font-size: 14px; opacity: 0.9; margin-bottom: 4px;">Starting from</p>
                        <p style="font-size: 28px; font-weight: 700;">₱2.00/page</p>
                    </div>
                </div>

                <!-- Color Printing -->
                <div class="service-card p-8 reveal-on-scroll" data-reveal-delay="100">
                    <div class="service-icon w-16 h-16 rounded-lg flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </div>
                    <h3>Color Printing</h3>
                    <p>Vibrant color printing for presentations, brochures, and creative projects. Stunning results on every page.</p>
                    <div class="price-display">
                        <p style="font-size: 14px; opacity: 0.9; margin-bottom: 4px;">Starting from</p>
                        <p style="font-size: 28px; font-weight: 700;">₱5.00/page</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paper Sizes & Pricing Section -->
        <div style="margin-bottom: 96px;">
            <h2 class="section-title">Paper Sizes & Pricing</h2>
            <p class="section-subtitle">All prices per page (B&W and Color)</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- A4 Paper -->
                <div class="paper-card standard reveal-on-scroll" data-reveal-delay="0">
                    <h4>A4 Paper</h4>
                    <div class="price-grid">
                        <div class="price-item">
                            <div class="price-item-label">B&W</div>
                            <div class="price-item-value">₱2.00</div>
                        </div>
                        <div class="price-item">
                            <div class="price-item-label">Color</div>
                            <div class="price-item-value">₱5.00</div>
                        </div>
                    </div>
                </div>

                <!-- Short Bond -->
                <div class="paper-card short reveal-on-scroll" data-reveal-delay="100">
                    <h4>Short Bond</h4>
                    <div class="price-grid">
                        <div class="price-item">
                            <div class="price-item-label">B&W</div>
                            <div class="price-item-value">₱1.50</div>
                        </div>
                        <div class="price-item">
                            <div class="price-item-label">Color</div>
                            <div class="price-item-value">₱4.00</div>
                        </div>
                    </div>
                </div>

                <!-- Long Bond -->
                <div class="paper-card long reveal-on-scroll" data-reveal-delay="200">
                    <h4>Long Bond</h4>
                    <div class="price-grid">
                        <div class="price-item">
                            <div class="price-item-label">B&W</div>
                            <div class="price-item-value">₱2.50</div>
                        </div>
                        <div class="price-item">
                            <div class="price-item-label">Color</div>
                            <div class="price-item-value">₱6.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submission Instructions Section -->
        <div style="margin-bottom: 96px;">
            <h2 class="section-title">How to Submit Your Print Job</h2>
            <p class="section-subtitle">Simple 4-step process to get your documents printed</p>
            <div class="instruction-card reveal-on-scroll" data-reveal-delay="0">
                <div class="instruction-steps">
                    <div class="instruction-step reveal-on-scroll" data-reveal-delay="0">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Prepare Your Files</h4>
                            <p>Get your documents ready in PDF, Word, or image format</p>
                        </div>
                    </div>

                    <div class="instruction-step reveal-on-scroll" data-reveal-delay="100">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Contact via Messenger</h4>
                            <p>Send us details about your print job and preferences</p>
                        </div>
                    </div>

                    <div class="instruction-step reveal-on-scroll" data-reveal-delay="200">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Upload Your Files</h4>
                            <p>Share your documents through Facebook Messenger</p>
                        </div>
                    </div>

                    <div class="instruction-step reveal-on-scroll" data-reveal-delay="300">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h4>Pickup Your Order</h4>
                            <p>Collect your printed materials at the CICT office</p>
                        </div>
                    </div>
                </div>

                <div class="cta-section">
                    <a href="https://www.messenger.com/e2ee/t/780806171591045" target="_blank" class="messenger-btn">
                        <svg class="w-4 h-4 inline-block mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.42.09.574-.182.574-.407v-1.77c-2.84.603-3.437-1.184-3.437-1.184-.38-.975-.93-1.235-.93-1.235-.76-.52.056-.508.056-.508.847.06 1.293.867 1.293.867.75 1.288 1.96.916 2.44.7.075-.546.292-.916.532-1.126-1.855-.21-3.8-.927-3.8-4.106 0-.91.325-1.655.865-2.242-.087-.21-.375-1.056.082-2.2 0 0 .704-.224 2.304.848.668-.186 1.383-.278 2.093-.282.71.004 1.425.096 2.093.282 1.6-1.072 2.303-.848 2.303-.848.457 1.144.17 1.99.084 2.2.54.587.865 1.332.865 2.242 0 3.188-1.948 3.893-3.81 4.098.3.258.573.77.573 1.55v2.3c0 .227.153.502.576.407C20.565 21.795 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                        </svg>
                        Message us on Facebook
                    </a>
                </div>
            </div>
        </div>

        <!-- Officers in Charge Section -->
        <div style="margin-bottom: 96px;">
            <h2 class="section-title">Printing Officers</h2>
            <p class="section-subtitle">Meet our dedicated printing team</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Officer 1 -->
                <div class="officer-card reveal-on-scroll" data-reveal-delay="0">
                    <h4 class="officer-name">Kate Russel Relator</h4>
                    <p class="officer-title">PRINTING OFFICER</p>
                    <a href="https://www.messenger.com/e2ee/t/9440180662663186" target="_blank" class="officer-btn">Message on FB</a>
                </div>

                <!-- Officer 2 -->
                <div class="officer-card reveal-on-scroll" data-reveal-delay="100">
                    <h4 class="officer-name">Aleila Eunice Escoton</h4>
                    <p class="officer-title">PRINTING OFFICER</p>
                    <a href="https://www.messenger.com/e2ee/t/1861893691098871" target="_blank" class="officer-btn">Message on FB</a>
                </div>

                <!-- Officer 3 -->
                <div class="officer-card reveal-on-scroll" data-reveal-delay="200">
                    <h4 class="officer-name">Lorraine Grace Dangautan</h4>
                    <p class="officer-title">PRINTING OFFICER</p>
                    <a href="https://www.messenger.com/e2ee/t/8770965666351694" target="_blank" class="officer-btn">Message on FB</a>
                </div>

                <!-- Officer 4 -->
                <div class="officer-card reveal-on-scroll" data-reveal-delay="300">
                    <h4 class="officer-name">Karl Calimotan</h4>
                    <p class="officer-title">PRINTING OFFICER</p>
                    <a href="https://www.messenger.com/e2ee/t/7459672660760522" target="_blank" class="officer-btn">Message on FB</a>
                </div>

                <!-- Officer 5 -->
                <div class="officer-card reveal-on-scroll" data-reveal-delay="0">
                    <h4 class="officer-name">Jan Allysandra Espia</h4>
                    <p class="officer-title">PRINTING OFFICER</p>
                    <a href="https://www.messenger.com/e2ee/t/9341669029194575" target="_blank" class="officer-btn">Message on FB</a>
                </div>

                <!-- Officer 6 -->
                <div class="officer-card reveal-on-scroll" data-reveal-delay="100">
                    <h4 class="officer-name">Katherine Bicode</h4>
                    <p class="officer-title">PRINTING OFFICER</p>
                    <a href="https://www.messenger.com/e2ee/t/27543992281913946" target="_blank" class="officer-btn">Message on FB</a>
                </div>

                <!-- Officer 7 -->
                <div class="officer-card reveal-on-scroll" data-reveal-delay="200">
                    <h4 class="officer-name">Selwyn Adia</h4>
                    <p class="officer-title">PRINTING OFFICER</p>
                    <a href="https://www.messenger.com/e2ee/t/1821283922599976" target="_blank" class="officer-btn">Message on FB</a>
                </div>

                <!-- Officer 8 -->
                <div class="officer-card reveal-on-scroll" data-reveal-delay="300">
                    <h4 class="officer-name">Jeff Martinez</h4>
                    <p class="officer-title">PRINTING OFFICER</p>
                    <a href="https://www.messenger.com/t/100009387982974" target="_blank" class="officer-btn">Message on FB</a>
                </div>
            </div>

            <div class="officer-notice">
                <p><strong>📌 Important Note</strong></p>
                <p>If the Student Council office is closed, please contact any of our printing officers directly via Facebook Messenger for assistance with your print jobs.</p>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\services\index.blade.php ENDPATH**/ ?>