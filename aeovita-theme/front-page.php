<?php get_header(); ?>

<!-- ═══════════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════════════ -->
<section class="hero">
  <div class="container">
    <div class="hero-grid">

      <!-- Content -->
      <div class="hero-content">
        <div class="hero-label">
          <div class="hero-label-dot"></div>
          <span>Science-Backed Longevity</span>
        </div>

        <h1>
          Optimize Your<br>
          Biology with<br>
          <span class="gradient-text">Precision Peptides</span>
        </h1>

        <p class="hero-description">
          AEOVITA delivers research-grade peptides — third-party tested, expertly formulated — for biohackers, athletes, and longevity seekers who refuse to settle for average.
        </p>

        <div class="hero-ctas">
          <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn--primary btn--lg">
            Explore Products
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="<?php echo esc_url( home_url( '/research' ) ); ?>" class="btn btn--ghost btn--lg">
            View Research
          </a>
        </div>

        <div class="hero-trust">
          <div class="trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            Third-Party Tested
          </div>
          <div class="trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            USA Synthesized
          </div>
          <div class="trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            ≥98% Purity Guaranteed
          </div>
        </div>
      </div>

      <!-- Visual -->
      <div class="hero-visual">
        <div class="hero-image-wrap">
          <?php
          if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'aeovita-hero' );
          } else {
              echo '<div style="width:100%;height:480px;background:linear-gradient(135deg,#151c2c 0%,#1a2535 50%,#0f1a30 100%);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:16px;">
                  <div style="font-size:4rem;opacity:0.4;">⬡</div>
                  <div style="font-family:JetBrains Mono,monospace;font-size:0.7rem;letter-spacing:0.2em;color:#00D4C8;text-transform:uppercase;">AEOVITA Labs</div>
              </div>';
          }
          ?>

          <!-- Floating Stat Cards -->
          <div class="hero-stat-card hero-stat-card--tl">
            <div class="stat-icon">🧬</div>
            <div>
              <div class="stat-value">≥98%</div>
              <div class="stat-label">Purity Level</div>
            </div>
          </div>

          <div class="hero-stat-card hero-stat-card--br">
            <div class="stat-icon">⚡</div>
            <div>
              <div class="stat-value">24hr</div>
              <div class="stat-label">Ship Time</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     STATS BAR
════════════════════════════════════════════════════════════════ -->
<section class="stats-bar">
  <div class="container">
    <div class="stats-bar-inner">
      <div>
        <div class="stat-block-num" data-counter data-target="10" data-suffix="">10+</div>
        <div class="stat-block-label">Premium Peptides</div>
      </div>
      <div>
        <div class="stat-block-num">≥98%</div>
        <div class="stat-block-label">Guaranteed Purity</div>
      </div>
      <div>
        <div class="stat-block-num" data-counter data-target="500" data-suffix="+">500+</div>
        <div class="stat-block-label">Happy Researchers</div>
      </div>
      <div>
        <div class="stat-block-num">24hr</div>
        <div class="stat-block-label">Same-Day Shipping</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     FEATURED PRODUCTS
