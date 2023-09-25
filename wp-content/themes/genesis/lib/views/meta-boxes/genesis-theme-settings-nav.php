<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

?>
<table class="form-table">
<tbody>

	<?php if ( ! genesis_html5() ) : ?>
	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Superfish', 'genesis' ); ?></th>
		<td>
			<p><input type = "checkbox" name="<?php $this->field_name( 'superfish' ); ?>" id="<?php $this->field_id( 'superfish' ); ?>" value="1"<?php checked( $this->get_field_value( 'superfish' ) ); ?> />
			<label for="<?php $this->field_id( 'superfish' ); ?>"><?php esc_html_e( 'Load Superfish Script?', 'genesis' ); ?></label></p>
		</td>
	</tr>
	<?php endif; ?>

	<?php if ( genesis_nav_menu_supported( 'primary' ) ) : ?>
	<tr valign="top">
		<th scope="row"><label for="<?php $this->field_id( 'nav_extras' ); ?>"><?php esc_html_e( 'Primary Navigation Extras', 'genesis' ); ?></label></th>
		<td>
			<?php if ( ! has_nav_menu( 'primary' ) ) : ?>
				<p><span class="description">
					<?php
					/* translators: Opening and closing link tags to custom menu editor. */
					printf( esc_html__( 'In order to view the Primary navigation menu settings, you must build a %1$scustom menu%2$s, then assign it to the Primary Menu Location.', 'genesis' ), '<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">', '</a>' );
					?>
				</span></p>
			<?php else : ?>
				<div id="genesis_nav_extras_settings">
					<p>
						<select name="<?php $this->field_name( 'nav_extras' ); ?>" id="<?php $this->field_id( 'nav_extras' ); ?>">
							<option value=""><?php esc_html_e( 'None', 'genesis' ); ?></option>
							<option value="date"<?php selected( $this->get_field_value( 'nav_extras' ), 'date' ); ?>><?php esc_html_e( 'Today\'s date', 'genesis' ); ?></option>
							<option value="rss"<?php selected( $this->get_field_value( 'nav_extras' ), 'rss' ); ?>><?php esc_html_e( 'RSS feed links', 'genesis' ); ?></option>
							<option value="search"<?php selected( $this->get_field_value( 'nav_extras' ), 'search' ); ?>><?php esc_html_e( 'Search form', 'genesis' ); ?></option>
							<option value="twitter"<?php selected( $this->get_field_value( 'nav_extras' ), 'twitter' ); ?>><?php esc_html_e( 'Twitter link', 'genesis' ); ?></option>
						</select>
					</p>
					<div id="genesis_nav_extras_twitter">
						<p>
							<label for="<?php $this->field_id( 'nav_extras_twitter_id' ); ?>"><?php esc_html_e( 'Enter Twitter ID:', 'genesis' ); ?></label>
							<input type="text" name="<?php $this->field_name( 'nav_extras_twitter_id' ); ?>" id="<?php $this->field_id( 'nav_extras_twitter_id' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'nav_extras_twitter_id' ) ); ?>" size="27" />
						</p>
						<p>
							<label for="<?php $this->field_id( 'nav_extras_twitter_text' ); ?>"><?php esc_html_e( 'Twitter Link Text:', 'genesis' ); ?></label>
							<input type="text" name="<?php $this->field_name( 'nav_extras_twitter_text' ); ?>" id="<?php $this->field_id( 'nav_extras_twitter_text' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'nav_extras_twitter_text' ) ); ?>" size="27" />
						</p>
					</div>
				</div>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

</tbody>
</table>