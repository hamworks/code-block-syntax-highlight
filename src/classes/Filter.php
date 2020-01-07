<?php

namespace HAMWORKS\Code_Block_Syntax_Highlight;

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
	function render_block( $block_content, $block ) {
		if ( 'core/code' === $block ) {
			$result = Utility::syntaxHighlight( $block_content );
			return $result->value;
		}

		return $block_content;
	}

}


