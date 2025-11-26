/**
 * ============ SMOOTH PAGE TRANSITION SCRIPT ============
 * Lightweight, fast, and eye-friendly page transitions
 * Includes dropdown menu management for better UX
 */

document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    
    // Close any open dropdowns IMMEDIATELY on page load
    closeAllDropdowns();
    
    // Inject transition overlay
    const overlay = document.createElement('div');
    overlay.className = 'page-transition-overlay';
    document.body.appendChild(overlay);
    
    // Fade in main content on page load
    const main = document.querySelector('main');
    if (main) {
        main.style.opacity = '1';
    }
    
    // Update navbar active link styling
    updateActiveNavLink();
    
    // Update scroll position for better UX
    if (window.location.hash) {
        setTimeout(() => {
            const element = document.querySelector(window.location.hash);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }, 100);
    } else {
        window.scrollTo(0, 0);
    }
    
    // Optimize performance
    optimizeImages();
    prefetchLinks();
    preventLayoutShift();
});

/**
 * Close all Alpine.js dropdowns
 */
function closeAllDropdowns() {
    document.querySelectorAll('[x-data*="menuOpen"]').forEach(el => {
        // Try multiple ways to close the dropdown
        
        // Method 1: Direct style hiding
        const dropdown = el.querySelector('[x-show="menuOpen"]');
        if (dropdown) {
            dropdown.style.display = 'none';
        }
        
        // Method 2: Alpine.js x-data manipulation
        if (el.__x && el.__x.$data) {
            el.__x.$data.menuOpen = false;
        }
        
        // Method 3: Dispatch click outside event
        const outsideEvent = new MouseEvent('click', {
            bubbles: true,
            cancelable: true,
            view: window
        });
        el.dispatchEvent(outsideEvent);
    });
}

/**
 * Update navbar active link visual state
 */
function updateActiveNavLink() {
    const navLinks = document.querySelectorAll('.navbar-link');
    
    navLinks.forEach(link => {
        if (link.classList.contains('active')) {
            link.style.transition = 'all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1)';
        }
    });
}

/**
 * Close dropdown when clicking navbar navigation links
 */
document.addEventListener('click', function(e) {
    const navLink = e.target.closest('.navbar-link');
    if (navLink && !navLink.closest('[x-data*="menuOpen"]')) {
        // Close all dropdowns after a short delay
        setTimeout(() => {
            closeAllDropdowns();
        }, 50);
    }
});

/**
 * Optimize images for faster loading
 */
function optimizeImages() {
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        if (!img.loading) {
            img.loading = 'lazy';
        }
    });
}

/**
 * Prefetch internal links for faster navigation
 */
function prefetchLinks() {
    // Only prefetch if the browser supports it and has good connection
    if ('prefetch' in document.createElement('link') && navigator.connection) {
        // Check connection quality before prefetching
        const connection = navigator.connection;
        if (connection.saveData || connection.effectiveType === '4g' || connection.effectiveType === '3g') {
            return; // Don't prefetch on slow connections or if user prefers reduced data
        }
    }
    
    // Simple prefetch implementation
    const links = document.querySelectorAll('a[href^="/"]');
    links.forEach(link => {
        const href = link.getAttribute('href');
        if (href && !href.startsWith('http') && !href.startsWith('#')) {
            try {
                const prefetchLink = document.createElement('link');
                prefetchLink.rel = 'prefetch';
                prefetchLink.href = href;
                document.head.appendChild(prefetchLink);
            } catch (e) {
                // Silently fail if prefetch not supported
            }
        }
    });
}

/**
 * Prevent layout shift - add CSS for better CLS (Cumulative Layout Shift)
 */
function preventLayoutShift() {
    document.documentElement.style.scrollPaddingTop = '70px';
}

/**
 * Performance monitoring
 */
window.addEventListener('load', function() {
    try {
        let pageLoadTime = null;

        // Prefer Navigation Timing Level 2 when available
        if (performance.getEntriesByType) {
            const navEntries = performance.getEntriesByType('navigation');
            if (navEntries && navEntries.length) {
                const nav = navEntries[0];
                if (typeof nav.loadEventEnd === 'number' && typeof nav.startTime === 'number') {
                    pageLoadTime = nav.loadEventEnd - nav.startTime;
                }
            }
        }

        // Fallback to legacy timing API but only when values look sane
        if (pageLoadTime === null && window.performance && window.performance.timing) {
            const perfData = window.performance.timing;
            if (perfData.loadEventEnd && perfData.navigationStart && perfData.loadEventEnd >= perfData.navigationStart) {
                pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
            }
        }

        // Page load time available but logging disabled for production
    } catch (err) {
        // Silently ignore page load timing errors
    }
});

/**
 * Smooth scroll for anchor links
 */
document.addEventListener('click', function(e) {
    const link = e.target.closest('a[href^="#"]');
    if (!link) return;
    
    const target = document.querySelector(link.getAttribute('href'));
    if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
});

/**
 * Lazy load sections with fade-in animation
 */
function observeSections() {
    const sections = document.querySelectorAll('section, .fade-in-section');
    
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        sections.forEach(section => {
            observer.observe(section);
        });
    }
}

// Initialize section observer
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', observeSections);
} else {
    observeSections();
}
