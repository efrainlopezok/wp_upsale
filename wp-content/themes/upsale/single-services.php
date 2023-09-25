<?php

/*
Remove markups Single Posts
-------------------------*/
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

add_action('genesis_after_header', 'before_content_title');
function before_content_title(){
    // if (has_post_thumbnail()) {
    //     $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
    //     echo '<div class="header-single-services" style="background:url('.$image[0].');">';
    // }else{
    //     echo '<div class="header-single-services" style="background:url('.get_field('header_services_default', 'option').');">';
    // }
    // echo '<div class="wrap">';
    // echo '<h1>'.get_the_title().'</h1>';
    // echo '</div>';
    // echo '</div>';
}


// Run the Genesis loop.
genesis();