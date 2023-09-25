<?php

remove_action( 'genesis_loop', 'genesis_do_loop');

add_action('genesis_after_loop', 'upsale_404_error');

function upsale_404_error() {
	$text = array();
	if ( pll_current_language() == 'es' ) {
		
		$text['title'] = 'La página no existe';
		$text['content'] = 'La página a la que intentas acceder no existe. Puedes retornar a la pagina de inicio del sitio y ver lo que estas buscando.';
	}
	else {
		$text['title'] = 'Page does not exists';
		$text['content'] = 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.';
	}
	?>
	<div class="wrap">
		<h1 class="archive-title"><?php echo $text['title']; ?></h1>
		<div class=""><?php echo $text['content']; ?></div>
		<br>
	</div>
	<?php
}

genesis();