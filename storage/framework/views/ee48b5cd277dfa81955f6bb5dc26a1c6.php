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
    <?php $__env->startSection('title', 'Contact - CICT Student Council'); ?>
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
            --shadow-modern: 0 8px 32px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 12px 48px rgba(139, 0, 0, 0.15);
        }

        /* ============ PAGE WRAPPER ============ */
        .contact-page-wrapper {
            background: var(--light-bg);
            min-height: calc(100vh - 200px);
            padding-top: 120px;
            padding-bottom: 80px;
        }

        /* ============ HERO SECTION ============ */
        .contact-hero {
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.9) 0%, rgba(160, 0, 0, 0.9) 100%), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=1200&h=400&fit=crop') center/cover;
            min-height: 550px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            margin-top: -120px;
        }

        .contact-hero-content {
            color: white;
            z-index: 10;
            padding: 40px 20px;
        }

        .contact-hero h1 {
            font-size: 56px;
            font-weight: 900;
            margin-bottom: 16px;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            letter-spacing: -2px;
        }

        .contact-hero p {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.95);
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        /* ============ CONTACT SECTION ============ */
        .contact-section {
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

        .contact-grid {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 48px;
            margin-top: 40px;
            align-items: start;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .contact-block {
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: linear-gradient(135deg, #FFFFFF 0%, #FAFAF8 100%);
            padding: 32px;
            border-radius: 16px;
            border: 1px solid rgba(139, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            position: relative;
            overflow: hidden;
        }

        .contact-block::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #8B0000 0%, #FFD700 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .contact-block:hover {
            box-shadow: var(--shadow-hover), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            transform: translateY(-4px);
            border-color: rgba(139, 0, 0, 0.15);
        }

        .contact-block:hover::before {
            opacity: 1;
        }

        .contact-label {
            font-size: 11px;
            font-weight: 950;
            text-transform: uppercase;
            color: #8B0000;
            letter-spacing: 2px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .contact-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--primary-text);
            line-height: 1.8;
            letter-spacing: -0.2px;
        }

        .contact-links {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .contact-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #8B0000;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            letter-spacing: 0.3px;
            padding: 4px 0;
            position: relative;
        }

        .contact-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #8B0000, #FFD700);
            transition: width 0.3s ease;
        }

        .contact-link:hover {
            color: #A00000;
            transform: translateX(6px);
        }

        .contact-link:hover::after {
            width: 100%;
        }

        .map-container {
            width: 100%;
            height: 650px;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: var(--shadow-hover);
            border: 1px solid rgba(139, 0, 0, 0.08);
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            transition: all 0.4s ease;
        }

        .map-container:hover {
            box-shadow: 0 16px 56px rgba(139, 0, 0, 0.18);
        }

        /* ============ SOCIAL CARDS ============ */
        .social-card {
            display: flex;
            align-items: center;
            gap: 16px;
            background: linear-gradient(135deg, #FFFFFF 0%, #FAFAF8 100%);
            padding: 20px 24px;
            border-radius: 14px;
            border: 1px solid rgba(139, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            text-decoration: none;
            cursor: pointer;
        }

        .social-card:hover {
            box-shadow: 0 12px 32px rgba(139, 0, 0, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            transform: translateY(-3px);
            border-color: rgba(139, 0, 0, 0.15);
        }

        .social-card-icon {
            font-size: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 48px;
        }

        .social-card-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .social-card-title {
            font-size: 14px;
            font-weight: 800;
            color: #8B0000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .social-card-description {
            font-size: 13px;
            color: #555;
            font-weight: 500;
            line-height: 1.4;
        }

        .social-card-arrow {
            color: #8B0000;
            font-weight: 700;
            transition: transform 0.3s ease;
            font-size: 18px;
        }

        .social-card:hover .social-card-arrow {
            transform: translateX(4px);
        }

        /* ============ LOCATION CARD ============ */
        .location-card {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 16px;
            align-items: center;
            background: linear-gradient(135deg, #FFFFFF 0%, #FAFAF8 100%);
            padding: 28px;
            border-radius: 14px;
            border: 1px solid rgba(139, 0, 0, 0.08);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .location-card:hover {
            box-shadow: 0 12px 32px rgba(139, 0, 0, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            transform: translateY(-3px);
            border-color: rgba(139, 0, 0, 0.15);
        }

        .location-icon {
            font-size: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.08) 0%, rgba(255, 215, 0, 0.05) 100%);
            border-radius: 12px;
            border: 1px solid rgba(139, 0, 0, 0.1);
        }

        .location-content {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .location-title {
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            color: #8B0000;
            letter-spacing: 1.5px;
        }

        .location-address {
            font-size: 16px;
            font-weight: 600;
            color: var(--primary-text);
            line-height: 1.7;
            letter-spacing: -0.2px;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .contact-hero h1 {
                font-size: 36px;
            }

            .contact-hero p {
                font-size: 16px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .map-container {
                height: 450px;
            }

            .section-heading {
                font-size: 32px;
            }
        }
    </style>

    <div class="contact-page-wrapper">
        <!-- ============ HERO SECTION ============ -->
        <section class="contact-hero">
            <div class="contact-hero-content">
                <h1>Get in Touch</h1>
                <p>Have questions? We'd love to hear from you. Reach out to the CICT Student Council officers.</p>
            </div>
        </section>

        <!-- ============ CONTACT INFORMATION ============ -->
        <section class="contact-section">
            <div class="section-container">
                <div class="contact-grid">
                    <div class="contact-info">
                        <div class="contact-block">
                            <span class="contact-label">Office Hours</span>
                            <span class="contact-value">Monday – Friday: 8:00 AM – 5:00 PM<br><small style="color: #666; font-size: 13px; font-weight: 500;">Closed on Saturday and Sunday</small></span>
                        </div>

                        <a href="https://www.facebook.com/profile.php?id=100068849010766" target="_blank" class="social-card">
                            <div class="social-card-icon">📘</div>
                            <div class="social-card-content">
                                <div class="social-card-title">Facebook</div>
                                <div class="social-card-description">Follow our official page</div>
                            </div>
                            <div class="social-card-arrow">→</div>
                        </a>

                        <a href="https://www.messenger.com/e2ee/t/780806171591045" target="_blank" class="social-card">
                            <div class="social-card-icon">💬</div>
                            <div class="social-card-content">
                                <div class="social-card-title">Messenger</div>
                                <div class="social-card-description">Contact us for business inquiries</div>
                            </div>
                            <div class="social-card-arrow">→</div>
                        </a>

                        <div class="location-card">
                            <div class="location-icon">📍</div>
                            <div class="location-content">
                                <div class="location-title">Our Location</div>
                                <div class="location-address">CICT Student Council Office<br>ISUFST Dingle Campus<br>Brgy. San Matias, Dingle<br>Iloilo, Philippines</div>
                            </div>
                        </div>
                    </div>

                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d489.5623416294347!2d122.6630055!3d11.001158!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33af1776ffd9b7f1%3A0x2c4663ccaaf49fa8!2sIloilo%20State%20University%20of%20Fisheries%20Science%20and%20Technology%E2%80%93%20Dingle%20Campus!5e0!3m2!1sen!2sph!4v1763305122332!5m2!1sen!2sph" 
                            width="100%" 
                            height="100%" 
                            style="border:0; margin: 0; padding: 0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views\contact\index.blade.php ENDPATH**/ ?>