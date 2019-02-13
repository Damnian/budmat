<!-- widok domyślnego wyglądu strony -->

<?php
  get_header();
?>

<?php
  if ( have_posts() ) : while ( have_posts() ) : the_post();
?>


<section class="main-content">
<!-- import tytułu na niebieskim polu -->
  <?php
    get_template_part( 'template-parts/subtitle' );
  ?>
<!-- end import -->

  <article id="post-<?php the_ID(); ?>" class="py-1">
    <div class="container">

    <?php
      the_content();
    ?>

    </div>
  </article>

<?php
  endwhile;
  endif;
?>

</section>

<?php
  get_footer();
?>