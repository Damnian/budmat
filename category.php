<?php

get_header();

?>
<section class="main-content">
  <?php
    get_template_part( 'template-parts/subtitle' );
  ?>


  <div class="container-fluid">
    <div class="row child-post">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post();

      get_template_part( 'template-parts/content', 'category' );

      ?>

      <?php endwhile; else : ?>

        <div class="container">
          <h2>
            Ups...
          </h2>
          <p>
            Niestety w tej kategorii nie ma jeszcze wpisów. Skorzystaj z menu lub wyszukiwarki poniżej.
          </p>
          <div>
            <?php get_search_form(); ?>
          </div>
        </div>

      <?php endif; ?>
      
    </div>
  </div>

<div class="container">

<?php
  the_posts_pagination( array(
  'mid_size' => 3,
  'prev_text' => __( 'Poprzednia', 'budmat' ),
  'next_text' => __( 'Następna', 'budmat' ),
  // 'screen_reader_text' => __('Paginacja stron'),
  ) );
?>
</div>



</section>

<?php

get_footer();

?>