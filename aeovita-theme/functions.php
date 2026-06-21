<?php
/**
 * AEOVITA Theme Functions
 */

defined( 'ABSPATH' ) || exit;

define( 'AEOVITA_VERSION', '1.0.0' );
define( 'AEOVITA_DIR', get_template_directory() );
define( 'AEOVITA_URI', get_template_directory_uri() );

// ─── Theme Setup ────────────────────────────────────────────────
function aeovita_setup() {
    load_theme_textdomain( 'aeovita', AEOVITA_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );

    // WooCommerce
    add_theme_support( 'woocommerce', [
        'thumbnail_image_width' => 600,
        'single_image_width'    => 900,
        'product_grid'          => [
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 10,
            'default_columns' => 3,
            'min_columns'     => 1,
            'max_columns'     => 4,
        ],
    ] );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Menus
    register_nav_menus( [
        'primary'   => __( 'Primary Navigation', 'aeovita' ),
        'footer'    => __( 'Footer Navigation', 'aeovita' ),
        'mobile'    => __( 'Mobile Navigation', 'aeovita' ),
    ] );

    // Custom image sizes
    add_image_size( 'aeovita-hero',    1400, 700,  true );
    add_image_size( 'aeovita-product', 600,  600,  true );
    add_image_size( 'aeovita-blog',    800,  500,  true );
    add_image_size( 'aeovita-thumb',   400,  300,  true );
}
add_action( 'after_setup_theme', 'aeovita_setup' );

// ─── Enqueue Scripts & Styles ────────────────────────────────────
function aeovita_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'aeovita-fonts',
        'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&family=EB+Garamond:ital,wght@0,400;1,400&display=swap',
        [],
        null
    );

    // Theme styles (brand variables)
    wp_enqueue_style( 'aeovita-style', get_stylesheet_uri(), [ 'aeovita-fonts' ], AEOVITA_VERSION );

    // Main CSS
    wp_enqueue_style( 'aeovita-main', AEOVITA_URI . '/assets/css/main.css', [ 'aeovita-style' ], AEOVITA_VERSION );

    // Main JS
    wp_enqueue_script( 'aeovita-main', AEOVITA_URI . '/assets/js/main.js', [], AEOVITA_VERSION, true );

    // WooCommerce cart fragments
    if ( function_exists( 'is_woocommerce' ) ) {
        wp_localize_script( 'aeovita-main', 'aeovita_vars', [
            'ajax_url'  => admin_url( 'admin-ajax.php' ),
            'nonce'     => wp_create_nonce( 'aeovita_nonce' ),
            'cart_url'  => wc_get_cart_url(),
        ] );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'aeovita_scripts' );

// ─── Widgets / Sidebars ──────────────────────────────────────────
function aeovita_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Shop Sidebar', 'aeovita' ),
        'id'            => 'shop-sidebar',
        'description'   => __( 'Widgets for the shop page sidebar.', 'aeovita' ),
        'before_widget' => '<div class="widget card mb-xl">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title eyebrow">',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => __( 'Blog Sidebar', 'aeovita' ),
        'id'            => 'blog-sidebar',
        'description'   => __( 'Widgets for the blog sidebar.', 'aeovita' ),
        'before_widget' => '<div class="widget card mb-xl">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title eyebrow">',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => __( 'Footer — About', 'aeovita' ),
        'id'            => 'footer-about',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'aeovita_widgets_init' );

// ─── WooCommerce: Remove Default Wrappers ────────────────────────
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', function() {
    echo '<main class="site-main woocommerce-page"><div class="container">';
} );
add_action( 'woocommerce_after_main_content', function() {
    echo '</div></main>';
} );

// ─── WooCommerce: Cart Count in Nav ─────────────────────────────
function aeovita_cart_count() {
    if ( function_exists( 'WC' ) ) {
        return WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    }
    return 0;
}

// ─── WooCommerce: AJAX Cart Count Update ────────────────────────
add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {
    $count = aeovita_cart_count();
    $fragments['.cart-count'] = '<span class="cart-count">' . $count . '</span>';
    return $fragments;
} );

// ─── Custom Excerpt Length ───────────────────────────────────────
add_filter( 'excerpt_length', function() { return 28; } );
add_filter( 'excerpt_more', function() { return '...'; } );

// ─── Body Classes ────────────────────────────────────────────────
add_filter( 'body_class', function( $classes ) {
    if ( is_front_page() )       $classes[] = 'is-front-page';
    if ( is_woocommerce() )      $classes[] = 'is-woocommerce';
    if ( is_product() )          $classes[] = 'is-single-product';
    if ( is_product_category() ) $classes[] = 'is-product-category';
    if ( is_cart() )             $classes[] = 'is-cart';
    if ( is_checkout() )         $classes[] = 'is-checkout';
    return $classes;
} );

// ─── Research Disclaimer Custom Post Type ─────────────────────────
function aeovita_register_post_types() {
    // Research Studies CPT
    register_post_type( 'research', [
        'labels'        => [
            'name'          => __( 'Research', 'aeovita' ),
            'singular_name' => __( 'Study', 'aeovita' ),
        ],
        'public'        => true,
        'menu_icon'     => 'dashicons-search',
        'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'has_archive'   => true,
        'rewrite'       => [ 'slug' => 'research' ],
        'show_in_rest'  => true,
    ] );
}
add_action( 'init', 'aeovita_register_post_types' );

// ─── Custom Taxonomies ───────────────────────────────────────────
function aeovita_register_taxonomies() {
    register_taxonomy( 'peptide_type', [ 'post', 'product' ], [
        'labels'        => [
            'name'          => __( 'Peptide Types', 'aeovita' ),
            'singular_name' => __( 'Peptide Type', 'aeovita' ),
        ],
        'hierarchical'  => true,
        'public'        => true,
        'rewrite'       => [ 'slug' => 'peptide-type' ],
        'show_in_rest'  => true,
    ] );
}
add_action( 'init', 'aeovita_register_taxonomies' );

// ─── Security: Research Disclaimer ──────────────────────────────
function aeovita_add_research_disclaimer() {
    if ( is_product() || is_product_category() || is_shop() ) {
        echo '<div class="research-disclaimer container" style="background:rgba(201,168,76,0.06);border:1px solid rgba(201,168,76,0.2);border-radius:8px;padding:12px 20px;margin:16px auto;font-size:0.72rem;color:#8B9BAD;font-family:\'JetBrains Mono\',monospace;line-height:1.6;">
            ⚠️ RESEARCH USE ONLY — All products are sold strictly for research and laboratory use. These products have not been evaluated by the FDA and are not intended to diagnose, treat, cure, or prevent any disease. Not for human consumption. Must be 18+ to purchase. By purchasing you agree to our Terms of Service.
        </div>';
    }
}
add_action( 'woocommerce_before_main_content', 'aeovita_add_research_disclaimer', 15 );

// ─── Performance: Preload Critical Resources ─────────────────────
add_action( 'wp_head', function() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<meta name="theme-color" content="#0A0E1A">' . "\n";
}, 1 );

// ─── Custom Login Page Styles ────────────────────────────────────
add_action( 'login_enqueue_scripts', function() {
    wp_enqueue_style( 'aeovita-login', AEOVITA_URI . '/assets/css/login.css', [], AEOVITA_VERSION );
} );

add_filter( 'login_headerurl', function() { return home_url(); } );
add_filter( 'login_headertext', function() { return get_bloginfo( 'name' ); } );
