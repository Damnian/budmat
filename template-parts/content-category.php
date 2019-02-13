



        <div class="child-post__wrapper">
          <a href="<?php the_permalink(); ?>" class="child-post__anchor">
            <div class="child-post__picture">
              <div class="single-post-overlay"></div>
              <?php the_post_thumbnail('large') ?>
            </div>
            <div>
              <p class="mx-0 my-0 px-1 py-1">
                <?php the_time('j.m.Y'); ?>
              </p>
              <h3 class="child-post__title px-1 my-0 pb-1">
                <?php the_title(); ?>
              </h3>
            </div>
           </a>
        </div>
