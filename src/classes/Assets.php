<?php

namespace HAMWORKS\Code_Block_Syntax_Highlight;


class Assets {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts') );
	}

	public function wp_enqueue_scripts() {
		wp_enqueue_style( 'highlight-php-theme', plugins_url( 'vendor/scrivo/highlight.php/styles/a11y-light.css', PLUGIN_FILE ) );
	}
}
