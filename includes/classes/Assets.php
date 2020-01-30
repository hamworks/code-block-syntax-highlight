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
		wp_enqueue_code_editor( [ 'type' => 'htmlmixed' ] );
		wp_enqueue_code_editor( [ 'type' => 'css' ] );
		wp_enqueue_code_editor( [ 'type' => 'javascript' ] );
		wp_add_inline_style( 'code-editor', 'div.CodeMirror { font-size: 14px }' );
		wp_add_inline_style( 'code-editor', '
		div.CodeMirror pre {
			padding: 0 4px;
			border-radius: 0;
		    border-width: 0;
		    background: 0 0;
		    font-family: inherit;
		    font-size: inherit;
		    margin: 0;
		    white-space: pre;
		    word-wrap: normal;
		    line-height: inherit;
		    color: inherit;
		    z-index: 2;
		    position: relative;
		    overflow: visible;
		    font-variant-ligatures: contextual;
		}' );
		$script_asset = require( dirname( PLUGIN_FILE ) . '/build/index.asset.php' );
		wp_enqueue_script(
			'code-block-syntax-highlight-editor',
			plugins_url( 'build/index.js', PLUGIN_FILE ),
			array_merge( $script_asset['dependencies'], [ 'code-editor' ] ),
			$script_asset['version']
		);

	}
}
