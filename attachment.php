<?php

  get_header();

    if ( have_posts() ) :
      while ( have_posts() ) :
        the_post();
?>

  <section class="main-content">
  <?php
    get_template_part( 'template-parts/subtitle' );
  ?>

    <article id="post-<?php the_ID(); ?>" class="container py-2">
      <div class="row">
        <div class="col-md-12 text-center">
          <?php echo wp_get_attachment_image( get_the_ID(), array(9999,9999) ); ?>
        </div>
        <div class="<?php if (is_active_sidebar('right-sidebar')): ?>col-md-8 col-xl-9<?php else: ?>col-md-12<?php endif ?>">
          <?php the_content(); ?>

        </div> <!-- end col-md-8 / col-md-12 -->

        <?php if (is_active_sidebar('right-sidebar')): ?>
        <aside class="col-md-4 col-xl-3">
          <?php
            dynamic_sidebar('right-sidebar');
          ?>
        </aside> <!-- end col-md-4 -->
        <?php endif ?>
      </div> <!-- end row -->
    </article>
  </section>

<?php
  endwhile;
  endif;
  get_footer();
?>
