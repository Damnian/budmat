<?php
// ********************************* //
/* Template Name: Right Sidebar Page */
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



    <article id="post-<?php the_ID(); ?>" class="container py-2">
      <div class="row">
        <div class="col-md-8 col-xl-9">
          <?php if ($root_parent = get_the_title($parent) !== $root_parent = get_the_title($current)) { ?>
            <h3>
              <?php echo get_the_title($current);?>
            </h3>
          <hr>
          <?php
            }
            the_content();
          ?>
        </div><!-- end col-md-8 -->

        <aside class="col-md-4 col-xl-3">
        <?php
          if (is_active_sidebar('right-sidebar')):
            dynamic_sidebar('right-sidebar');
          endif;
        ?>
        </aside> <!-- end col-md-4 -->
      </div> <!-- end row -->
    </article>

<?php
  endwhile;
  endif;
?>

  </section>

<?php
  get_footer();
?>
