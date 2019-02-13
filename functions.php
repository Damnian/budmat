<?php

if ( ! function_exists( 'budmat_setup' ) ) :

function budmat_setup() {

  load_theme_textdomain( 'budmat' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 825, 510, true );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );

  /*
   * Enable support for Post Formats.
   *
   * See: https://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
  ) );

  // Indicate widget sidebars can use selective refresh in the Customizer.
  add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // budmat_setup

add_action( 'after_setup_theme', 'budmat_setup' );


// dodawanie custom zajawek
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'my_add_excerpts_to_pages' );

// dodawanie stylów i skryptów
function budmat_theme_scripts() {

// dodanie podstawowego pliku ze stylami
  wp_enqueue_style (
    'style',
    get_stylesheet_uri(),
    false,
    null,
    'all'
  );

// wyrejestrowanie wbudowanego javascript (wcześniej rodziło problemy w personalizacji)
  wp_deregister_script('jquery');

// zarejestrowanie innego jquery
  wp_enqueue_script(
    'jquery',
    'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',
    array(),
    null,
    true
  );

  wp_enqueue_script(
    'jquery-ui',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js',
    array('jquery'),
    null,
    true
  );

// zarejestrowanie własnych skryptów
  wp_enqueue_script(
    'scripts',
    get_template_directory_uri() . '/js/scripts.js',
    array('jquery'),
    null,
    true
  );
}
// wywołanie powyższej funkcji
add_action( 'wp_enqueue_scripts', 'budmat_theme_scripts' );

// dodawanie logo witryny
function budmat_theme_logo() {
  
  add_theme_support( 'custom-logo', array(
    // 'height'      => 100,
    'flex-height' => true,
    'flex-width' => true,
    // 'header-text' => array( 'site-title', 'site-description' ),
  ) );
}

add_action( 'after_setup_theme', 'budmat_theme_logo' );

// dodawanie głównego menu
function register_menus() {
  register_nav_menu('primary','Top menu');
  register_nav_menu('filtering','Filtr realizacji');
}

add_action( 'after_setup_theme', 'register_menus' );

// Register our sidebars and widgetized areas.

function budmat_widgets_init() {

  register_sidebar( array(
    'name'          => __('Footer Left Sidebar', 'budmat'),
    'id'            => 'footer-left-sidebar',
    'before_widget' => '<div class="sidebar-section">',
    'after_widget'  => '</div>',
    'before_title'  => '<p class="sidebar-title mt-1 mb-2">',
    'after_title'   => '</p>',
  ) );

  register_sidebar( array(
    'name'          => __('Footer Middle Sidebar', 'budmat'),
    'id'            => 'footer-middle-sidebar',
    'before_widget' => '<div class="sidebar-section">',
    'after_widget'  => '</div>',
    'before_title'  => '<p class="sidebar-title mt-1 mb-2">',
    'after_title'   => '</p>',
  ) );

  register_sidebar( array(
    'name'          => __('Footer Right Sidebar', 'budmat'),
    'id'            => 'footer-right-sidebar',
    'before_widget' => '<div class="sidebar-section">',
    'after_widget'  => '</div>',
    'before_title'  => '<p class="sidebar-title mt-1 mb-2">',
    'after_title'   => '</p>',
  ) );
  register_sidebar( array(
    'name'          => __('Footer Bottom Center Sidebar', 'budmat'),
    'id'            => 'footer-bottom-sidebar',
    'description'   => __( 'Dodaj widget, by wyświetlały sie na samym dole strony', 'budmat' ),
    'before_widget' => '<div class="sidebar-section">',
    'after_widget'  => '</div>',
    'before_title'  => '<p class="sidebar-title">',
    'after_title'   => '</p>',
  ) );
  register_sidebar( array(
    'name'          => __('Right Sidebar', 'budmat'),
    'id'            => 'right-sidebar',
    'description'   => __( 'Dodaj widgety, by wyświetlały sie z prawej strony', 'budmat' ),
    'before_widget' => '<div class="sidebar-section">',
    'after_widget'  => '</div>',
    'before_title'  => '<p class="sidebar-title">',
    'after_title'   => '</p>',
  ) );
}
add_action( 'widgets_init', 'budmat_widgets_init' );

include( get_stylesheet_directory() . '/inc/shortcode.php' );

// function theme_prefix_the_custom_logo() {
//   if ( function_exists( 'the_custom_logo' ) ) {
//     the_custom_logo();
//   }
// }


remove_shortcode('gallery');
add_shortcode('gallery', 'gallery_shortcode2');

/**
 * Builds the Gallery shortcode output.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @staticvar int $instance
 *
 * @param array $attr {
 *     Attributes of the gallery shortcode.
 *
 *     @type string       $order      Order of the images in the gallery. Default 'ASC'. Accepts 'ASC', 'DESC'.
 *     @type string       $orderby    The field to use when ordering the images. Default 'menu_order ID'.
 *                                    Accepts any valid SQL ORDERBY statement.
 *     @type int          $id         Post ID.
 *     @type string       $itemtag    HTML tag to use for each image in the gallery.
 *                                    Default 'dl', or 'figure' when the theme registers HTML5 gallery support.
 *     @type string       $icontag    HTML tag to use for each image's icon.
 *                                    Default 'dt', or 'div' when the theme registers HTML5 gallery support.
 *     @type string       $captiontag HTML tag to use for each image's caption.
 *                                    Default 'dd', or 'figcaption' when the theme registers HTML5 gallery support.
 *     @type int          $columns    Number of columns of images to display. Default 3.
 *     @type string|array $size       Size of the images to display. Accepts any valid image size, or an array of width
 *                                    and height values in pixels (in that order). Default 'thumbnail'.
 *     @type string       $ids        A comma-separated list of IDs of attachments to display. Default empty.
 *     @type string       $include    A comma-separated list of IDs of attachments to include. Default empty.
 *     @type string       $exclude    A comma-separated list of IDs of attachments to exclude. Default empty.
 *     @type string       $link       What to link each image to. Default empty (links to the attachment page).
 *                                    Accepts 'file', 'none'.
 * }
 * @return string HTML content to display gallery.
 */
