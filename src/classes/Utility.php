<?php

namespace HAMWORKS\Code_Block_Syntax_Highlight;

use Highlight\HighlightResult;

class Utility {

	/**
	 * Syntax Highlight.
	 *
	 * @param string $code
	 * @param null|string $language
	 *
	 * @return HighlightResult|\stdClass
	 */
	static public function syntaxHighlight( string $code, ?string $language = null ) {
		$hl = new \Highlight\Highlighter();
		$hl->enableSafeMode();
		try {
			if ( $language ) {
				$highlighted = $hl->highlight( $language, $code );
			}
			else {
				$highlighted = $hl->highlightAuto( $code, array( 'javascript', 'css', 'php', 'xml' ) );
			}
		} catch ( \Exception $e ) {
			$result = new \stdClass();
			$result->value = $code;
			$result->language = '';
			return $result;
		}

		return $highlighted;
	}

}
