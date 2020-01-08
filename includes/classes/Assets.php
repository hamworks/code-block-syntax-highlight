<?php

namespace HAMWORKS\Code_Block_Syntax_Highlight;


class Assets {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_assets' ) );

	}

	public function wp_enqueue_scripts() {
		wp_enqueue_style( 'highlight-php-theme', plugins_url( 'vendor/scrivo/highlight.php/styles/a11y-light.css', PLUGIN_FILE ) );
	}

	function enqueue_block_editor_assets() {
		$script_asset = require( dirname( PLUGIN_FILE ) . '/build/index.asset.php' );
		wp_enqueue_script(
			'code-block-syntax-highlight-editor',
			plugins_url( 'build/index.js', PLUGIN_FILE ),
			$script_asset['dependencies'],
			$script_asset['version']
		);

	}
}
