<?php

namespace HAMWORKS\Code_Block_Syntax_Highlight;

use DOMDocument;

class Filter {

	/**
	 * Highlighter constructor.
	 */
	public function __construct() {
		add_filter( 'render_block', array( $this, 'render_block' ), 10, 2 );
	}

	/**
	 * Filters the content of a single block.
	 *
	 * @param string $block_content The block content about to be appended.
	 * @param array $block The full block, including name and attributes.
	 *
	 * @return string
	 */
	public function render_block( string $block_content, array $block ) {
		if ( 'core/code' === $block['blockName'] ) {
			return $this->render( $block_content );
		}

		return $block_content;
	}

	private function render( $block_content ) {
		$result = Utility::syntaxHighlight( $this->get_content( $block_content ) );
		return '<pre class="wp-block-code"><code>' . $result->value . '</code></pre>';
	}

	private function get_content( string $block_content ) {
		$dom                     = new DOMDocument();
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput       = true;
		$dom->recover            = true;
		$dom->loadXML( $block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

		return $dom->textContent;
	}

}


