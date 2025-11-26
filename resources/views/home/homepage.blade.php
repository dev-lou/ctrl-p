<x-app-layout :title="'Council IGP - Merchandise & Printing Services'">
    <!-- SweetAlert2 for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary-blue: #8B0000;
            --primary-blue-light: #A00000;
            --primary-text: #1F1F1F;
            --secondary-text: #555555;
            --light-bg: #FFFAF1;
            --white: #FFFFFF;
            --border-light: #E8DCC8;
            --shadow-light: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-medium: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        /* ============ HERO SECTION ============ */
        .hero-section {
            background: transparent;
            padding: 120px 20px 100px;
            text-align: center;
            margin-top: 0;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 56px;
            font-weight: 800;
            color: var(--primary-text);
            margin-bottom: 16px;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: 20px;
            color: var(--secondary-text);
            margin-bottom: 48px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .hero-button {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
            color: white;
            padding: 16px 40px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 16px rgba(0, 58, 150, 0.2);
            border: none;
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .hero-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 58, 150, 0.3);
        }

        /* ============ FEATURED PRODUCTS SECTION ============ */
        .featured-section {
            padding: 80px 20px;
            background: var(--light-bg);
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-heading {
            font-size: 42px;
            font-weight: 800;
            color: var(--primary-text);
            margin-bottom: 60px;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
            margin-bottom: 60px;
        }

        .product-card {
            background: var(--white);
            border: 1px solid var(--border-light);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-light);
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-medium);
            border-color: var(--primary-blue);
        }

        .product-image {
            width: 100%;
            height: 260px;
            background: linear-gradient(135deg, #F0F0F0 0%, #E8E8E8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #999999;
            font-weight: 500;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-text);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .product-price {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 12px;
        }

        .product-description {
            font-size: 14px;
            color: var(--secondary-text);
            margin-bottom: 16px;
            flex-grow: 1;
        }

        .product-link {
            display: inline-block;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
            letter-spacing: 0.3px;
        }

        .product-link:hover {
            color: var(--primary-blue-light);
            transform: translateX(4px);
        }

        .view-all-btn {
            display: inline-block;
            margin: 0 auto;
            background: transparent;
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            padding: 14px 36px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .view-all-btn:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 58, 150, 0.2);
        }

        /* ============ SERVICES SECTION ============ */
        .services-section {
            padding: 80px 20px;
            background: #FFFAF1;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 32px;
            margin-top: 60px;
        }

        .service-card {
            background: var(--white);
            border: 1px solid var(--border-light);
            border-radius: 14px;
            padding: 40px 32px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-light);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-medium);
            border-color: var(--primary-blue);
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-blue-light) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 58, 150, 0.15);
        }

        .service-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-text);
            margin-bottom: 12px;
            letter-spacing: -0.3px;
        }

        .service-description {
            font-size: 15px;
            color: var(--secondary-text);
            line-height: 1.8;
        }

        /* ============ ABOUT SECTION ============ */
        .about-section {
            padding: 80px 20px;
            background: var(--light-bg);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            margin-top: 40px;
        }

        .about-content h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary-text);
            margin-bottom: 24px;
            letter-spacing: -0.5px;
        }

        .about-text {
            font-size: 16px;
            color: var(--secondary-text);
            line-height: 1.9;
            margin-bottom: 32px;
        }

        .about-button {
            display: inline-block;
            background: transparent;
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .about-button:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 58, 150, 0.2);
        }

        .about-image {
            width: 100%;
            aspect-ratio: 1;
            background: linear-gradient(135deg, #F0F0F0 0%, #E8E8E8 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #999999;
            font-weight: 500;
            overflow: hidden;
            box-shadow: var(--shadow-light);
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ============ CONTACT SECTION ============ */
        .contact-section {
            padding: 80px 20px;
            background: #FFFAF1;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-top: 40px;
            align-items: start;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .contact-block {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .contact-label {
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--secondary-text);
            letter-spacing: 1px;
        }

        .contact-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-text);
            line-height: 1.6;
        }

        .contact-links {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .contact-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
            letter-spacing: 0.3px;
        }

        .contact-link:hover {
            color: var(--primary-blue-light);
            transform: translateX(4px);
        }

        .map-container {
            width: 100%;
            height: 500px;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-light);
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
        }

        .map-link {
            display: block;
            width: 100%;
            height: 100%;
            position: relative;
            text-decoration: none;
        }

        .map-link img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .map-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .map-link:hover .map-overlay {
            background: rgba(0, 0, 0, 0.4);
        }

        .map-text {
            color: white;
            font-size: 16px;
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .map-link:hover .map-text {
            opacity: 1;
        }

        .map-container iframe {
            width: 100% !important;
            height: 100% !important;
            border: none !important;
            display: block !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 36px;
            }

            .hero-subtitle {
                font-size: 16px;
                margin-bottom: 32px;
            }

            .section-heading {
                font-size: 32px;
                margin-bottom: 40px;
            }

            .about-grid,
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 20px;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .hero-section {
                padding: 80px 20px 60px;
            }

            .featured-section,
            .services-section,
            .about-section,
            .contact-section {
                padding: 60px 20px;
            }

            .contact-grid {
                gap: 40px;
            }

            .map-container {
                height: 350px;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 28px;
                margin-bottom: 12px;
            }

            .hero-subtitle {
                font-size: 14px;
                margin-bottom: 24px;
            }

            .section-heading {
                font-size: 24px;
                margin-bottom: 32px;
            }

            .hero-button {
                padding: 12px 28px;
                font-size: 14px;
            }

            .product-card {
                margin: 0;
            }

            .contact-value {
                font-size: 14px;
            }

            .map-container {
                height: 250px;
            }
        }

        /* ============ SMOOTH SCROLL ============ */
        html {
            scroll-behavior: smooth;
        }

        /* ============ ANIMATIONS ============ */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-container {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>

    <div style="background: #FFFAF1; min-height: 100vh; width: 100%; padding-top: 0;">

    <!-- ============ HERO SECTION ============ -->
    <section class="hero-section" style="background: linear-gradient(135deg, rgba(139, 0, 0, 0.9) 0%, rgba(160, 0, 0, 0.9) 100%), url('https://images.unsplash.com/photo-1557821552-17105176677c?w=1200&h=600&fit=crop') center/cover; min-height: 100vh; display: flex; align-items: center; justify-content: center; position: relative;">
        <div class="hero-content" style="text-align: center; color: white; z-index: 10; padding: 20px;">
            <h1 class="hero-title" style="font-size: 64px; font-weight: 900; margin-bottom: 20px; color: #FFFFFF; text-shadow: 0 4px 12px rgba(0, 0, 0, 0.4); letter-spacing: -2px;">CICT Student Council</h1>
            <h2 style="font-size: 32px; font-weight: 700; margin-bottom: 24px; color: #FFD700; text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);">Merchandise & Printing Services</h2>
            <p class="hero-subtitle" style="font-size: 22px; color: rgba(255, 255, 255, 0.95); margin-bottom: 48px; max-width: 700px; margin-left: auto; margin-right: auto; text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3); font-weight: 500;">Quality merchandise and professional printing services proudly brought to you by ISUFST Dingle Campus CICT Student Council</p>
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('shop.index') }}" class="hero-button" style="background: #FFD700; color: #1a1a1a; padding: 16px 48px; border-radius: 12px; text-decoration: none; font-weight: 800; font-size: 16px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 8px 24px rgba(255, 215, 0, 0.4); border: none; cursor: pointer;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(255, 215, 0, 0.6)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(255, 215, 0, 0.4)';">Shop Now</a>
                <a href="{{ route('contact.index') }}" class="hero-button" style="background: #FFFFFF; color: #8B0000; padding: 16px 48px; border-radius: 12px; text-decoration: none; font-weight: 800; font-size: 16px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); border: none; cursor: pointer; box-shadow: 0 8px 24px rgba(255, 255, 255, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(255, 255, 255, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(255, 255, 255, 0.3)';">Contact Us</a>
            </div>
        </div>
    </section>

    <!-- ============ FEATURED PRODUCTS SECTION ============ -->
    <section class="featured-section">
        <div class="section-container">
            <h2 class="section-heading">Popular Merchandise</h2>
            
            <div class="products-grid">
                @php /** @var \App\Models\Product[]|\Illuminate\Support\Collection $featuredProducts */ @endphp
                @forelse($featuredProducts ?? [] as $product)
                    @if($product)
                        <a href="{{ route('shop.show', $product) }}" class="product-card reveal-on-scroll" data-reveal-delay="{{ ($loop->index % 4) * 100 }}">
                    @else
                        <div class="product-card disabled reveal-on-scroll" data-reveal-delay="{{ ($loop->index % 4) * 100 }}">
                    @endif
                        <div class="product-image">
                            @if(!empty($product?->image_url))
                                <img src="{{ $product->image_url }}" alt="{{ $product->name ?? 'Product' }}">
                            @elseif(!empty($product?->image_path))
                                <img src="{{ asset('storage/' . ($product?->image_path ?? '')) }}" alt="{{ $product?->name ?? 'Product' }}">
                            @else
                                <span>No Image</span>
                            @endif
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ $product?->name ?? 'Unknown Product' }}</h3>
                            <p class="product-price">₱{{ number_format($product?->base_price ?? 0, 2) }}</p>
                            <p class="product-description">{{ Str::limit($product?->description ?? '', 80) }}</p>
                            <span class="product-link">View Details →</span>
                        </div>
                    @if($product)
                    </a>
                    @else
                        </div>
                    @endif
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #999;">
                        <p style="font-size: 16px;">No featured products available yet.</p>
                    </div>
                @endforelse
            </div>

            <a href="{{ route('shop.index') }}" class="view-all-btn">View All Products</a>
        </div>
    </section>

    <!-- ============ SERVICES SECTION ============ -->
    <section class="services-section">
        <div class="section-container">
            <h2 class="section-heading">Our Services</h2>
            
            <div class="services-grid">
                <div class="service-card reveal-on-scroll" data-reveal-delay="0">
                    <div class="service-icon">🖨️</div>
                    <h3 class="service-title">B/W Printing</h3>
                    <p class="service-description">Professional black & white printing for documents, handouts, and academic materials. Fast turnaround at affordable student prices.</p>
                </div>

                <div class="service-card reveal-on-scroll" data-reveal-delay="100">
                    <div class="service-icon">🎨</div>
                    <h3 class="service-title">Color Printing</h3>
                    <p class="service-description">Vibrant full-color printing for presentations, projects, and promotional materials. High-quality output with professional finish.</p>
                </div>

                <div class="service-card reveal-on-scroll" data-reveal-delay="200">
                    <div class="service-icon">👕</div>
                    <h3 class="service-title">Custom Merchandise</h3>
                    <p class="service-description">Custom-designed t-shirts, tumblers, hoodies, and more. Perfect for events, giveaways, and student organization branding.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ ABOUT SECTION ============ -->
    <section class="about-section">
        <div class="section-container">
            <h2 class="section-heading">About CICT Council</h2>
            
            <div class="about-grid">
                <div class="about-content reveal-on-scroll" data-reveal-delay="0">
                    <h3>Your Student-Run Enterprise</h3>
                    <p class="about-text">
                        The CICT (College of Information and Communication Technology) Student Council operates this enterprise to serve the entire ISUFST Dingle Campus community. We are dedicated to providing high-quality merchandise and professional printing services at student-friendly prices, supporting both campus needs and student organization fundraising efforts.
                    </p>
                    
                    <h4 style="margin-top: 24px; margin-bottom: 12px; font-size: 16px; font-weight: 600; color: #333;">Our Mission</h4>
                    <p class="about-text" style="margin-bottom: 24px;">
                        To support CICT students by providing high-quality merchandise and professional printing services at affordable prices, generating sustainable revenue for student programs and activities.
                    </p>
                    
                    <p class="about-text" style="font-size: 14px; color: #666; margin-bottom: 24px;">
                        Since our establishment, the CICT Student Council has been a trusted partner for quality merchandise in the ISUFST Dingle Campus. Every purchase directly supports student welfare programs, cultural events, and academic initiatives.
                    </p>
                    
                    <a href="{{ route('services.index') }}" class="about-button">Learn More & Place Orders</a>
                </div>
                <div class="about-image reveal-on-scroll" data-reveal-delay="150">
                    <div style="display: flex; align-items: center; justify-content: center; min-height: 400px;">
                        <img src="{{ asset('images/cict-logo.png') }}" alt="CICT Student Council Logo" 
                             style="width: 350px; height: 350px; object-fit: cover; border-radius: 50%; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);">
                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Map is now embedded as iframe
        });
    </script>
</x-app-layout>
