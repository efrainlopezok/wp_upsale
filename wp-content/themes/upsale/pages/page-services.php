<?php
/**
 * Upsale
 *
 * Upsale Theme.
 *
 * Template Name: Page / Services
 *
 * @package Upsale
 * @author  Upsale
 * @license GPL-2.0+
 * @link    http://www.upsale.com/
 */


// Page 

//remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop

add_action( 'genesis_after_loop', 'custom_do_loop' ); // Add custom loop
function custom_do_loop() {
    global $wp_query;
    ?>

    <?php
    $args = array( 
        'posts_per_page'   => 6,
        'post_type'      => 'services',
        'orderby'    => 'post_date',
        'order'      => 'ASC'
    );

    $count = 1;
    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts()):
            while ( $wp_query->have_posts() ) : $wp_query->the_post();
                ?>
                <?php if ($count == 1): ?>
                    <div class="cont-services">
                <?php endif ?>
                    <div class="box-service <?php echo ($count == 2 ) ? 'center' : '' ?>">
                        <?php $image = get_field('icon_services')['url'] ? get_field('icon_services')['url'] : ''; ?>
                        <div class="img">
                            <img src="<?php echo $image; ?>" alt="">
                        </div>
                        <h2><?php echo the_title() ?></h2>
                        <?php echo the_excerpt(); ?>
                        <a href="<?php echo the_permalink() ?>" class="upsale-button">Learn More</a>
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
}
    
 
genesis();