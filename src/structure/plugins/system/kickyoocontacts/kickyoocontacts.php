<?php
/**
 * @package    [PACKAGE_NAME]
 *
 * @author     [AUTHOR] <[AUTHOR_EMAIL]>
 * @copyright  [COPYRIGHT]
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       [AUTHOR_URL]
 */

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;
use YOOtheme\Application;
use YOOtheme\Path;

defined('_JEXEC') or die;

/**
 * KickYooContacts plugin.
 *
 * @package   [PACKAGE_NAME]
 * @since     1.0.0
 */
class plgSystemKickYooContacts extends CMSPlugin
{
	/**
	 * Application object
	 *
	 * @var    CMSApplication
	 * @since  1.0.0
	 */
	protected $app;

	/**
	 * Database object
	 *
	 * @var    DatabaseDriver
	 * @since  1.0.0
	 */
	protected $db;

	/**
	 * Affects constructor behavior. If true, language files will be loaded automatically.
	 *
	 * @var    boolean
	 * @since  1.0.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * onAfterInitialise.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function onAfterInitialise ()
	{
		// Check if YOOtheme Pro is loaded
		if (!class_exists(Application::class, false)) {
			return;
		}

		$root = __DIR__;
		$rootUrl = Uri::root(true);

		// set alias
		Path::setAlias('~kickyoocontacts', $root);
		Path::setAlias('~kickyoocontacts_url', $rootUrl . '/plugins/system/kickyoocontacts');

		// register plugin
		JLoader::registerNamespace('Kicktemp\\Yootheme\\Contacts\\', __DIR__ . '/src', false, false, 'psr4');


		// Load a single module from the same directory
		$app = Application::getInstance();
		$app->load(__DIR__ . '/bootstrap.php');
	}
}
