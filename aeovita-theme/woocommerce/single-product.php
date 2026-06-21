<?php
/**
 * AEOVITA — WooCommerce Single Product Template
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main class="site-main">

  <?php while ( have_posts() ) : the_post(); ?>

  <?php
  global $product;
  $product = wc_get_product( get_the_ID() );
  if ( ! $product ) { get_footer(); exit; }

  $cats = wp_get_post_terms( $product->get_id(), 'product_cat', [ 'fields' => 'names' ] );
  $cat_name = ! empty( $cats ) ? $cats[0] : '';
  $tags_list = wp_get_post_terms( $product->get_id(), 'product_tag', [ 'fields' => 'names' ] );
  $gallery_ids = $product->get_gallery_image_ids();
  $main_img  = wp_get_attachment_image_url( $product->get_image_id(), 'aeovita-product' );
  ?>

  <!-- Breadcrumb -->
  <div style="padding: 100px 0 0; background: var(--gradient-hero); border-bottom: 1px solid var(--color-border);">
    <div class="container">
      <?php woocommerce_breadcrumb(); ?>
    </div>
  </div>

  <!-- Single Product Layout -->
  <section class="section">
    <div class="container">
      <div class="single-product-layout">

        <!-- Gallery -->
        <div class="product-gallery">
          <div class="product-gallery__main">
            <?php if ( $main_img ) : ?>
              <img id="main-product-image" src="<?php echo esc_url( $main_img ); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;height:100%;object-fit:cover;">
            <?php else : ?>
              <div style="text-align:center;opacity:0.5;">
                <div style="font-size:5rem;">🧪</div>
                <p style="margin-top:var(--space-md);font-family:var(--font-mono);font-size:0.75rem;letter-spacing:0.1em;color:var(--color-teal);">AEOVITA</p>
              </div>
            <?php endif; ?>
          </div>

          <?php if ( ! empty( $gallery_ids ) ) : ?>
          <div class="product-gallery__thumbs">
            <?php if ( $main_img ) : ?>
            <div class="product-gallery__thumb active">
              <img src="<?php echo esc_url( $main_img ); ?>" alt="Main" loading="lazy">
            </div>
            <?php endif; ?>
            <?php foreach ( $gallery_ids as $img_id ) :
              $thumb = wp_get_attachment_image_url( $img_id, 'thumbnail' );
              if ( $thumb ) :
            ?>
            <div class="product-gallery__thumb">
              <img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="lazy">
            </div>
            <?php endif; endforeach; ?>
          </div>
          <?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="product-info">

          <!-- Badges -->
          <div class="product-info__badges">
            <span class="badge badge--teal">Research Grade</span>
            <?php if ( $product->is_on_sale() ) : ?>
              <span class="badge badge--gold">On Sale</span>
            <?php endif; ?>
            <?php if ( $product->is_featured() ) : ?>
              <span class="badge badge--gold">Best Seller</span>
            <?php endif; ?>
            <?php if ( $cat_name ) : ?>
              <span class="badge badge--new"><?php echo esc_html( $cat_name ); ?></span>
            <?php endif; ?>
          </div>

          <!-- Title -->
          <h1 style="margin-bottom:0;"><?php the_title(); ?></h1>

          <!-- Rating -->
          <?php if ( $product->get_review_count() > 0 ) : ?>
          <div style="display:flex;align-items:center;gap:var(--space-sm);margin-top:var(--space-md);">
            <div style="color:var(--color-gold);font-size:0.9rem;">
              <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
            </div>
            <span style="font-size:0.8rem;color:var(--color-silver);">
              (<?php printf( esc_html__( '%d reviews', 'aeovita' ), $product->get_review_count() ); ?>)
            </span>
          </div>
          <?php endif; ?>

          <!-- Price -->
          <div class="product-price-wrap">
            <span class="product-price-main"><?php echo $product->get_price_html(); ?></span>
          </div>

          <!-- Short Description -->
          <?php if ( $product->get_short_description() ) : ?>
          <p style="color:var(--color-silver);line-height:1.75;font-size:0.95rem;border-top:1px solid var(--color-border);padding-top:var(--space-lg);">
            <?php echo wp_kses_post( $product->get_short_description() ); ?>
          </p>
          <?php endif; ?>

          <!-- Add to Cart Form -->
          <?php woocommerce_template_single_add_to_cart(); ?>

          <!-- Product Meta -->
          <div class="product-meta-list">
            <?php if ( $product->get_sku() ) : ?>
            <div class="meta-row">
              <span class="meta-label"><?php esc_html_e( 'SKU', 'aeovita' ); ?></span>
              <span class="meta-value text-mono"><?php echo esc_html( $product->get_sku() ); ?></span>
            </div>
            <?php endif; ?>
            <?php if ( ! empty( $tags_list ) ) : ?>
            <div class="meta-row">
              <span class="meta-label"><?php esc_html_e( 'Tags', 'aeovita' ); ?></span>
              <span class="meta-value"><?php echo esc_html( implode( ', ', $tags_list ) ); ?></span>
            </div>
            <?php endif; ?>
            <div class="meta-row">
              <span class="meta-label"><?php esc_html_e( 'Format', 'aeovita' ); ?></span>
              <span class="meta-value"><?php echo esc_html( get_post_meta( $product->get_id(), '_peptide_form', true ) ?: 'Lyophilized Powder' ); ?></span>
            </div>
            <div class="meta-row">
              <span class="meta-label"><?php esc_html_e( 'Purity', 'aeovita' ); ?></span>
              <span class="meta-value" style="color:var(--color-success);">≥98% (HPLC Verified)</span>
            </div>
            <div class="meta-row">
              <span class="meta-label"><?php esc_html_e( 'Storage', 'aeovita' ); ?></span>
              <span class="meta-value">−20°C / −4°F</span>
            </div>
            <div class="meta-row">
              <span class="meta-label"><?php esc_html_e( 'Shipping', 'aeovita' ); ?></span>
              <span class="meta-value" style="color:var(--color-teal);">Ships within 24 hours</span>
            </div>
          </div>

          <!-- Trust Badges -->
          <div style="display:flex;gap:var(--space-md);margin-top:var(--space-xl);flex-wrap:wrap;">
            <div class="trust-item">✓ COA Available</div>
            <div class="trust-item">✓ USA Synthesized</div>
            <div class="trust-item">✓ Secure Checkout</div>
          </div>

        </div>

      </div>

      <!-- Product Tabs (Description, Research, Reviews) -->
      <div style="margin-top:var(--space-4xl);">
        <?php woocommerce_output_product_data_tabs(); ?>
      </div>

      <!-- Related Products -->
      <?php woocommerce_output_related_products(); ?>

    </div>
  </section>

  <?php endwhile; ?>

</main>

<?php get_footer(); ?>
