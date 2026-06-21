<?php
/**
 * AEOVITA — Single Post Template
 */
get_header();
?>
<main class="site-main">
  <?php while ( have_posts() ) : the_post();
    $cats      = get_the_category();
    $cat_name  = ! empty( $cats ) ? $cats[0]->name : __( 'Research', 'aeovita' );
    $read_time = ceil( str_word_count( get_the_content() ) / 200 );
    $thumb     = get_the_post_thumbnail_url( null, 'aeovita-hero' );
  ?>

  <!-- Article Hero -->
  <div class="page-hero" style="text-align:left; <?php echo $thumb ? 'background-image:linear-gradient(to right, rgba(10,14,26,0.97) 50%, rgba(10,14,26,0.6)), url(' . esc_url( $thumb ) . '); background-size:cover; background-position:center;' : ''; ?>">
    <div class="container container--narrow">
      <div style="margin-bottom:var(--space-lg);display:flex;gap:var(--space-md);flex-wrap:wrap;align-items:center;">
        <span class="badge badge--teal"><?php echo esc_html( $cat_name ); ?></span>
        <span class="text-mono text-silver" style="font-size:0.75rem;"><?php the_date(); ?> · <?php echo esc_html( $read_time ); ?> min read</span>
      </div>
      <h1><?php the_title(); ?></h1>
      <div class="divider" style="margin-top:var(--space-xl);"></div>

      <!-- Author -->
      <div style="display:flex;align-items:center;gap:var(--space-md);margin-top:var(--space-lg);">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 48, '', '', [ 'style' => 'border-radius:50%;border:2px solid var(--color-border);' ] ); ?>
        <div>
          <div style="font-weight:600;font-size:0.9rem;"><?php the_author(); ?></div>
          <div style="font-size:0.78rem;color:var(--color-silver);"><?php esc_html_e( 'AEOVITA Research Team', 'aeovita' ); ?></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Article Content -->
  <section class="page-content">
    <div class="container container--narrow">
      <div class="page-content-body">
        <?php the_content(); ?>
      </div>

      <!-- Tags -->
      <?php
      $tags = get_the_tags();
      if ( $tags ) :
      ?>
      <div style="margin-top:var(--space-3xl);padding-top:var(--space-xl);border-top:1px solid var(--color-border);display:flex;gap:var(--space-sm);flex-wrap:wrap;align-items:center;">
        <span style="font-family:var(--font-mono);font-size:0.75rem;color:var(--color-silver);letter-spacing:0.1em;">TAGS:</span>
        <?php foreach ( $tags as $tag ) : ?>
          <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="badge badge--teal"><?php echo esc_html( $tag->name ); ?></a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <!-- Research Disclaimer -->
      <div style="margin-top:var(--space-3xl);padding:var(--space-xl);background:rgba(201,168,76,0.06);border:1px solid rgba(201,168,76,0.2);border-radius:var(--border-radius);font-size:0.78rem;color:var(--color-silver);line-height:1.7;font-family:var(--font-mono);">
        <strong style="color:var(--color-gold);">DISCLAIMER:</strong> <?php esc_html_e( 'The information presented in this article is for educational and research purposes only. It does not constitute medical advice and should not be used to diagnose, treat, cure, or prevent any disease. Always consult a qualified healthcare professional before beginning any new health protocol.', 'aeovita' ); ?>
      </div>

      <!-- Navigation -->
      <div style="margin-top:var(--space-3xl);display:flex;justify-content:space-between;gap:var(--space-xl);">
        <?php previous_post_link( '<div class="btn btn--ghost">← %link</div>' ); ?>
        <?php next_post_link( '<div class="btn btn--ghost">%link →</div>' ); ?>
      </div>

    </div>
  </section>

  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
