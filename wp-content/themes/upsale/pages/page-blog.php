<?php
/**
 * Upsale
 *
 * Upsale Theme.
 *
 * Template Name: Page / Blog
 *
 * @package Upsale
 * @author  Upsale
 * @license GPL-2.0+
 * @link    http://www.upsale.com/
 */


// Page 

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_loop' ); // Add custom loop
function custom_do_loop() {
    
    global $wp_query; 

    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array( 
        'posts_per_page'   => 5,
        'post_type'      => 'post',
        'orderby'    => 'post_date',
        'order'      => 'DESC',
        'paged'          => $paged
    );
    $count = 0;
    $wp_query = new WP_Query( $args );
    ?>
    <div class="cont-post">
    <?php
    if ( $wp_query->have_posts()):
        while ( $wp_query->have_posts() ) : $wp_query->the_post();
            ?>
            <?php 
                $image = get_the_post_thumbnail_url($wp_query->ID, 'full');
            ?>
            <?php if ($count == 0): ?>
                    <div class="one first top">
                        <div class="cont-blog">
                            <div class="featured-image-big">
                                <a href="<?php echo the_permalink(); ?>"><img class="img-blog" src="<?php echo $image; ?>" /></a>
                            </div>
                            <div class="blog-info">
                                <h2><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                                <span>
                                <?php 
                                    $cat = get_the_category();
                                    $num_cat = count($cat);
                                    $num = 1;
                                    foreach ($cat as $value) {
                                        echo '<a href="'.esc_url(get_category_link($value->term_id)).'">'.$value->name.'</a>';
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
                        </div>
                    </div>
            <?php else: ?>
                <?php $class = (($count % 2) != 0 ) ? 'first' : '' ; ?>
                <div class="one-half bottom <?php echo $class ?> <?php echo $count ?>">
                    <div class="cont-blog">
                        <div class="featured-image">
                            <a href="<?php echo the_permalink(); ?>"><img class="img-blog" src="<?php echo $image; ?>" /></a>
                        </div>
                      
                        <div class="blog-info">
                            <h2><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                            <span>
                            <?php 
                                $cat = get_the_category();
                                $num_cat = count($cat);
                                $num = 1;
                                foreach ($cat as $value) {
                                    echo '<a href="'.esc_url(get_category_link($value->term_id)).'">'.$value->name.'</a>';
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
                    </div>
                </div>
            <?php endif ?>
            <?php
            $count++;
        endwhile;
    endif;
    ?>
    </div>
    <?php
    echo '<div class="c-pagination text-left">';
        pagination_bar( $wp_query );
    echo '</div>';
    
}

add_action( 'genesis_before', 'wpsites_remove_genesis_breadcrumbs' );
function wpsites_remove_genesis_breadcrumbs() {
    remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
}

add_action('get_header','cd_change_genesis_sidebar');
function cd_change_genesis_sidebar() {
    remove_action( 'genesis_sidebar', 'genesis_do_sidebar' ); //remove the default genesis sidebar
    add_action( 'genesis_sidebar', 'cd_do_sidebar' ); //add an action hook to call the function for my custom sidebar
}

//Function to output my custom sidebar
function cd_do_sidebar() {
    dynamic_sidebar( 'blog-sidebar' );
}
 
genesis();