════════════════════════════════════════════════════════════════ -->
<section class="products-section section">
  <div class="container">
    <div class="section-header reveal">
      <span class="eyebrow">Our Products</span>
      <h2>Top Peptide Compounds</h2>
      <div class="divider divider--center"></div>
      <p>Research-grade, third-party tested peptides for the scientifically serious. Every batch verified for purity and potency before it ships.</p>
    </div>

    <?php if ( function_exists( 'wc_get_products' ) ) :
      $products = wc_get_products( [
          'limit'    => 6,
          'status'   => 'publish',
          'featured' => false,
          'orderby'  => 'popularity',
      ] );

      if ( ! empty( $products ) ) :
        echo '<div class="grid-3">';
        foreach ( $products as $product ) :
          $product_id    = $product->get_id();
          $product_name  = $product->get_name();
          $product_price = $product->get_price_html();
          $product_url   = get_permalink( $product_id );
          $product_img   = wp_get_attachment_image_url( $product->get_image_id(), 'aeovita-product' );
          $product_short = $product->get_short_description();
          $categories    = wp_get_post_terms( $product_id, 'product_cat', [ 'fields' => 'names' ] );
          $category_name = ! empty( $categories ) ? $categories[0] : '';
    ?>
        <div class="product-card reveal">
          <div class="product-card__image">
            <?php if ( $product_img ) : ?>
              <img src="<?php echo esc_url( $product_img ); ?>" alt="<?php echo esc_attr( $product_name ); ?>" loading="lazy">
            <?php else : ?>
              <div class="product-placeholder-image">
                <div class="product-icon-large">🧪</div>
                <span class="eyebrow" style="margin:0;"><?php echo esc_html( $category_name ?: 'Peptide' ); ?></span>
              </div>
            <?php endif; ?>
            <div class="product-card__badges">
              <span class="badge badge--teal">Research Grade</span>
              <?php if ( $product->is_featured() ) : ?>
                <span class="badge badge--gold">Best Seller</span>
              <?php endif; ?>
            </div>
          </div>
          <div class="product-card__body">
            <?php if ( $category_name ) : ?>
              <div class="product-card__category"><?php echo esc_html( $category_name ); ?></div>
            <?php endif; ?>
            <h3 class="product-card__title"><?php echo esc_html( $product_name ); ?></h3>
            <?php if ( $product_short ) : ?>
              <p class="product-card__desc"><?php echo wp_strip_all_tags( $product_short ); ?></p>
            <?php endif; ?>
            <div class="product-card__footer">
              <div class="product-card__price"><?php echo $product_price; ?></div>
              <a href="<?php echo esc_url( $product_url ); ?>" class="btn btn--outline btn--sm">
                View
              </a>
            </div>
          </div>
        </div>
    <?php
        endforeach;
        echo '</div>';
      else :
    ?>
        <!-- Placeholder products when WooCommerce has no products yet -->
        <div class="grid-3">
          <?php
          $sample_products = [
            [ 'name' => 'BPC-157 Recovery Vial', 'cat' => 'Healing & Recovery', 'price' => '$89', 'desc' => 'The gold standard for tissue repair. Accelerates tendon, muscle and gut healing via nitric oxide pathways.', 'icon' => '🔬', 'badge' => 'Best Seller' ],
            [ 'name' => 'CJC-1295 + Ipamorelin GH Stack', 'cat' => 'Performance', 'price' => '$129', 'desc' => 'Pulsatile growth hormone release for lean muscle, fat loss, deep sleep and anti-aging benefits.', 'icon' => '💪', 'badge' => '' ],
            [ 'name' => 'GHK-Cu Regeneration Serum', 'cat' => 'Anti-Aging', 'price' => '$95', 'desc' => 'The most evidence-rich anti-aging peptide. Modulates 4,000+ genes. Premium topical serum formula.', 'icon' => '✨', 'badge' => '' ],
            [ 'name' => 'Epithalon Longevity Vial', 'cat' => 'Longevity', 'price' => '$109', 'desc' => 'Telomere-activating tetrapeptide for cellular longevity. Pineal gland-derived. 10mg precision vial.', 'icon' => '🧬', 'badge' => 'New' ],
            [ 'name' => 'Selank + Semax Mind Stack', 'cat' => 'Cognitive', 'price' => '$139', 'desc' => 'Anxiolytic + cognitive amplifier nasal spray duo. Sharp focus, calm mind, enhanced neuroplasticity.', 'icon' => '🧠', 'badge' => '' ],
            [ 'name' => 'MOTS-c Cellular Energy', 'cat' => 'Longevity', 'price' => '$179', 'desc' => 'Mitochondria-derived peptide. Emerging leader in longevity research. Metabolic optimization at the cellular level.', 'icon' => '⚡', 'badge' => 'New 2026' ],
          ];
          foreach ( $sample_products as $i => $p ) :
          ?>
          <div class="product-card reveal reveal-delay-<?php echo min( $i + 1, 4 ); ?>">
            <div class="product-card__image">
              <div class="product-placeholder-image">
                <div class="product-icon-large"><?php echo $p['icon']; ?></div>
              </div>
              <div class="product-card__badges">
                <span class="badge badge--teal">Research Grade</span>
                <?php if ( $p['badge'] ) : ?>
                  <span class="badge badge--gold"><?php echo esc_html( $p['badge'] ); ?></span>
                <?php endif; ?>
              </div>
            </div>
            <div class="product-card__body">
              <div class="product-card__category"><?php echo esc_html( $p['cat'] ); ?></div>
              <h3 class="product-card__title"><?php echo esc_html( $p['name'] ); ?></h3>
              <p class="product-card__desc"><?php echo esc_html( $p['desc'] ); ?></p>
              <div class="product-card__footer">
                <div class="product-card__price"><?php echo esc_html( $p['price'] ); ?><span class="product-card__price-sub">/vial</span></div>
                <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn--outline btn--sm">View</a>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
    <?php endif; else : ?>
      <!-- No WooCommerce - show placeholder grid -->
      <div class="grid-3">
        <?php
        $sample_products = [
          [ 'name' => 'BPC-157 Recovery Vial', 'cat' => 'Healing & Recovery', 'price' => '$89', 'desc' => 'The gold standard for tissue repair. Accelerates tendon, muscle and gut healing.', 'icon' => '🔬', 'badge' => 'Best Seller' ],
          [ 'name' => 'GH Optimizer Stack', 'cat' => 'Performance', 'price' => '$129', 'desc' => 'CJC-1295 + Ipamorelin blend for pulsatile growth hormone release.', 'icon' => '💪', 'badge' => '' ],
          [ 'name' => 'GHK-Cu Serum', 'cat' => 'Anti-Aging', 'price' => '$95', 'desc' => 'Most evidence-rich anti-aging peptide. Modulates 4,000+ genes.', 'icon' => '✨', 'badge' => '' ],
        ];
        foreach ( $sample_products as $p ) :
        ?>
        <div class="product-card reveal">
          <div class="product-card__image">
            <div class="product-placeholder-image"><div class="product-icon-large"><?php echo $p['icon']; ?></div></div>
            <div class="product-card__badges"><span class="badge badge--teal">Research Grade</span></div>
          </div>
          <div class="product-card__body">
            <div class="product-card__category"><?php echo esc_html( $p['cat'] ); ?></div>
            <h3 class="product-card__title"><?php echo esc_html( $p['name'] ); ?></h3>
            <p class="product-card__desc"><?php echo esc_html( $p['desc'] ); ?></p>
            <div class="product-card__footer">
              <div class="product-card__price"><?php echo esc_html( $p['price'] ); ?></div>
              <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn--outline btn--sm">View</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="text-center" style="margin-top: var(--space-3xl);">
      <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn--outline btn--lg">
        View All Products
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     WHY AEOVITA — BRAND PILLARS
════════════════════════════════════════════════════════════════ -->
<section class="pillars-section section">
  <div class="container">
    <div class="section-header reveal">
      <span class="eyebrow">Why AEOVITA</span>
      <h2>The Standard We Hold Ourselves To</h2>
      <div class="divider divider--center"></div>
      <p>In an unregulated market, we chose a different path. Every decision we make is guided by four non-negotiable principles.</p>
    </div>

    <div class="grid-4">
      <div class="pillar-card reveal reveal-delay-1">
        <div class="pillar-icon">🔬</div>
        <h3>Science First</h3>
        <p>Every product is backed by peer-reviewed research. We cite our sources and update our protocols as the science evolves.</p>
      </div>
      <div class="pillar-card reveal reveal-delay-2">
        <div class="pillar-icon">📋</div>
        <h3>Radical Transparency</h3>
        <p>COAs, sourcing details, purity reports — all publicly available for every batch. You should know exactly what you're getting.</p>
      </div>
      <div class="pillar-card reveal reveal-delay-3">
        <div class="pillar-icon">🧪</div>
        <h3>USA Synthesized</h3>
        <p>All peptides are synthesized in cGMP-certified US facilities and independently tested by third-party ISO-certified labs.</p>
      </div>
      <div class="pillar-card reveal reveal-delay-4">
        <div class="pillar-icon">🤝</div>
        <h3>Community-Led</h3>
        <p>We grow with the biohacking community — not despite it. Your feedback shapes our product roadmap and protocol guides.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     POPULAR STACKS
