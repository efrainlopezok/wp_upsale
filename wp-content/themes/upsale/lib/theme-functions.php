<?php
/**
 * Upsale
 *
 * This file adds functions to the Upsale.
 *
 * @package Upsale
 * @author  Upsale
 * @license GPL-2.0+
 * @link    http://www.upsale.com/
 */

/**
* Updates theme settings on reset.
*
* @since 2.2.3
*/
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Upsale Settings',
		'menu_title'	=> 'Upsale',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

/** Remove pages and post titles **/
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

/** Remove Title & Description **/
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
/** Remove default site title and add custom site title **/
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

add_action( 'genesis_site_title', 'custom_site_title' );
function custom_site_title() { 
	echo '<a class="no-retina no-sticky" href="'.get_bloginfo('url').'" title="Upsale"><img src="'.get_field('logo','options').'" alt="Upsale"/></a>';
	echo '<a class="retina no-sticky" href="'.get_bloginfo('url').'" title="Upsale"><img src="'.get_field('retina_logo','options').'" alt="Upsale"/></a>';

	echo '<a class="no-retina sticky" href="'.get_bloginfo('url').'" title="Upsale"><img src="'.get_field('sticky_logo','options').'" alt="Upsale"/></a>';
	echo '<a class="retina sticky" href="'.get_bloginfo('url').'" title="Upsale"><img src="'.get_field('retina_sticky_logo','options').'" alt="Upsale"/></a>';
}

/** Add Upsale Info **/
 add_action( 'genesis_header_right','upsale_right' );
 function upsale_right(){

 	$emailCurrent = (pll_current_language() == "en")? get_field('upsale_email_en','options'):get_field('upsale_email','options');

 	echo '<div class="upsale-info">';
 		  		if (pll_current_language() == 'en') {
			     echo '<a href="tel:'.get_field('upsale_phone_en','options').'" class="upsale-phone">'.get_field('upsale_phone_en','options').'</a>';
            }else{
                 echo '<a href="tel:'.get_field('upsale_phone','options').'" class="upsale-phone">'.get_field('upsale_phone','options').'</a>';
            }
            
 		  	echo '<a class="talk-btn" href="mailto:'.$emailCurrent.'" class="upsale-email">TALK TO A SPECIALIST</a>
 		  </div>';

 	echo '<div class="box-language"><ul>';
 	pll_the_languages(array('show_flags'=>1,'show_names'=>0, 'dowpdown'=>0));
 	echo '</ul></div>';
 }

/** Remove Footer **/
remove_action( 'genesis_footer', 'genesis_do_footer' );

add_action( 'genesis_footer', 'custom_footer' );
function custom_footer(){
	echo '<div class="footer-upsale">';
		if (pll_current_language() == 'en') {
			echo '© Upsale • <a href="'.get_field('footer_sitemap', 'option').'">Sitemap</a>';
		}else{
			echo '© Upsale • <a href="'.get_field('footer_sitemap_es', 'option').'">Mapa del Sitio</a>';
		}
	echo '</div>';
}