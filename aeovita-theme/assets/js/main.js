/**
 * AEOVITA Theme - Main JavaScript
 */
(function() {
  'use strict';

  // ─── Sticky Header ───────────────────────────────────────────
  const header = document.querySelector('.site-header');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('scrolled', window.scrollY > 60);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ─── Mobile Menu ─────────────────────────────────────────────
  const hamburger = document.querySelector('.hamburger');
  const mobileMenu = document.querySelector('.mobile-menu');
  const mobileClose = document.querySelector('.mobile-menu-close');

  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => {
      mobileMenu.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  }

  function closeMobileMenu() {
    if (mobileMenu) {
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    }
  }

  if (mobileClose) mobileClose.addEventListener('click', closeMobileMenu);
  if (mobileMenu) {
    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', closeMobileMenu);
    });
  }

  // ─── Quantity Buttons (Product Page) ─────────────────────────
  document.querySelectorAll('.qty-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const wrap = btn.closest('.qty-input');
      const display = wrap.querySelector('.qty-num');
      const nativeInput = document.querySelector('input.qty');
      let val = parseInt(display.textContent) || 1;

      if (btn.dataset.action === 'plus') val = Math.min(val + 1, 99);
      if (btn.dataset.action === 'minus') val = Math.max(val - 1, 1);

      display.textContent = val;
      if (nativeInput) nativeInput.value = val;
    });
  });

  // ─── Smooth Scroll for Anchors ────────────────────────────────
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', e => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        const offset = 80;
        const top = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  // ─── Animated Counter (Stats Bar) ────────────────────────────
  const animateCounter = (el, target, suffix = '') => {
    const duration = 1800;
    const start = performance.now();
    const startVal = 0;

    const update = (time) => {
      const elapsed = time - start;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.floor(startVal + (target - startVal) * eased);
      el.textContent = current.toLocaleString() + suffix;
      if (progress < 1) requestAnimationFrame(update);
    };

    requestAnimationFrame(update);
  };

  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseFloat(el.dataset.target) || 0;
        const suffix = el.dataset.suffix || '';
        animateCounter(el, target, suffix);
        statsObserver.unobserve(el);
      }
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('[data-counter]').forEach(el => {
    statsObserver.observe(el);
  });

  // ─── Scroll Reveal Animations ────────────────────────────────
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

  document.querySelectorAll('.reveal').forEach(el => {
    revealObserver.observe(el);
  });

  // ─── Cart Count Update ────────────────────────────────────────
  document.body.addEventListener('wc_fragments_refreshed', () => {
    const count = document.querySelector('.cart-count');
    if (count) {
      const wc = document.querySelector('.woocommerce-mini-cart__total');
      // WooCommerce handles this via AJAX fragments
    }
  });

  // ─── Newsletter Form ──────────────────────────────────────────
  const newsletterForm = document.querySelector('.newsletter-form');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = newsletterForm.querySelector('input[type="email"]').value;
      const btn = newsletterForm.querySelector('button');
      const originalText = btn.textContent;

      btn.textContent = 'Subscribed ✓';
      btn.style.background = 'linear-gradient(135deg, #22C55E, #16A34A)';
      btn.disabled = true;

      setTimeout(() => {
        btn.textContent = originalText;
        btn.style.background = '';
        btn.disabled = false;
        newsletterForm.reset();
      }, 3000);
    });
  }

  // ─── Product Gallery Thumbnails ───────────────────────────────
  document.querySelectorAll('.product-gallery__thumb').forEach(thumb => {
    thumb.addEventListener('click', () => {
      document.querySelectorAll('.product-gallery__thumb').forEach(t => t.classList.remove('active'));
      thumb.classList.add('active');
      const main = document.querySelector('.product-gallery__main img');
      if (main && thumb.querySelector('img')) {
        main.src = thumb.querySelector('img').src;
      }
    });
  });

  // ─── Add CSS Animation Classes ────────────────────────────────
  const style = document.createElement('style');
  style.textContent = `
    .reveal {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .reveal.revealed {
      opacity: 1;
      transform: translateY(0);
    }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }
  `;
  document.head.appendChild(style);

})();