════════════════════════════════════════════════════════════════ -->
<section class="stacks-section section">
  <div class="container">
    <div class="section-header reveal">
      <span class="eyebrow">Expert Stacks</span>
      <h2>Purpose-Built Peptide Bundles</h2>
      <div class="divider divider--center"></div>
      <p>Our research team designed these synergistic combinations based on the most current biohacking protocols.</p>
    </div>

    <div class="grid-2">
      <div class="stack-card reveal">
        <div class="stack-icon">🏋️</div>
        <div class="stack-content">
          <h3>Repair Stack</h3>
          <p>The most popular injury recovery combo in biohacking. BPC-157 drives healing at the cellular level while TB-500 accelerates tissue remodeling.</p>
          <div class="stack-products">
            <span class="badge badge--teal">BPC-157 5mg</span>
            <span class="badge badge--teal">TB-500 5mg</span>
          </div>
          <div class="stack-price">
            <span class="stack-price-current">$199</span>
            <span class="stack-price-original">$208</span>
            <span class="stack-price-save">Save $9</span>
          </div>
          <a href="<?php echo esc_url( home_url( '/product/repair-stack' ) ); ?>" class="btn btn--primary">
            Add Stack to Cart
          </a>
        </div>
      </div>

      <div class="stack-card reveal reveal-delay-2">
        <div class="stack-icon">🧠</div>
        <div class="stack-content">
          <h3>Mind Stack</h3>
          <p>Selank reduces anxiety and promotes calm while Semax boosts BDNF and sharpens focus. The ultimate cognitive biohack in spray form.</p>
          <div class="stack-products">
            <span class="badge badge--teal">Selank 0.15% Spray</span>
            <span class="badge badge--teal">Semax 1% Spray</span>
          </div>
          <div class="stack-price">
            <span class="stack-price-current">$139</span>
            <span class="stack-price-original">$158</span>
            <span class="stack-price-save">Save $19</span>
          </div>
          <a href="<?php echo esc_url( home_url( '/product/mind-stack' ) ); ?>" class="btn btn--primary">
            Add Stack to Cart
          </a>
        </div>
      </div>

      <div class="stack-card reveal">
        <div class="stack-icon">⏳</div>
        <div class="stack-content">
          <h3>Longevity Stack</h3>
          <p>Epithalon activates telomerase to maintain telomere length. MOTS-c optimizes mitochondrial energy at the cellular level. The elite longevity protocol.</p>
          <div class="stack-products">
            <span class="badge badge--gold">Epithalon 10mg</span>
            <span class="badge badge--gold">MOTS-c 5mg</span>
          </div>
          <div class="stack-price">
            <span class="stack-price-current">$269</span>
            <span class="stack-price-original">$288</span>
            <span class="stack-price-save">Save $19</span>
          </div>
          <a href="<?php echo esc_url( home_url( '/product/longevity-stack' ) ); ?>" class="btn btn--gold">
            Add Stack to Cart
          </a>
        </div>
      </div>

      <div class="stack-card reveal reveal-delay-2">
        <div class="stack-icon">💪</div>
        <div class="stack-content">
          <h3>GH Optimizer Stack</h3>
          <p>CJC-1295 + Ipamorelin is the most widely used growth hormone secretagogue stack. Lean body composition, fat loss, better sleep — starting week 4.</p>
          <div class="stack-products">
            <span class="badge badge--teal">CJC-1295 5mg</span>
            <span class="badge badge--teal">Ipamorelin 5mg</span>
          </div>
          <div class="stack-price">
            <span class="stack-price-current">$129</span>
            <span class="stack-price-original">$142</span>
            <span class="stack-price-save">Save $13</span>
          </div>
          <a href="<?php echo esc_url( home_url( '/product/gh-optimizer-stack' ) ); ?>" class="btn btn--primary">
            Add Stack to Cart
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     SCIENCE / COA PREVIEW
════════════════════════════════════════════════════════════════ -->
<section class="science-section section">
  <div class="container">
    <div class="science-grid">

      <div class="science-content reveal">
        <span class="eyebrow">Our Commitment</span>
        <h2>Every Batch Independently Verified</h2>
        <div class="divider"></div>
        <p>We don't ask you to trust our label. Every AEOVITA product ships with a publicly available Certificate of Analysis (COA) from an independent ISO-certified laboratory, confirming identity, purity, and the absence of contaminants.</p>
        <p>Our synthesis partners operate under cGMP conditions in the United States. We test every batch — not just random samples.</p>

        <div class="science-stats">
          <div class="science-stat">
            <div class="science-stat-num">≥98%</div>
            <div class="science-stat-label">Minimum Purity Standard</div>
          </div>
          <div class="science-stat">
            <div class="science-stat-num">100%</div>
            <div class="science-stat-label">Batches 3rd-Party Tested</div>
          </div>
          <div class="science-stat">
            <div class="science-stat-num">ISO</div>
            <div class="science-stat-label">Certified Lab Partners</div>
          </div>
          <div class="science-stat">
            <div class="science-stat-num">USA</div>
            <div class="science-stat-label">Domestic Synthesis</div>
          </div>
        </div>

        <div style="margin-top: var(--space-2xl);">
          <a href="<?php echo esc_url( home_url( '/coa-database' ) ); ?>" class="btn btn--outline">
            View COA Database
          </a>
        </div>
      </div>

      <div class="science-visual reveal reveal-delay-2">
        <div class="coa-preview">
          <div class="coa-header">
            <div>
              <div class="coa-title">Certificate of Analysis</div>
              <div class="coa-subtitle">AEOVITA × ISO-CERT LABS</div>
            </div>
            <span class="badge badge--teal">VERIFIED</span>
          </div>

          <div class="coa-row">
            <span>Product</span>
            <span class="coa-value">BPC-157 — 5mg Vial</span>
          </div>
          <div class="coa-row">
            <span>Lot Number</span>
            <span class="coa-value text-mono">AEO-BPC-2606-A1</span>
          </div>
          <div class="coa-row">
            <span>Synthesis Date</span>
            <span class="coa-value">June 2026</span>
          </div>
          <div class="coa-row">
            <span>HPLC Purity</span>
            <span class="coa-value coa-pass">99.3% ✓</span>
          </div>
          <div class="coa-row">
            <span>Mass Spec (MS)</span>
            <span class="coa-value coa-pass">CONFIRMED ✓</span>
          </div>
          <div class="coa-row">
            <span>Endotoxin (LAL)</span>
            <span class="coa-value coa-pass">&lt;1 EU/mg ✓</span>
          </div>
          <div class="coa-row">
            <span>Sterility</span>
            <span class="coa-value coa-pass">PASS ✓</span>
          </div>
          <div class="coa-row">
            <span>Heavy Metals</span>
            <span class="coa-value coa-pass">ND (PASS) ✓</span>
          </div>
          <div class="coa-row">
            <span>Storage Condition</span>
            <span class="coa-value">−20°C Lyophilized</span>
          </div>
          <div style="margin-top:var(--space-lg);text-align:center;">
            <a href="#" class="btn btn--outline btn--sm" style="width:100%;">Download Full COA</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     TESTIMONIALS
