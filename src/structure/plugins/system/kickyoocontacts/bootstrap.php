<?php
/**
 * @package    [PACKAGE_NAME]
 *
 * @author     [AUTHOR] <[AUTHOR_EMAIL]>
 * @copyright  [COPYRIGHT]
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       [AUTHOR_URL]
 */

namespace Kicktemp\Yootheme\Contacts;

use YOOtheme\Builder;
use YOOtheme\Path;

return [

	'events' => [
		'source.init' => [
			SourceListener::class => 'initSource',
		],

		'customizer.init' => [
			SourceListener::class => ['initCustomizer', -5]
		],
	],

];
