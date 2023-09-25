<?php
/*
Upsale Button
-----------------------------*/
add_shortcode( 'upsale_button' , 'upsale_button_function' );

function upsale_button_function($atts, $content)	{
	$out	=	'';
	$out 	.=	'<a href="'.$atts['link'].'" class="upsale-button" style="background-color: '.$atts['background'].'; color: '.$atts['color'].';">'.$atts['text'].'</a>';
	
	return $out;
}

/*
Content Popup
-----------------------------*/
add_shortcode( 'content_popup' , 'content_popup_function' );

function content_popup_function($atts, $content)	{
	$out	=	'';
	$out 	.= '<div id="'.$atts['content_id'].'" class="white-popup mfp-hide" style="">';
		$out 	.=	do_shortcode($content);
	$out 	.=	'</div>';
	
	return $out;
}

/*
Services Carousel
-----------------------------*/
add_shortcode( 'services_carousel', 'services_carousel_function' );
function services_carousel_function($atts, $content) {
	global $wp_query;
	$args = array( 
        'posts_per_page'  => -1,
        'post_type'     => 'services',
        'orderby'    => 'post_date',
        'order'      => 'DESC'
    );
    $out = '';
    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts()):
    	$out .= '<div class="services-carousel" id="carousel-services">';
        while ( $wp_query->have_posts() ) : $wp_query->the_post();
        	$image = get_field('icon_services')['url'] ? get_field('icon_services')['url'] : '';
        	$out .= '<div class="service-item">';
        		$out .= '<div class="image-service"><img src="'.$image.'" /></div>';
				$out .= '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
                $short_desc = get_field('services_short_description') ? get_field('services_short_description') : '' ; 
                // echo $short_desc;
        		$out .= '<div class="excerpt-service">'.$short_desc.'</div>';
        	$out .= '</div>';
        endwhile;
        $out .= '</div>';
        $out .= '<script>
        jQuery(document).ready(function(){
        	jQuery("#carousel-services").slick({
		        dots: false,
		        arrows: true,
		        infinite: true,
		        slidesToShow: 5,
		        slidesToScroll: 1,
		        autoplay: true,
		  		autoplaySpeed: 3000,
		  		responsive: [
				    {
				      breakpoint: 1024,
				      settings: {
				        slidesToShow: 3,
				      }
				    },
				    {
				      breakpoint: 780,
				      settings: {
				        slidesToShow: 2,
				      }
				    },
				    {
				      breakpoint: 480,
				      settings: {
				        slidesToShow: 1,
				      }
				    }
				]
		    });
        });
        </script>';
        wp_reset_query();
    endif;
	return $out;
}

/*
Upsale Blog
-----------------------------*/
add_shortcode( 'upsale_blog' , 'upsale_blog_function' );

