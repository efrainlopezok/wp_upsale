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

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Theme Functions.
include_once( get_stylesheet_directory() . '/lib/theme-functions.php' );
// Shortcodes.
include_once( get_stylesheet_directory() . '/lib/shortcodes/shortcodes.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'upsale_localization_setup' );
function upsale_localization_setup(){
	load_child_theme_textdomain( 'upsale', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Upsale' );
define( 'CHILD_THEME_URL', 'http://www.upsale.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'upsale_enqueue_scripts_styles' );
function upsale_enqueue_scripts_styles() {
	wp_enqueue_style( 'Lato', 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&display=swap', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'Open-Sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,600i,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/css/slick.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() . '/css/slick-theme.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() . '/css/slick-theme.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'mfp-css', get_stylesheet_directory_uri() . '/css/magnific-popup.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri() . '/css/custom.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'custom2-css', get_stylesheet_directory_uri() . '/css/custom2.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'custom3-css', get_stylesheet_directory_uri() . '/css/custom3.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'responsive-css', get_stylesheet_directory_uri() . '/css/responsive.css', array(), CHILD_THEME_VERSION );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'upsale-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'upsale-responsive-menu',
		'genesis_responsive_menu',
		upsale_responsive_menu_settings()
	);

	wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . "/js/slick.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'mfp-js', get_stylesheet_directory_uri() . "/js/jquery.magnific-popup.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . "/js/custom.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script( 'custom-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php') ) );
}

// Define our responsive menu settings.
function upsale_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'upsale' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'upsale' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

add_image_size( 'list-post', 346, 216, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'upsale' ), 'secondary' => __( 'Footer Menu', 'upsale' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'upsale_secondary_menu_args' );
function upsale_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'upsale_author_box_gravatar' );
function upsale_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'upsale_comments_gravatar' );
function upsale_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

//Custom Schema
add_action( 'wp_head', 'shema_header_metadata' );
function shema_header_metadata() {

    $schema = get_field('schema');
    if($schema){
        echo '<!-- inicio codex schema-->';
        echo $schema;
        echo '<!-- fin codex schema-->';
    }

}

/*******************************
*	Add Clients
*******************************/
add_action( 'init', 'issues_function' ); 
function issues_function() {
 
   $labels = array(
    'name' => __( 'Clients' ),
    'singular_name' => __( 'Client' ),
    'all_items' => __('All Clients'),
    'add_new' => _x('Add new Client', 'Clients'),
    'add_new_item' => __('Add new Client'),
    'edit_item' => __('Edit Client'),
    'new_item' => __('New Client'),
    'view_item' => __('View Client'),
    'search_items' => __('Search in Clients'),
    'not_found' =>  __('No Clients found'),
    'not_found_in_trash' => __('No Clients found in trash'), 
    'parent_item_colon' => ''
    );
 
    $args = array(
	    'labels' => $labels,
	    'public' => true,
	    'has_archive' => true,
	    'menu_icon' => 'dashicons-groups',
	    'rewrite' => array('slug' => 'client'),
	   // 'taxonomies' => array( 'category', 'post_tag' ),
	    'supports'  => array( 'title', 'editor', 'thumbnail' , 'excerpt' )       
    );
 
  register_post_type( 'clients', $args);
}

// Taxonomy
function create_tags_clients() {
    register_taxonomy(
        'tag-client',
        'clients',
        array(
            'labels' => array(
                'name' => 'Tags',
                'add_new_item' => 'Add New Tag',
                'new_item_name' => "New Tag"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
add_action( 'init', 'create_tags_clients', 0 );



genesis_register_sidebar( array(
 'id' => 'contact_us_bottom',
 'name' => __( 'Contact Us' ),
 'description' => __( 'Contact Us Bottom' ),
 ) );

function themeprefix_search_button_text( $text ) {
	if(get_bloginfo('language') == 'en-US')
		return ( 'Search this website …');
	else 
		return ( 'Buscar en este sitio web …');
}
add_filter( 'genesis_search_text', 'themeprefix_search_button_text' );

// Remove Edit link
add_filter( 'genesis_edit_post_link', '__return_false' );


function add_bottom_function_custom() {
	echo '<div class="contact-general-bottom">';
		echo '<div class="wrap">';
			if(get_bloginfo('language') == 'en-US') {
				echo '<h2>'.get_field('contact_us_title', 'option').'</h2>';
				echo '<p>'.get_field('contact_us_subtitle', 'option').'</p>';
				echo do_shortcode(get_field('contact_form_en', 'option'));
			}else{
				echo '<h2>'.get_field('contact_us_title_es', 'option').'</h2>';
				echo '<p>'.get_field('contact_us_subtitle_es', 'option').'</p>';
				echo do_shortcode(get_field('contact_form_es', 'option'));
			}
		echo '</div>';
	echo '</div>';
}
add_action('genesis_before_footer', 'add_bottom_function_custom', 5);



/*   v1custom post ant taxonomy
--------------------------------*/
add_action( 'init', 'create_post_type' );
function create_post_type() {
  	register_post_type( 'services',
  		array(
  			'labels' => array(
  				'name' => __( 'Services' ),
  				'singular_name' => __( 'service' )
  			),
  			'public' => true,
  			'has_archive' => true,
  			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
  			'rewrite' =>array('slug' => 'services' ),
  		)
  	);
  	// create a new taxonomy
  	register_taxonomy('services', array('services'),array(
  		'hierarchical' => true,
  		'label' => $labels,
  		'show_ui' => true,
  		'show_admin_column' => true,
  		'query_var' =>true,
  		'rewrite' => array('slug' => 'services' ),
  	)
  );
 }


 // Register new sidebar
genesis_register_sidebar( array(
	'id' => 'blog-sidebar',
	'name' => 'Blog Sidebar',
	'description' => 'This is the sidebar Blog page.',
	'before_widget' => '<li id="%1$s" class="widget %2$s blog-item">',
	'after_widget'  => '</li>',
) );

//* Add Custom Pagination with numbers
function pagination_bar( $custom_query ) {
    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
			'total' => $total_pages,
			'prev_text' => __( '<' ),
			'next_text' => __( '>' ),
        ));
    }
}

//* Search Blog Page
function upsale_search_ajax(){

    global $wp_query;

    $out = '';
      if(isset($_POST['s'])) {

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $s = $_POST['s'];

        $args = array(
            's' => $s,
            'post_type' => 'post'
        );
        $count = 0;
        $wp_query = new WP_Query( $args );
        $out .= '<div class="cont-post">';
        if ( $wp_query->have_posts()):
            while ( $wp_query->have_posts() ) : $wp_query->the_post();
                $class = (($count % 2) == 0  ) ? 'first' : '' ;
                $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                $out .= '<div class="one-half bottom '.$class.' '.$count.'">';
                    $out .= '<div class="cont-blog">';
                        $out .= '<a href="'.get_the_permalink().'"><img class="img-blog" src="'.$image.'" /></a>';
                        $out .= '<div class="blog-info">';
                            $out .= '<h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
                            $out .= '<span>';
                                $cat = get_the_category();
                                $num_cat = count($cat);
                                $num = 1;
                                foreach ($cat as $value) {
                                    $out .= $value->name;
                                    if ($num_cat == $num ) {
                                        $limiter = " ";
                                    }else{
                                        $limiter = " | ";
                                    }
                                    $out .= $limiter;
                                    $num++;
                                }
                $out .= '</span></div></div></div>';
                
                $count++;
            endwhile;
            wp_reset_query();
        endif;
        $out .= '</div>';
        $final['result'] = $out;
    }else{
    	$final['result'] = 'nothing';
    }
    echo json_encode($final);
    die();
}
add_action('wp_ajax_nopriv_upsale_search_ajax', 'upsale_search_ajax');
add_action('wp_ajax_upsale_search_ajax', 'upsale_search_ajax');

function plane_image_func( $atts ) {
	ob_start();
	?>
<div class="plane-section" style="background:url(<?php echo get_stylesheet_directory_uri() ?>/images/bg-gray-plane.png);    
		background-repeat: no-repeat;
		background-position: center;">
   <img src="<?php echo get_stylesheet_directory_uri() ?>/images/plane.png" alt="" class="wow fadeInUp plane-img">
   <img src="<?php echo get_stylesheet_directory_uri() ?>/images/icons-bg.png" alt="" class="wow fadeIn icons-bg">
</div>
<?php
    return ob_get_clean();
}
add_shortcode( 'plane_image', 'plane_image_func' );

add_filter('use_block_editor_for_post_type', '__return_false', 100);