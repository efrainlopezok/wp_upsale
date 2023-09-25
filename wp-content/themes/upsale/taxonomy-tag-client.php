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



add_action('genesis_after_content', 'post_category_function');

function post_category_function($atts, $content) {



	$taxonomy = get_taxonomy( 'tag-client' );



	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(

		'post_type'      => 'clients',

		'posts_per_page' => 6,

		'post_status'    => 'publish',

		'tax_query' => array(

            array(

                'taxonomy' => 'tag-client',

                'field' => 'slug',

                'terms' => array( get_query_var( 'tag-client' ) ),

            ),

        ),

		// 'orderby'		 => 'menu_order',

		// // 'orderby'		 => 'post_date',

		// 'order'			 => 'ASC',

		'paged' => $paged,

	);



	$out	=	'';



	global $wp_query;

	$wp_query = new WP_Query( $args );

	ob_start();



	if(have_posts()):

		$i = 1;

		$first = 'first';

		?>

		<div class="blog-wrap">

			<div class="wrap">

		<?php



		while ( have_posts() ) : the_post();

			if($i > 1)

				$first = '';

			$image = '';

			if ( has_post_thumbnail() ) {

				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

					if ( ! empty( $large_image_url[0] ) ) {

					   $image = $large_image_url[0];



					}

			}



			$terms = get_the_term_list( get_the_ID(), 'tag-client', '', ', ', '');

			?>

			<div class="client-box one-third <?php echo $first;?>">

					<picture>

						<img src="<?php echo get_the_post_thumbnail_url();?>" onclick="window.location='<?php echo get_permalink(); ?>';" style="cursor: pointer;"/>

					</picture>

					<div class="client-tags">

						<h3><?php echo $terms; ?></h3>

					</div>

					<div class="client-content">

						<h4><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title();?></a></h4>

						<p><?php echo get_the_excerpt( );?><br>

							<a href="<?php echo get_the_permalink(); ?>" class="view-more"><?php echo __('Ver más') ?></a>

						</p>

					</div>

			</div>

			<?php

			$i++;

			if($i > 3) {

				$i = 1;

				$first = 'first';

			}

		endwhile;?>



		<?php the_posts_pagination(array(

				'prev_text'	=> '«',

				'next_text'	=> '»'

			)); ?>



			</div>

		</div>





	<?php endif;

	wp_reset_query();

	$out = ob_get_contents();

	ob_end_clean();

	echo $out;

}



genesis();