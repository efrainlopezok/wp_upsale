<?php
/**
 * Upsale
 *
 * Upsale Theme.
 *
 * Template Name: Sitemap
 *
 * @package Upsale
 * @author  Upsale
 * @license GPL-2.0+
 * @link    http://www.upsale.com/
 */

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
 
add_action( 'genesis_entry_content', 'genesis_page_archive_content' );
add_action( 'genesis_post_content', 'genesis_page_archive_content' );


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
 
/**
 * This function outputs sitemap-esque columns displaying all pages,
 * categories, authors, monthly archives, and recent posts.
 *
 * @since 1.6
 *
 * @uses genesis_a11y() to check for headings choice.
 * @uses genesis_sitemap() to generate the sitemap.
 *
 */
function genesis_page_archive_content() {
 
    $heading = ( genesis_a11y( 'headings' ) ? 'h2' : 'h4' );
 
    genesis_sitemap( $heading );
 
}
 
genesis();