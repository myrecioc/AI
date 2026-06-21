<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ─── SITE HEADER ─────────────────────────────────────── -->
<header class="site-header" role="banner">
  <div class="container">
    <nav class="nav-inner" aria-label="<?php esc_attr_e( 'Primary Navigation', 'aeovita' ); ?>">

      <!-- Logo -->
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
        <div class="logo-symbol" aria-hidden="true">∞</div>
        <span class="logo-text">AEO<span>VITA</span></span>
      </a>

      <!-- Primary Nav -->
      <div class="nav-menu" role="navigation">
        <?php
        wp_nav_menu( [
            'theme_location'  => 'primary',
            'container'       => false,
            'menu_class'      => '',
            'fallback_cb'     => function() {
                echo '<a href="' . esc_url( home_url( '/shop' ) ) . '">' . esc_html__( 'Shop', 'aeovita' ) . '</a>';
                echo '<a href="' . esc_url( home_url( '/research' ) ) . '">' . esc_html__( 'Research', 'aeovita' ) . '</a>';
                echo '<a href="' . esc_url( home_url( '/stacks' ) ) . '">' . esc_html__( 'Stacks', 'aeovita' ) . '</a>';
                echo '<a href="' . esc_url( home_url( '/blog' ) ) . '">' . esc_html__( 'Blog', 'aeovita' ) . '</a>';
                echo '<a href="' . esc_url( home_url( '/about' ) ) . '">' . esc_html__( 'About', 'aeovita' ) . '</a>';
            },
            'items_wrap'      => '%3$s',
        ] );
        ?>
      </div>

      <!-- Nav Actions -->
      <div class="nav-actions">
        <?php if ( function_exists( 'WC' ) ) : ?>
          <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="nav-cart" aria-label="<?php esc_attr_e( 'View Cart', 'aeovita' ); ?>">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
            <span class="cart-count"><?php echo esc_html( aeovita_cart_count() ); ?></span>
          </a>
        <?php endif; ?>
        <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="btn btn--primary btn--sm">
          Shop Now
        </a>
        <button class="hamburger" aria-label="<?php esc_attr_e( 'Open Menu', 'aeovita' ); ?>" aria-expanded="false" aria-controls="mobile-menu">
          <span></span><span></span><span></span>
        </button>
      </div>

    </nav>
  </div>
</header>

<!-- ─── MOBILE MENU ───────────────────────────────────────── -->
<div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'aeovita' ); ?>">
  <button class="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close Menu', 'aeovita' ); ?>">✕</button>
  <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>"><?php esc_html_e( 'Shop', 'aeovita' ); ?></a>
  <a href="<?php echo esc_url( home_url( '/stacks' ) ); ?>"><?php esc_html_e( 'Stacks', 'aeovita' ); ?></a>
  <a href="<?php echo esc_url( home_url( '/research' ) ); ?>"><?php esc_html_e( 'Research', 'aeovita' ); ?></a>
  <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'aeovita' ); ?></a>
  <a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About', 'aeovita' ); ?></a>
  <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'aeovita' ); ?></a>
  <?php if ( function_exists( 'WC' ) ) : ?>
    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn--primary">
      <?php esc_html_e( 'View Cart', 'aeovita' ); ?>
      (<?php echo esc_html( aeovita_cart_count() ); ?>)
    </a>
  <?php endif; ?>
</div>
