<?php
// ********************************* //
/* Template Name: Widok pojedynczego produktu */
// ********************************* //
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

  <article id="post-<?php the_ID(); ?>" class="">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 col-md-6 px-0">
          <img src="<?php the_post_thumbnail_url() ?>" alt="<?php echo get_the_title() ?>" class="post-thumbnail">
        </div>
        <div class="col-sm-6 col-md-4 d-flex flex-column justify-content-center">
          <?php
            if ($root_parent = get_the_title($parent) == $root_parent = get_the_title($current)) {
          ?>
          <h3>
            <?php echo get_the_title($current);?>
          </h3>
          <?php the_excerpt(); ?>
        </div>
      </div>
    </div>
    
    <div class="container">
      <?php
        }
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