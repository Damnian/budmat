<!DOCTYPE html>
<html <?php language_attributes(); ?> class="html">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title(); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

  <?php wp_head(); ?>

</head>
  <body>
    <header>
      <div class="top-bar py-1">
        <div class="container">
          <?php get_search_form(); ?>
        </div>
      </div>
      <div class="top-menu container-fluid">
          <div class="row">
            <h1 class="top-menu__header my-1 col-md-3">
              <a href="<?php echo home_url(); ?>">
                <img src="<?php 
                  $custom_logo_id = get_theme_mod( 'custom_logo' );
                  $image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); 
                  echo $image[0]; ?>" alt="<?php bloginfo('name') . bloginfo('description'); ?>" class="website-logo">
              </a>
            </h1>
            <nav class="col-md-9 nav top-menu__nav">
              <h2>
                Menu
              </h2>
              <button class="btn ham-btn top-menu__btn px-0">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </button>
                <?php
                  wp_nav_menu(array
                    (
                      'theme_location' => 'primary',
                      'container' => false,
                      'menu_class' => 'main-menu list-unstyled',
                      'menu_id' => 'main-menu'
                    )
                  );
                ?>
            </nav>
          </div>
        <div class="top-menu__overlay"></div>
      </div><!-- end top-menu -->
    </header>