function gallery_shortcode2( $attr ) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( empty( $attr['orderby'] ) ) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }

  /**
   * Filters the default gallery shortcode output.
   *
   * If the filtered output isn't empty, it will be used instead of generating
   * the default gallery template.
   *
   * @since 2.5.0
   * @since 4.2.0 The `$instance` parameter was added.
   *
   * @see gallery_shortcode()
   *
   * @param string $output   The gallery output. Default empty.
   * @param array  $attr     Attributes of the gallery shortcode.
   * @param int    $instance Unique numeric ID of this gallery shortcode instance.
   */
  $output = apply_filters( 'post_gallery', '', $attr, $instance );
  if ( $output != '' ) {
    return $output;
  }

  $html5 = current_theme_supports( 'html5', 'gallery' );
  $atts = shortcode_atts( array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post ? $post->ID : 0,
    'itemtag'    => $html5 ? 'figure'     : 'dl',
    'icontag'    => $html5 ? 'div'        : 'dt',
    'captiontag' => $html5 ? 'figcaption' : 'dd',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => '',
    'link'       => '',
    'descriptiontag' => 'p'
  ), $attr, 'gallery' );

  $id = intval( $atts['id'] );

  if ( ! empty( $atts['include'] ) ) {
    $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( ! empty( $atts['exclude'] ) ) {
    $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  } else {
    $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  }

  if ( empty( $attachments ) ) {
    return '';
  }

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment ) {
      $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
    }
    return $output;
  }

  $itemtag = tag_escape( $atts['itemtag'] );
  $captiontag = tag_escape( $atts['captiontag'] );
  $icontag = tag_escape( $atts['icontag'] );
  $valid_tags = wp_kses_allowed_html( 'post' );
  if ( ! isset( $valid_tags[ $itemtag ] ) ) {
    $itemtag = 'dl';
  }
  if ( ! isset( $valid_tags[ $captiontag ] ) ) {
    $captiontag = 'dd';
  }
  if ( ! isset( $valid_tags[ $icontag ] ) ) {
    $icontag = 'dt';
  }

  $columns = intval( $atts['columns'] );
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = is_rtl() ? 'right' : 'left';

  $selector = "gallery-{$instance}";

  $gallery_style = '';

  /**
   * Filters whether to print default gallery styles.
   *
   * @since 3.1.0
   *
   * @param bool $print Whether to print default gallery styles.
   *                    Defaults to false if the theme supports HTML5 galleries.
   *                    Otherwise, defaults to true.
   */
  if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
    $gallery_style = "
    <style type='text/css'>
      #{$selector} {
        margin: auto;
      }
      #{$selector} .gallery-item {
        float: {$float};
        margin-top: 10px;
        text-align: center;
        width: {$itemwidth}%;
      }
      #{$selector} img {
        border: 2px solid #cfcfcf;
      }
      #{$selector} .gallery-caption {
        margin-left: 0;
      }
      /* see gallery_shortcode() in wp-includes/media.php */
    </style>\n\t\t";
  }

  $size_class = sanitize_html_class( $atts['size'] );
  $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

  /**
   * Filters the default gallery shortcode CSS styles.
   *
   * @since 2.5.0
   *
   * @param string $gallery_style Default CSS styles and opening HTML div container
   *                              for the gallery shortcode output.
   */
  $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

  $i = 0;
  foreach ( $attachments as $id => $attachment ) {

    $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
    if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
      $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
    } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
      $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
    } else {
      $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
    }
    $image_meta  = wp_get_attachment_metadata( $id );

    $orientation = '';
    if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
      $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
    }
    $output .= "<{$itemtag} class='gallery-item'>";
    $output .= "
      <{$icontag} class='gallery-icon {$orientation}'>
        $image_output
      </{$icontag}>";



    if ( $captiontag && trim($attachment->post_excerpt) ) {
      $output .= "
        <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
        " . wptexturize($attachment->post_excerpt) . "
        </{$captiontag}>";
    }
    $output .= "</{$itemtag}>";
    if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
      $output .= '<br style="clear: both" />';
    }




    
  }

  if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
    $output .= "
      <br style='clear: both' />";
  }

  $output .= "
    </div>\n";

  return $output;
}