  <div class="subtitle py-2">
    <h2 class="container text-center">
      <?php
        if (is_page()) {
          $current = $post->ID;
          $parent = $post->post_parent;
          $grandparent_get = get_post($parent);
          $grandparent = $grandparent_get->post_parent;

          if ($root_parent = get_the_title($grandparent) !== $root_parent = get_the_title($current)) {
              echo get_the_title($grandparent);
          } else {
            echo get_the_title($parent);
            }
        } // post na blogu
        elseif (is_single()) {
          the_title();
        } // archiwum
        elseif (is_attachment()) {
          the_title();
        } // autor
        elseif (is_author()) {
          ?> Posty użytkownika <?php the_author();
        } // kategoria
        elseif (is_category()) {
          single_cat_title();
        } // archiwum miesiąc
        elseif (is_archive()) {
          the_archive_title();
        }
      ?>
    </h2>
  </div>

  <?php
    foreach((get_the_category()) as $category) { 
      if ($category->cat_name == "Realizacje" && ( has_nav_menu( 'filtering' ) )) {
        ?>
          <div class="middle-menu container-fluid">
            <div class="row">
              <nav class="col-md-12 d-flex filtering-nav">
                <h3 class="middle-menu__header text-right">
                  Filtruj
                </h3>
                <button class="btn ham-btn middle-menu__btn px-0">
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                </button>
                  <?php
                    wp_nav_menu(array
                      (
                        'theme_location' => 'filtering',
                        'container' => false,
                        'menu_class' => 'filtering-menu list-unstyled',
                        'menu_id' => 'filtering-menu'
                      )
                    );
                  ?>
              </nav>
            </div>
          </div>
        <?php
      }
    }
  ?>