════════════════════════════════════════════════════════════════ -->
<section class="testimonials-section section">
  <div class="container">
    <div class="section-header reveal">
      <span class="eyebrow">Community</span>
      <h2>What Researchers Are Saying</h2>
      <div class="divider divider--center"></div>
    </div>

    <div class="grid-3">

      <div class="testimonial-card reveal reveal-delay-1">
        <div class="testimonial-stars">★★★★★</div>
        <p class="testimonial-quote">"I've tried 6 other peptide vendors. AEOVITA is the first one where the COA matched what I actually measured at home with my own HPLC setup. That level of accuracy is rare."</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar-placeholder">RK</div>
          <div>
            <div class="testimonial-name">Dr. Ryan K.</div>
            <div class="testimonial-role">Research Scientist, Biochemistry PhD</div>
          </div>
          <span class="testimonial-verified">VERIFIED</span>
        </div>
      </div>

      <div class="testimonial-card reveal reveal-delay-2">
        <div class="testimonial-stars">★★★★★</div>
        <p class="testimonial-quote">"BPC-157 from AEOVITA for my shoulder injury. Six months of chronic pain, gone in 3 weeks. I'm not making medical claims — I'm just describing what happened in my n=1 experiment."</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar-placeholder">MJ</div>
          <div>
            <div class="testimonial-name">Marcus J.</div>
            <div class="testimonial-role">CrossFit Coach, 12 Years</div>
          </div>
          <span class="testimonial-verified">VERIFIED</span>
        </div>
      </div>

      <div class="testimonial-card reveal reveal-delay-3">
        <div class="testimonial-stars">★★★★★</div>
        <p class="testimonial-quote">"The Longevity Stack (Epithalon + MOTS-c) has been in my protocol for 4 months. Sleep scores up, telomere-adjacent biomarkers improving. The science here is real and so is the sourcing."</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar-placeholder">SL</div>
          <div>
            <div class="testimonial-name">Sarah L.</div>
            <div class="testimonial-role">Longevity Biohacker, 41</div>
          </div>
          <span class="testimonial-verified">VERIFIED</span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     LATEST RESEARCH / BLOG POSTS