function upsale_blog_function($atts, $content)	{
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array( 
		'post_type' => 'post', 
		'posts_per_page' => 6, 
		'paged' => $paged,
	);
	
	$out	=	'';
	$out 	.= '<div id="upsale-blog">';
		$out .= '<div class="hero-blog">';	

			$wp_query = new WP_Query( $args );
			
			if($wp_query->have_posts()):

				$out .= '<div class="post-slider">';

				while ( $wp_query->have_posts() ) : $wp_query->the_post();

					$thumb_id = get_post_thumbnail_id();
					$thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
					
					$out .= '<div class="item-slider">';
						$out .= '<div class="item-background" style="background-image: url('.$thumb_url[0].')"></div>';
						$out .= '<div class="wrap">';
							$out .= '<h2>'.get_the_title().'</h2>';
							
							$categories = get_the_category( get_the_ID());
							foreach ( $categories as $category ) { 
								$out .= '<a href="'.esc_url( get_category_link($category->term_id)).'" class="post-category">'.$category->name.'</a>';
							}
							
							if(pll_current_language() == 'es')
								$out .= do_shortcode('[upsale_button link="#" text="Leer" background="white" color="#fff"]');
							else 
								$out .= do_shortcode('[upsale_button link="#" text="Read" background="white" color="#fff"]');

						$out .= '</div>';
					$out .= '</div>';

				endwhile;

				$out .= '</div>';

    			wp_reset_query();

			endif;

			$out .= '<div class="hero-blog-footer">';
				if(pll_current_language() == 'es'){
					$out .= '<a href="#subscribe-form" class="blog-subscriber">Suscríbete</a>';
					$out .= '<a href="#" class="blog-share">Comparte</a>';
				} else {
					$out .= '<a href="#subscribe-form" class="blog-subscriber">Subscribe</a>';
					$out .= '<a href="#" class="blog-share">Share</a>';
				}
				
				$out .= '<div id="custom-share">';
					$out .= do_shortcode('[ssba]');
				$out .= '</div>';
			$out .= '</div>';

		$out .= '</div>';

		/**/
		$out .= '<div class="blog-list">';
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
					
						$out .= '<a class="b-img-content"><a href="'.get_the_permalink().'"><img src="'.$thumb_url[0].'" /></a></div>';
						
						$out .= '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';

						$out .= '<p>'.get_the_excerpt().'</p>';
							
						$categories = get_the_category( get_the_ID());
						foreach ( $categories as $category ) { 
							$out .= '<a href="'.esc_url( get_category_link($category->term_id)).'" class="post-category">'.$category->name.'</a>';
						}

					$out .= '</div>';

				endwhile;

				/**/

				$out .= '<div class="blog-pagination">';
					
					$big = 999999999; // need an unlikely integer
 					
 					if(pll_current_language() == 'es')
						$out .= paginate_links( array(
						    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						    'format' => '?paged=%#%',
						    'prev_text' => __('Anterior'),
							'next_text' => __('Siguiente'),
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
		/**/
	$out 	.=	'</div>';

	/* PopUp Subscribe */
	$out .= '<div id="subscribe-form" class="white-popup mfp-hide">';
		if(pll_current_language() == 'es')
			$out .= do_shortcode('[contact-form-7 id="115" title="Subscribe Form"]');
		else
			$out .= do_shortcode('[contact-form-7 id="180" title="Subscribe Form EN"]');
	$out .= '</div>';
	
	return $out;
}

/*
Upsale Blog Subscribe Share
-----------------------------*/
add_shortcode( 'blog_subscribe_share' , 'upsale_blog_ss_function' );

function upsale_blog_ss_function($atts, $content)	{

	$out .= '<div class="blog-ss">';
		if(pll_current_language() == 'es'){
			$out .= '<a href="#subscribe-form" class="blog-subscriber">Suscríbete</a>';
			$out .= '<a href="#" class="blog-share">Comparte</a>';
		} else {
			$out .= '<a href="#subscribe-form" class="blog-subscriber">Subscribe</a>';
			$out .= '<a href="#" class="blog-share">Share</a>';
		}
		
		$out .= '<div id="custom-share">';
			$out .= do_shortcode('[ssba]');
		$out .= '</div>';
	$out .= '</div>';
	/* PopUp Subscribe */
	$out .= '<div id="subscribe-form" class="white-popup mfp-hide">';
		if(pll_current_language() == 'es')
			$out .= do_shortcode('[contact-form-7 id="115" title="Subscribe Form"]');
		else
			$out .= do_shortcode('[contact-form-7 id="180" title="Subscribe Form EN"]');
	$out .= '</div>';

	return $out;
}


/*
Upsale Blog List
-----------------------------*/
add_shortcode( 'blog_list' , 'upsale_blog_list_function' );

function upsale_blog_list_function($atts, $content)	{
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array( 
		'post_type' => 'post', 
		'posts_per_page' => 6, 
		'paged' => $paged,
	);

	$out .= '<div class="blog-list">';
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
					$out .= '<div class="b-img-content"><a href="'.get_the_permalink().'"><img src="'.$thumb_url[0].'" /></a></div>';
					$out .= '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
					$out .= '<p>'.get_the_excerpt().'</p>';
					$categories = get_the_category( get_the_ID());
					foreach ( $categories as $category ) { 
						$out .= '<a href="'.esc_url( get_category_link($category->term_id)).'" class="post-category">'.$category->name.'</a>';
					}
				$out .= '</div>';
			endwhile;

			$out .= '<div class="blog-pagination">';
					
				$big = 999999999; // need an unlikely integer

				if(pll_current_language() == 'es')
					$out .= paginate_links( array(
					    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					    'format' => '?paged=%#%',
					    'prev_text' => __('Anterior'),
						'next_text' => __('Siguiente'),
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

	return $out;
}

/*
Upsale Blog Page
-----------------------------*/
add_shortcode( 'blog_page' , 'upsale_blog_page_function' );

function upsale_blog_page_function($atts, $content)	{
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array( 
		'post_type' => 'post', 
		'posts_per_page' => 6, 
		'paged' => $paged,
	);

	$out .= '<div class="blog-page">';
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
					$out .= '<div class="b-img-content"><a href="'.get_the_permalink().'"><img src="'.$thumb_url[0].'" /></a></div>';
					
					$out .= '<div class="b-p-content">';
					$out .= '<div class="b-categories">';
					$categories = get_the_category( get_the_ID());
					if($categories) {
						foreach ( $categories as $category ) { 
							$out .= '<a href="'.esc_url( get_category_link($category->term_id)).'" class="post-category">'.$category->name.'</a>, ';
						}
						$out = substr($out, 0, -2);
					}
					else {
						$out .= '&nbsp;';
					}
					
					
					
					$out .= '</div>';

					$out .= '<h5><a href="'.get_the_permalink().'">'.get_the_title().'</a></h5>';
					$out .= '<p>'.get_the_excerpt().'</p>';

					$c_month = get_the_date('F');
					if(pll_current_language() == 'es') {
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
						$out .= '<p class="b-author-date">Por <a href="'.get_the_author_link().'">'.get_the_author().'</a> <strong>·</strong> '.get_the_date('d').', de '.$c_month.' de '.get_the_date('Y').'</p>';
					}
					else {
						$out .= '<p class="b-author-date">By <a href="'.get_the_author_link().'">'.get_the_author().'</a> <strong>·</strong> '.$c_month.' ' .get_the_date('d').' of '.get_the_date('Y').'</p>';	
					}

					

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
   			$out .= '</div>';
			/**/
			wp_reset_query();
			$out .= '</div>';
		endif;


	$out .= '</div>';

	return $out;
}

add_shortcode( 'clients' , 'clients_shortcode_function' );
function clients_shortcode_function($atts, $content) {
	$a = shortcode_atts( array(
        'posts' 			=>  '6',
    ), $atts );
	// arguments, adjust as needed
	$args = array(
		'post_type'      => 'clients',
		'posts_per_page' => $a['posts'],
		'post_status'    => 'publish',
		// 'orderby'		 => 'menu_order',
		'orderby'		 => 'post_date',
		'order'			 => 'DESC',
		'paged'          => get_query_var( 'paged' )
	);
	$out	=	'';
	 
	global $wp_query;
	$wp_query = new WP_Query( $args );
	ob_start();
	if ( have_posts() ) :
		$i = 1;
		$first = 'first'; 
		?>
			<div class="blog-wrap">
				<div class="wrap">

			<?php while ( have_posts() ) : the_post(); 
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
							

			?>	<div class="client-box one-third <?php echo $first;?>">
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
				endwhile; ?>

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
	return $out;
}

/*
Upsale Blog Page
-----------------------------*/
add_shortcode( 'letter' , 'letter_function' );

function letter_function($atts, $content)	{
	$out = '';

	$out .= '<div class="custom-letter">';
		$out .= '<span class="letter-text">'.$atts['l'].'</span>';
		$out .= '<div class="content-letter">'.$content.'</div>';
	$out .= '</div>';

	return $out;
}

/*
Last Posts
-----------------------------*/
add_shortcode( 'last_post' , 'last_post_function' );
function last_post_function($atts, $content)	{
	ob_start();

	$out = '';

	$args = array( 
        'posts_per_page'   => 4,
        'post_type'      => 'post',
        'orderby'    => 'post_date',
        'order'      => 'DESC'
    );
    $wp_query = new WP_Query( $args );
    ?>
   
    <?php
    if ( $wp_query->have_posts()):
        while ( $wp_query->have_posts() ) : $wp_query->the_post();
            ?>
            <div class="blog-info">

                <h4><a href="<?php echo get_the_permalink(); ?>"><?php echo the_title(); ?></a></h4>
                <span>
                <?php 
                    $cat = get_the_category();
                    $num_cat = count($cat);
                    $num = 1;
                    foreach ($cat as $value) {
                        echo $value->name;
                        if ($num_cat == $num ) {
                            $limiter = " ";
                        }else{
                            $limiter = " | ";
                        }
                        echo $limiter;
                        $num++;
                    }   
                ?>
                </span>
            </div>
            <?php
        endwhile;
    endif;
	$out = ob_get_clean();
	return $out;
}



/*
Search Blog
-----------------------------*/
add_shortcode( 'search_blog' , 'search_blog_function' );
function search_blog_function($atts, $content)	{
	ob_start();

	$out = '';
	?>
	<form method="post" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search ...', 'upsale' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'upsale' ); ?>" />
	</form>
	<?php
	
	
	$out = ob_get_clean();
	return $out;
}


/*
Landig Services
-----------------------------*/
add_shortcode( 'landing_services' , 'landing_services_function' );
function landing_services_function($atts, $content)	{
	ob_start();
	global $wp_query;
	
	$out = 'teststs';
	
    $args = array( 
        'posts_per_page'   => 6,
        'post_type'      => 'services',
        'orderby'    => 'post_date',
        'order'      => 'DESC'
    );

    $count = 1;
    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts()):
            while ( $wp_query->have_posts() ) : $wp_query->the_post();
                ?>
                <?php if ($count == 1): ?>
                    <div class="cont-services landing">
                <?php endif ?>
                    <div class="box-service <?php echo ($count == 2 ) ? 'center' : '' ?>">
                        <?php $image = get_field('icon_services')['url'] ? get_field('icon_services')['url'] : ''; ?>
                        <div class="img">
                            <img src="<?php echo $image; ?>" alt="">
                        </div>
                        <h2><?php echo the_title() ?></h2>
                        <?php //echo the_excerpt(); ?>
                        <?php 
                            $short_desc = get_field('services_short_description') ? get_field('services_short_description') : '' ; 
                            echo $short_desc;
                        ?>
                    </div>
                <?php if ($count == 3):?>
                    <?php $count = 0; ?>
                    </div>
                <?php endif ?>
                <?php $count++; ?>
                <?php
            endwhile;
        wp_reset_query();
    endif;
	
	$out = ob_get_clean();
	return $out;
}
/*
Landig Services
-----------------------------*/
add_shortcode( 'landing_v3_table' , 'landing_v3_table_function' );
function landing_v3_table_function($atts, $content)	{
	ob_start();
	$out = '';
	$table = get_field('table_content') ? get_field('table_content') : '' ;
	$bottom_text = get_field('bottom_text') ? get_field('bottom_text') : '' ;
	$table_content = $table['content'] ? $table['content'] : '' ;
	$col1 = $table_content['col_1'] ? $table_content['col_1'] : '' ;
	//var_dump($col1);

	if($table)
	{
	?>
	<div class="table-container">
		<table>
		<?php
		$var_at = 0;
		foreach($table_content as $con)
		{
			$var_at++;

			$val1 = $con["col_1"];
			$val2 = $con["col_2"];
			$val3 = $con["col_3"];
			$val4 = $con["col_4"];

				echo '<tr>' ;
				echo '<th data-column="">';
				if ($val1["button_group"]=="text_normal") {
					echo "".$val1["text_normal"]."";
				}
				if ($val1["button_group"]=="text_bold") {
					echo "<b>".$val1["text_bold"]."</b>";
				}
				if ($val1["button_group"]=="checked" && $val1["check_input"]==1) {
					?>
					<div class="checked-svg">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/checkmark.svg" alt="check">
					</div>
					<?php
				}
				echo '</th>';
				if ($var_at==1) {
					$v2 = $val2["text_bold"];
				}
				echo "<th data-column='".$v2."'>";
				if ($val2["button_group"]=="text_normal") {
					echo "".$val2["text_normal"]."";
				}
				if ($val2["button_group"]=="text_bold") {
					echo "<b>".$val2["text_bold"]."</b>";
				}
				if ($val2["button_group"]=="checked" && $val2["check_input"]==1) {
					?>
					<div class="checked-svg">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/checkmark.svg" alt="check">
					</div>
					<?php
				}
				echo '</th>';
				if ($var_at==1) {
					$v3 = $val3["text_bold"];
				}
				echo "<th data-column='".$v3."'>";
				
				if ($val3["button_group"]=="text_normal") {
					echo "".$val3["text_normal"]."";
				}
				if ($val3["button_group"]=="text_bold") {
					echo "<b>".$val3["text_bold"]."</b>";
				}
				echo '';
				if ($val3["button_group"]=="checked" && $val3["check_input"]==1) {
					?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/checkmark.svg" alt="check">
					<?php
				}
				echo '</th>';
				if ($var_at==1) {
					$v4 = $val4["text_bold"];
				}
				echo "<th data-column='".$v4."'>";

				if ($val4["button_group"]=="text_normal") {
					echo "".$val4["text_normal"]."";
				}
				if ($val4["button_group"]=="text_bold") {
					echo "<b>".$val4["text_bold"]."</b>";
				}
				if ($val4["button_group"]=="checked" && $val4["check_input"]==1) {
					?>
					<div class="checked-svg">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/checkmark.svg" alt="check">
					</div>
					<?php
				}
				echo '</th>';

				echo '</tr>' ;
		}
			?>
		</table>
		
		<div class="text-table-bottom">
		<?php echo $bottom_text; ?> 
		</div>
	</div>
		<?php
	}
}

add_shortcode('socials_upsale', 'upsale_socials_function');
function upsale_socials_function(){
	$out = '';
	$out .= '<div class="upsale-socials">';
		$out .= '<a class="facebook" href="'.get_field('upsale_facebook','options').'"></a>';
		$out .= '<a class="twitter" href="'.get_field('upsale_twitter','options').'"></a>';
	$out .= '</div>';
	return $out;
}
















