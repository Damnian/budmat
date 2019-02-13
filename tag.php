<?php

get_header();

?>
<section>
  <div class="subtitle py-2">
    <h2 class="container text-center">
      <?php the_tags(); ?>
    </h2>
  </div>


  <div class="container-fluid">
    <div class="row">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post();

      get_template_part( 'template-parts/content', 'category' );

      ?>

      <?php endwhile; else : ?>

        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>

      <?php endif; ?>
      
    </div>
  </div>

<div class="container">

<?php
  the_posts_pagination( array(
  'mid_size' => 3,
  'prev_text' => __( 'Poprzednia', 'budmat' ),
  'next_text' => __( 'Następna', 'budmat' ),
  'screen_reader_text' => __('&nbsp;'),
  ) );
?>
</div>



</section>

<?php

get_footer();

?>