════════════════════════════════════════════════════════════════ -->
<?php
$recent_posts = get_posts( [
    'numberposts' => 3,
    'post_status' => 'publish',
] );

if ( ! empty( $recent_posts ) ) : ?>
<section class="section" style="background:var(--color-navy-mid);">
  <div class="container">
    <div class="section-header reveal">
      <span class="eyebrow">Research & Education</span>
      <h2>From the AEOVITA Lab</h2>
      <div class="divider divider--center"></div>
    </div>
    <div class="blog-grid">
      <?php foreach ( $recent_posts as $i => $post ) :
        setup_postdata( $post );
        $cats = get_the_category( $post->ID );
        $cat_name = ! empty( $cats ) ? $cats[0]->name : 'Research';
        $thumb = get_the_post_thumbnail_url( $post->ID, 'aeovita-blog' );
      ?>
      <div class="blog-card reveal reveal-delay-<?php echo $i + 1; ?>">
        <div class="blog-card__image">
          <?php if ( $thumb ) : ?>
            <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
          <?php endif; ?>
        </div>
        <div class="blog-card__body">
          <div class="blog-card__meta">
            <span class="blog-card__category"><?php echo esc_html( $cat_name ); ?></span>
            <span>·</span>
            <span><?php echo get_the_date( 'M j, Y', $post ); ?></span>
          </div>
          <h3 class="blog-card__title">
            <a href="<?php the_permalink( $post ); ?>" style="color:inherit;"><?php the_title( '', '', true ); ?></a>
          </h3>
          <p class="blog-card__excerpt"><?php echo get_the_excerpt( $post ); ?></p>
          <a href="<?php the_permalink( $post ); ?>" class="blog-card__link">
            Read Article
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>
      <?php endforeach; wp_reset_postdata(); ?>
    </div>
    <div class="text-center" style="margin-top:var(--space-3xl);">
      <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="btn btn--outline">View All Articles</a>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════════════
     NEWSLETTER
════════════════════════════════════════════════════════════════ -->
<section class="newsletter-section section">
  <div class="container">
    <div class="newsletter-card">
      <span class="eyebrow">Join the Lab</span>
      <h2>Get the AEOVITA Protocol Guide — Free</h2>
      <p>Sign up and receive our 47-page Biohacker's Peptide Protocol Guide, early access to new products, and weekly research breakdowns.</p>

      <form class="newsletter-form" action="#" method="post" novalidate>
        <input
          type="email"
          name="email"
          placeholder="your@email.com"
          required
          aria-label="<?php esc_attr_e( 'Email address', 'aeovita' ); ?>"
        >
        <button type="submit" class="btn btn--primary">
          Get Free Guide
        </button>
      </form>

      <p class="newsletter-note">No spam. Unsubscribe anytime. We don't sell your data.</p>
    </div>
  </div>
</section>

<?php get_footer(); ?>
