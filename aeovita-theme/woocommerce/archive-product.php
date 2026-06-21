<?php
/**
 * AEOVITA — WooCommerce Shop / Archive Template
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main class="site-main">

  <!-- Shop Hero -->
  <div class="page-hero">
    <div class="container">
      <span class="eyebrow"><?php woocommerce_breadcrumb(); ?></span>
      <h1>
        <?php
        if ( is_product_category() ) {
            echo woocommerce_page_title( false );
        } elseif ( is_search() ) {
            printf( esc_html__( 'Results for &ldquo;%s&rdquo;', 'aeovita' ), get_search_query() );
        } else {
            esc_html_e( 'All Peptide Products', 'aeovita' );
        }
        ?>
      </h1>
      <div class="divider divider--center"></div>
      <?php woocommerce_result_count(); ?>
    </div>
  </div>

  <!-- Research Disclaimer -->
  <div class="container" style="padding-top:var(--space-xl);">
    <div style="background:rgba(201,168,76,0.06);border:1px solid rgba(201,168,76,0.2);border-radius:var(--border-radius);padding:12px 20px;font-size:0.72rem;color:var(--color-silver);font-family:var(--font-mono);line-height:1.6;">
      ⚠️ <?php esc_html_e( 'RESEARCH USE ONLY — All products sold for in vitro research purposes only. Not for human consumption. Not FDA-evaluated. Must be 18+ to purchase.', 'aeovita' ); ?>
    </div>
  </div>

  <!-- Product Grid + Filters -->
  <section class="section--sm">
    <div class="container">

      <div style="display:flex;gap:var(--space-3xl);align-items:flex-start;">

        <!-- Sidebar / Filters -->
        <aside style="min-width:240px;max-width:240px;" aria-label="<?php esc_attr_e( 'Product Filters', 'aeovita' ); ?>">
          <!-- Categories -->
          <div class="card mb-xl">
            <h4 class="eyebrow" style="margin-bottom:var(--space-lg);"><?php esc_html_e( 'Categories', 'aeovita' ); ?></h4>
            <?php
            $categories = get_terms( [
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
                'exclude'    => get_option( 'default_product_cat' ),
            ] );
            if ( ! empty( $categories ) ) :
            ?>
            <ul style="display:flex;flex-direction:column;gap:var(--space-sm);">
              <li>
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"
                   style="font-size:0.875rem;color:<?php echo is_shop() && ! is_product_category() ? 'var(--color-teal)' : 'var(--color-silver)'; ?>;">
                  <?php esc_html_e( 'All Products', 'aeovita' ); ?>
                </a>
              </li>
              <?php foreach ( $categories as $cat ) : ?>
              <li>
                <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>"
                   style="font-size:0.875rem;color:<?php echo is_product_category( $cat->slug ) ? 'var(--color-teal)' : 'var(--color-silver)'; ?>;">
                  <?php echo esc_html( $cat->name ); ?>
                  <span style="font-family:var(--font-mono);font-size:0.7rem;margin-left:4px;opacity:0.6;">(<?php echo esc_html( $cat->count ); ?>)</span>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>

          <!-- Price Filter (WooCommerce Widget) -->
          <?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'shop-sidebar' ); ?>
          <?php endif; ?>
        </aside>

        <!-- Products -->
        <div style="flex:1;min-width:0;">
          <?php
          if ( woocommerce_product_loop() ) {
              do_action( 'woocommerce_before_shop_loop' );
              woocommerce_product_loop_start();
              if ( wc_get_loop_prop( 'total' ) ) {
                  while ( have_posts() ) {
                      the_post();
                      do_action( 'woocommerce_shop_loop' );
                      wc_get_template_part( 'content', 'product' );
                  }
              }
              woocommerce_product_loop_end();
              do_action( 'woocommerce_after_shop_loop' );
          } else {
              do_action( 'woocommerce_no_products_found' );
          }
          ?>
        </div>

      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
