<?php
/**
 * @package    [PACKAGE_NAME]
 *
 * @author     [AUTHOR] <[AUTHOR_EMAIL]>
 * @copyright  [COPYRIGHT]
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       [AUTHOR_URL]
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/**
 * [PACKAGE_NAME] script file.
 *
 * @package  [PACKAGE_NAME]
 * @since     1.0.0
 */
class plgSystemKickYooContactsInstallerScript
{

	public function install()
	{
		Factory::getDbo()->setQuery("UPDATE #__extensions SET enabled = 1 WHERE type = 'plugin' AND folder = 'system' AND element = 'kickyoocontacts'")->execute();
	}
}
