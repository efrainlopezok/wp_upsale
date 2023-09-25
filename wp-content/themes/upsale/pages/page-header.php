<?php
/**
 * Upsale
 *
 * Upsale Theme.
 *
 * Template Name: Page Header
 *
 * @package Upsale
 * @author  Upsale
 * @license GPL-2.0+
 * @link    http://www.upsale.com/
 */

//* Remove standard post content output

remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action('genesis_after_header', 'before_content_title');
function before_content_title(){
	if (has_post_thumbnail()) {
		$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
		echo '<div class="header-single-services" style="background:url('.$image[0].');">';
	}else{
		echo '<div class="header-single-services" style="background:url('.get_field('header_services_default', 'option').');">';
	}
    echo '<div class="wrap">';
    echo '<h1>'.get_the_title().'</h1>';
    echo '</div>';
    echo '</div>';
}

 
genesis();