<?php
// ********************************* //
/* Template Name: Widok kategorii produktów */
// ********************************* //
  get_header();
?>
<!-- widok strony produktowej, np. kategorii dachy modulowe -->
<?php
  if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

  <section class="main-content">
    <div class="subtitle py-2">
      <h2 class="container text-center">
        <?php
          the_title();
        ?>
      </h2>
    </div>

    <article class="container">
      <?php
        the_content();
      ?>
    </article>

    <div class="container-fluid">
      <div class="row child-post">

        <?php
          $mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', ) );

          foreach( $mypages as $page ) {
            $content = $page->post_content;
    //    if ( ! $content ) // Check for empty page
    //      continue;
            $content = apply_filters( 'the_content', $content );
        ?>
        <div class="child-post__wrapper">
          <a href="<?php echo get_page_link( $page->ID ); ?>" class="child-post__anchor">
            <div class="child-post__picture">
              <div class="single-post-overlay"></div>
              <?php echo get_the_post_thumbnail( $page->ID, 'large' ); ?>
            </div>
            <h3 class="child-post__title px-1">
              <?php echo $page->post_title; ?>
            </h3>
            <p class="child-post__entry px-1">
              <?php echo $page->post_excerpt; ?>
            </p>
           </a>
        </div>
        <?php
        }
      ?>
      </div>
    </div>
<?php
  endwhile;
  endif;
?>

  </section>
<?php
  get_footer();
?>