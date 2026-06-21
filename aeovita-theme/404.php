<?php
/**
 * AEOVITA — 404 Template
 */
get_header();
?>
<main class="site-main">
  <div class="error-404">
    <div class="container text-center">
      <h1>404</h1>
      <h2 style="color:var(--color-white);margin-bottom:var(--space-lg);">
        <?php esc_html_e( 'Compound Not Found', 'aeovita' ); ?>
      </h2>
      <p style="max-width:440px;margin:0 auto var(--space-2xl);">
        <?php esc_html_e( 'This page doesn\'t exist in our database. It may have been moved or the URL was mistyped.', 'aeovita' ); ?>
      </p>
      <div style="display:flex;gap:var(--space-md);justify-content:center;flex-wrap:wrap;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
          <?php esc_html_e( 'Return Home', 'aeovita' ); ?>
        </a>
        <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn--outline">
          <?php esc_html_e( 'Browse Products', 'aeovita' ); ?>
        </a>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>
