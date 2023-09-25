<?php 
/*
Remove markups Single Posts
-------------------------*/
// remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
// remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
// remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
// remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

remove_action ( 'genesis_loop', 'genesis_do_loop' );

add_action('genesis_after_header', 'post_category_function');
function post_category_function($atts, $content) {

	$category = get_category( get_query_var( 'cat' ) );
	$cat_id = $category->cat_ID;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
		'author' 		 => get_the_author_id(),
		// 'orderby'		 => 'menu_order',
		// // 'orderby'		 => 'post_date',
		// 'order'			 => 'ASC',
		'paged' => $paged,
	); 
	
	$out	=	'';
	
	global $wp_query;
	
	$out .= '<div class="blog-page">';

		echo '<h2>'.get_the_author().'</h2>';
		$wp_query = new WP_Query( $args );
		if($wp_query->have_posts()):
			$i = 0;
			$out .= '<div class="wrap">';
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				$i++;
				if($i==1) $first = ' first';
				else $first = '';
				if($i>=3) $i=0;
				$out .= '<div class="one-third'.$first.'">';
					$thumb_id = get_post_thumbnail_id();
					$thumb_url = wp_get_attachment_image_src($thumb_id, 'list-post', true);	
					$out .= '<div class="b-img-content"><img src="'.$thumb_url[0].'" /></div>';
					
					$out .= '<div class="b-p-content">';
					$out .= '<div class="b-categories">';
					$categories = get_the_category( get_the_ID());
					foreach ( $categories as $category ) { 
						$out .= '<a href="'.esc_url( get_category_link($category->term_id)).'" class="post-category">'.$category->name.'</a>, ';
					}
					$out = substr($out, 0, -2);
					
					$out .= '</div>';

					$out .= '<h5><a href="'.get_the_permalink().'">'.get_the_title().'</a></h5>';
					$out .= '<p>'.get_the_excerpt().'</p>';

					$c_month = get_the_date('F');
					switch ($c_month) {
					    case 'January':
					        $c_month = 'Enero';
					        break;
					    case 'February':
					        $c_month = 'Febrero';
					        break;
					    case 'March':
					        $c_month = 'Marzo';
					        break;
					    case 'April':
					        $c_month = 'Abril';
					        break;
					    case 'May':
					        $c_month = 'Mayo';
					        break;
					    case 'June':
					        $c_month = 'Junio';
					        break;
					    case 'July':
					        $c_month = 'Julio';
					        break;
					    case 'August':
					        $c_month = 'Agosto';
					        break;
					    case 'September':
					        $c_month = 'Septiembre';
					        break;
					    case 'October':
					        $c_month = 'Octubre';
					        break;
					    case 'November':
					        $c_month = 'Noviembre';
					        break;
					    case 'December':
					        $c_month = 'Diciembre';
					        break;
					}

					$out .= '<p>Por <a href="'.get_the_author_link().'">'.get_the_author().'</a> · '.get_the_date('d').', de '.$c_month.' de '.get_the_date('Y').'</p>';

					$out .= '</div>';
					
				$out .= '</div>';
			endwhile;

			$out .= '<div class="blog-pagination">';
					
				$big = 999999999; // need an unlikely integer

				if(pll_current_language() == 'es')
					$out .= paginate_links( array(
					    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					    'format' => '?paged=%#%',
					    'prev_text' => __('«'),
						'next_text' => __('»'),
					    'current' => max( 1, get_query_var('paged') ),
					    'total' => $wp_query->max_num_pages
					) );
				else 
					$out .= paginate_links( array(
				    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				    'format' => '?paged=%#%',
				    'prev_text' => __('Previous'),
					'next_text' => __('Next'),
				    'current' => max( 1, get_query_var('paged') ),
				    'total' => $wp_query->max_num_pages
				) );
   			$out .= '</nav>';
			/**/
			wp_reset_query();
			$out .= '</div>';
		endif;


	$out .= '</div>';
	$out .= '</div>';

	echo $out;
}

genesis();