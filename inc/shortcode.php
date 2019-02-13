<?php

// row
function flex_row($atts, $content = null){  
    return '<div class="row">'.do_shortcode($content).'</div>';
}
add_shortcode( 'row', 'flex_row' );
// container-fluid
function flex_container_fluid($atts, $content = null){  
    return '</div><div class="container-fluid">'.do_shortcode($content).'</div><div class="container">';
}
add_shortcode( 'c-fluid', 'flex_container_fluid' );
// col-md-1
function flex_col_md_1($atts, $content = null){  
    return '<div class="col-md-1">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-1', 'flex_col_md_1' );
// col-md-2
function flex_col_md_2($atts, $content = null){  
    return '<div class="col-md-2">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-2', 'flex_col_md_2' );
// col-md-3
function flex_col_md_3($atts, $content = null){  
    return '<div class="col-md-3">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-3', 'flex_col_md_3' );
// col-md-4
function flex_col_md_4($atts, $content = null){  
    return '<div class="col-md-4">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-4', 'flex_col_md_4' );
// col-md-5
function flex_col_md_5($atts, $content = null){  
    return '<div class="col-md-5">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-5', 'flex_col_md_5' );
// col-md-6
function flex_col_md_6($atts, $content = null){  
    return '<div class="col-md-6">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-6', 'flex_col_md_6' );
// col-md-7
function flex_col_md_7($atts, $content = null){  
    return '<div class="col-md-7">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-7', 'flex_col_md_7' );
// col-md-8
function flex_col_md_8($atts, $content = null){  
    return '<div class="col-md-8">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-8', 'flex_col_md_8' );
// col-md-9
function flex_col_md_9($atts, $content = null){  
    return '<div class="col-md-9">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-9', 'flex_col_md_9' );
// col-md-10
function flex_col_md_10($atts, $content = null){  
    return '<div class="col-md-10">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-10', 'flex_col_md_10' );
// col-md-11
function flex_col_md_11($atts, $content = null){  
    return '<div class="col-md-11">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-11', 'flex_col_md_11' );
// col-md-12
function flex_col_md_12($atts, $content = null){  
    return '<div class="col-md-12">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col-md-12', 'flex_col_md_12' );


// section-title
function section_title($atts, $content = null){  
    return '<div class="section-title">'.do_shortcode($content).'</div>';
}
add_shortcode( 'section-title', 'section_title' );

function wptb_grid_content_filter( $content ) {
    $shortcodes = array(
        'row',
        'c-fluid',
        'col-md-1',
        'col-md-2',
        'col-md-3',
        'col-md-4',
        'col-md-5',
        'col-md-6',
        'col-md-7',
        'col-md-8',
        'col-md-9',
        'col-md-10',
        'col-md-11',
        'col-md-12',
        'section-title'
    );
    $block = join( '|', $shortcodes );
    $rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]", $content );
    $rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]", $rep );
    return $rep;
}

add_filter( 'the_content', 'wptb_grid_content_filter' );
