<?php
/**
 * AEOVITA — Static Page Template
 */
get_header();
?>
<main class="site-main">
  <?php while ( have_posts() ) : the_post(); ?>

  <!-- Page Hero -->
  <div class="page-hero">
    <div class="container">
      <h1><?php the_title(); ?></h1>
      <div class="divider divider--center"></div>
    </div>
  </div>

  <!-- Page Content -->
  <section class="page-content">
    <div class="container container--narrow">
      <?php the_content(); ?>
    </div>
  </section>

  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
