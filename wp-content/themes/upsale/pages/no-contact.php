<?php
/**
 * Upsale.
 *
 * This file adds the landing page template to the Upsale.
 *
 * Template Name: Remove Pre Footer
 *
 * @package Upsale
 * @author  Upsale
 * @license GPL-2.0+
 * @link    http://www.upsale.com/
 */

remove_action('genesis_before_footer', 'add_bottom_function_custom', 5);

// Run the Genesis loop.
genesis();
