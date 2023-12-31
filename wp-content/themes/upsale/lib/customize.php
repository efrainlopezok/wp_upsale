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

add_action( 'customize_register', 'upsale_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function upsale_customizer_register( $wp_customize ) {

	$wp_customize->add_setting(
		'upsale_link_color',
		array(
			'default'           => upsale_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'upsale_link_color',
			array(
				'description' => __( 'Change the color of post info links, hover color of linked titles, hover color of menu items, and more.', 'genesis-sample' ),
				'label'       => __( 'Link Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'upsale_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'upsale_accent_color',
		array(
			'default'           => upsale_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'upsale_accent_color',
			array(
				'description' => __( 'Change the default hovers color for button.', 'genesis-sample' ),
				'label'       => __( 'Accent Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'upsale_accent_color',
			)
		)
	);

}
