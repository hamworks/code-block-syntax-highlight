<?php
/**
 * Plugin Name:     code-block-syntax-highlight
 * Plugin URI:      https://github.com/team-hamworks/code-block-syntax-highlight
 * Description:     code-block-syntax-highlight.
 * Author:          hamworks
 * Author URI:      https://ham.works
 * Text Domain:     code-block-syntax-highlight
 * Domain Path:     /languages
 * Version: 0.1.0
 * @package         Code_Block_Syntax_Highlight
 */

namespace HAMWORKS\Code_Block_Syntax_Highlight;

require dirname( __FILE__ ) . '/vendor/autoload.php';

const PLUGIN_FILE = __FILE__;

/**
 * Get plugin information.
 *
 * @return array {
 *     Array of plugin information for the strings.
 *
 * @type string $Name Plugin mame.
 * @type string $PluginURI Plugin URL.
 * @type string $Version Version.
 * @type string $Description Description.
 * @type string $Author Author name.
 * @type string $AuthorURI Author URL.
 * @type string $TextDomain textdomain.
 * @type string $DomainPath mo file dir.
 * @type string $Network Multisite.
 * }
 */

function get_plugin_data() {
	static $data = null;
	if ( empty( $data ) ) {
		$data = \get_file_data(
			__FILE__,
			[
				'Name'        => 'Plugin Name',
				'PluginURI'   => 'Plugin URI',
				'Version'     => 'Version',
				'Description' => 'Description',
				'Author'      => 'Author',
				'AuthorURI'   => 'Author URI',
				'TextDomain'  => 'Text Domain',
				'DomainPath'  => 'Domain Path',
				'Network'     => 'Network',
			]
		);
	}

	return $data;
}


/**
 * Block Initializer.
 */
require_once dirname( __FILE__ ) . '/includes/init.php';
