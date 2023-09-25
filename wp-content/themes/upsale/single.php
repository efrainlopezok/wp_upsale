<?php
/**
 * Upsale.
 *
 * This file adds the landing page template to the Upsale.
 *
 * Template Name: Single Post
 *
 * @package Upsale
 * @author  Upsale
 * @license GPL-2.0+
 * @link    http://www.upsale.com/
 */


/*
Remove markups Single Posts
-------------------------*/
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );


// remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_before_loop', 'single_loop_custom' );
function single_loop_custom(){
    global $post;

    ?>
    <div class="top-sigle">
        <?php
        if (has_post_thumbnail()) {
            ?>
            <div class="two-sixths first">
                <span>
                    <?php 
                    $user_id=$post->post_author;
                    $categories = get_the_category( get_the_ID());
                    $out = '';
                    foreach ( $categories as $category ) { 
                        $out .= '<a href="'.esc_url( get_category_link($category->term_id)).'" class="post-category">'.$category->name.'</a> | ';
                    }
                    $out = substr($out, 0, -2);
                    if(pll_current_language() == 'en') {
                        echo '<p><a href="'.get_author_posts_url( $user_id ).'"></a>'.$out.'</p>';
                    }
                    else {
                        echo '<p><a href="'.get_author_posts_url( $user_id ).'"></a>'.$out.'</p>';
                    }
                    ?>
                </span>
                <h2><?php echo get_the_title(); ?></h2>
                <div class="info-author">
                    <?php 
                        $user_info = get_userdata($user_id);

                        echo get_avatar( $user_id, 100 );
                        echo "<div>";
                        echo '<strong>'.get_the_author_meta( 'user_nicename', $user_id ).'</strong>';
                        echo '<span>'.get_field('rol_profile', 'user_'.$user_id).'</span>';
                        echo "</div>";
                    ?>    
                </div>
            </div>
            <div class="two-thirds">
                <?php 
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
                    echo '<img src="'.$thumb_url[0].'"/>';
                ?>
            </div>
            <?php
        }else{
            ?>
            <div class="full-post">
                <span>
                    <?php 
                    $user_id=$post->post_author;
                    $categories = get_the_category( get_the_ID());
                    $out = '';
                    foreach ( $categories as $category ) { 
                        $out .= '<a href="'.esc_url( get_category_link($category->term_id)).'" class="post-category">'.$category->name.'</a> | ';
                    }
                    $out = substr($out, 0, -2);
                    if(pll_current_language() == 'en') {
                        echo '<p><a href="'.get_author_posts_url( $user_id ).'"></a>'.$out.'</p>';
                    }
                    else {
                        echo '<p><a href="'.get_author_posts_url( $user_id ).'"></a>'.$out.'</p>';
                    }
                    ?>
                </span>
                <h2><?php echo get_the_title(); ?></h2>
                <div class="info-author">
                    <?php 
                        $user_info = get_userdata($user_id);

                        echo get_avatar( $user_id, 100 );
                        echo "<div>";
                        echo '<strong>'.get_the_author_meta( 'user_nicename', $user_id ).'</strong>';
                        echo '<span>'.implode(', ', $user_info->roles).'</span>';
                        echo "</div>";
                    ?>    
                </div>
            </div>
            <?php
        }
        ?>
        <div class="clearfix"></div>
    </div>
    <?php

    
}

add_action( 'genesis_after_content', 'single_after_custom' );
function single_after_custom(){
    $lang = pll_current_language();
    error_log($lang);
    if($lang=='es'){
        error_log($lang);
        echo "<div class='share-blog'>
        <h4 class='share-post-f'>No olvides compartirlo</h4>";
        
    }else{
        echo "<div class='share-blog'>
        <h4 class='share-post-f'>Don't forget to share this post</h4>";
    }
        echo '<div class="wrap">';
            echo '<a class="share face-c" target="_blank" href="https://www.facebook.com/sharer.php?u='.get_permalink().'"><img src="'.get_site_url().'/wp-content/themes/upsale/images/face.png" alt=""></a>';
            echo '<a class="share twitter-c" target="_blank" href="https://twitter.com/share?url='.get_permalink().'&text='.get_the_title().'"><img src="'.get_site_url().'/wp-content/themes/upsale/images/tw.png" alt=""></a>';
        echo '</div>';
    echo '</div>';

}
    
function themify_custom_excerpt_length( $length ) {
   return 20;
}
add_filter( 'excerpt_length', 'themify_custom_excerpt_length', 999 );

function change_excerpt( $more ) {
    return '';
}
add_filter('excerpt_more', 'change_excerpt');

add_action('genesis_before_footer', 'custom_related', 4);
function custom_related(){
    $args = array( 
        'posts_per_page'   => 3,
        'post_type'      => 'post',
        'orderby'    => 'post_date',
        'order'      => 'DESC'
    );

    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts()):
       
        ?>
        <div class="blog-wrap">
            <div class="wrap">
                <?php
                if(get_bloginfo('language') == 'en-US'){
                    echo '<h3>Related Articles</h3>';
                }else{
                    echo '<h3>Artículos Relacionados</h3>';
                }
                ?>
                <div>
                <?php
                $count = 1;
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    $class_first = ($count == 1) ? 'first' : '' ;
                    ?>
                    <div class="one-third <?php echo $class_first ?>">
                        <div>
                            <h2><?php echo the_title(); ?></h2>
                            <?php echo the_excerpt(); ?>
                            <?php
                            if(get_bloginfo('language') == 'en-US'){
                                ?>
                                <a href="<?php echo the_permalink(); ?>">Read More</a>
                                <?php
                            }else{
                                ?>
                                <a href="<?php echo the_permalink(); ?>">Leer Más</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    $count++;
                endwhile;
                ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php
        wp_reset_query();
        ?>
        <?php
    endif;
}


// Remove Sidebar
add_action('get_header','cd_change_genesis_sidebar');
function cd_change_genesis_sidebar() {
    remove_action( 'genesis_sidebar', 'genesis_do_sidebar' ); //remove the default genesis sidebar
}

// Add Class on Body
add_filter( 'body_class', 'sibgle_post_class' );
function sibgle_post_class( $classes ) {
    $classes[] = 'all_single_post';
    return $classes;
}

// Run the Genesis loop.
genesis();
