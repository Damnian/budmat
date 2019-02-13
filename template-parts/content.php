<!-- widok pojedynczego postu (importowany w single.php) -->
<section class="main-content">

  <?php
    get_template_part( 'template-parts/subtitle' );
  ?>


  <article id="post-<?php the_ID(); ?>" class="container py-2">

      <div class="row">
    
        <div class="<?php if (is_active_sidebar('right-sidebar')): ?>col-md-8 col-xl-9<?php else: ?>col-md-12<?php endif ?>">
          <p>
            <?php
              the_time('j F Y');
              if (count(get_the_category()) > 1) {
                ?>
                  <br>
                  Kategorie: <?php the_category(', '); ?>
                <?php
              } else {
                ?>
                  <br>
                  Kategoria: <?php the_category(', '); ?>
                <?php
              }
            ?>
          </p>

          <hr>

          <h2>
            <?php
              if (has_category()) {
                the_title();
              }
            ?>
          </h2>

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