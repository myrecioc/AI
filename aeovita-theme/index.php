<?php
/**
 * AEOVITA — Blog/Archive Index
 */
get_header();
?>
<main class="site-main">
  <!-- Page Hero -->
  <div class="page-hero">
    <div class="container">
      <span class="eyebrow">
        <?php
        if ( is_home() ) esc_html_e( 'Research Blog', 'aeovita' );
        elseif ( is_category() ) echo esc_html( single_cat_title( '', false ) );
        elseif ( is_tag() ) printf( esc_html__( 'Tag: %s', 'aeovita' ), single_tag_title( '', false ) );
        elseif ( is_search() ) printf( esc_html__( 'Search: %s', 'aeovita' ), get_search_query() );
        elseif ( is_archive() ) the_archive_title();
        ?>
      </span>
      <h1>
        <?php
        if ( is_home() ) esc_html_e( 'Science-Backed Insights', 'aeovita' );
        elseif ( is_search() ) printf( esc_html__( 'Results for &ldquo;%s&rdquo;', 'aeovita' ), get_search_query() );
        elseif ( is_archive() ) the_archive_title();
        else esc_html_e( 'Latest Posts', 'aeovita' );
        ?>
      </h1>
      <div class="divider divider--center"></div>
    </div>
  </div>

  <!-- Posts Grid -->
  <section class="section">
    <div class="container">
      <?php if ( have_posts() ) : ?>
        <div class="blog-grid">
          <?php while ( have_posts() ) : the_post();
            $cats     = get_the_category();
            $cat_name = ! empty( $cats ) ? $cats[0]->name : __( 'Research', 'aeovita' );
            $thumb    = get_the_post_thumbnail_url( null, 'aeovita-blog' );
          ?>
          <article <?php post_class( 'blog-card' ); ?> id="post-<?php the_ID(); ?>">
            <div class="blog-card__image">
              <?php if ( $thumb ) : ?>
                <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
              <?php else : ?>
                <div style="width:100%;height:100%;background:var(--color-navy-light);display:flex;align-items:center;justify-content:center;font-size:2rem;opacity:0.5;">🧬</div>
              <?php endif; ?>
            </div>
            <div class="blog-card__body">
              <div class="blog-card__meta">
                <span class="blog-card__category"><?php echo esc_html( $cat_name ); ?></span>
                <span>·</span>
                <span><?php the_date(); ?></span>
                <span>·</span>
                <span><?php echo esc_html( ceil( str_word_count( get_the_content() ) / 200 ) ); ?> min read</span>
              </div>
              <h2 class="blog-card__title">
                <a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a>
              </h2>
              <p class="blog-card__excerpt"><?php the_excerpt(); ?></p>
              <a href="<?php the_permalink(); ?>" class="blog-card__link">
                Read Article
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>
            </div>
          </article>
          <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div style="margin-top:var(--space-3xl);text-align:center;">
          <?php
          the_posts_pagination( [
              'mid_size'  => 2,
              'prev_text' => '← ' . __( 'Newer', 'aeovita' ),
              'next_text' => __( 'Older', 'aeovita' ) . ' →',
          ] );
          ?>
        </div>

      <?php else : ?>
        <div class="text-center" style="padding:var(--space-5xl) 0;">
          <div style="font-size:3rem;margin-bottom:var(--space-xl);">🔬</div>
          <h2><?php esc_html_e( 'No Content Found', 'aeovita' ); ?></h2>
          <p style="margin:var(--space-lg) auto;max-width:400px;"><?php esc_html_e( 'Our research team is working on new content. Check back soon.', 'aeovita' ); ?></p>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
            <?php esc_html_e( 'Return Home', 'aeovita' ); ?>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
