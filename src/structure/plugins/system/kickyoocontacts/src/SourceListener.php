<?php

namespace Kicktemp\Yootheme\Contacts;

use Joomla\CMS\HTML\HTMLHelper;
use YOOtheme\Builder\Source;
use YOOtheme\Config;

class SourceListener
{
	/**
	 * @param Source $source
	 */
	public static function initSource($source)
	{
		$query = [
			Type\CustomContactsQueryType::config(),
		];

		foreach ($query as $args) {
			$source->queryType($args);
		}
	}

	public static function initCustomizer(Config $config)
	{
		$config->add('customizer.kick.categories.contact', array_map(function ($category) {
			return ['value' => (string) $category->value, 'text' => $category->text];
		}, HTMLHelper::_('category.options', 'com_contact')));
	}
}
