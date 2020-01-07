<?php

namespace HAMWORKS\Code_Block_Syntax_Highlight;

require dirname(__FILE__) .'/classes/Filter.php';
require dirname(__FILE__) .'/classes/Utility.php';

add_action( 'plugins_loaded', function () {
	new Filter();
});
