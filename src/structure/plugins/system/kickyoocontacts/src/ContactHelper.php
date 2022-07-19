<?php

namespace Kicktemp\Yootheme\Contacts;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Object\CMSObject;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Registry\Registry;

class ContactHelper
{
    /**
     * Gets the articles.
     *
     * @param int[] $ids
     * @param array $args
     *
     * @return CMSObject[]
     */
    public static function get($ids, array $args = [])
    {
        return $ids ? static::query(['article' => (array) $ids] + $args) : [];
    }

    /**
     * Query articles.
     *
     * @param array $args
     *
     * @return array
     */
    public static function query(array $args = [])
    {
        $model = new ContactsModel(['ignore_request' => true]);
        $model->setState('params', ComponentHelper::getParams('com_contact'));
        $model->setState('filter.access', true);
        $model->setState('filter.published', 1);
        $model->setState('filter.language', Multilanguage::isEnabled());

        if (!empty($args['order'])) {
            if ($args['order'] === 'rand') {
                $args['order'] = Factory::getDbo()
                    ->getQuery(true)
                    ->Rand();
            } elseif ($args['order'] === 'front') {
                $args['order'] = 'fp.ordering';
            } else {
                $args['order'] = "a.{$args['order']}";
            }
        }

        $props = [
            'offset' => 'list.start',
            'limit' => 'list.limit',
            'order' => 'list.ordering',
            'order_direction' => 'list.direction',
            'order_alphanum' => 'list.alphanum',
            'featured' => 'filter.featured',
            'subcategories' => 'filter.subcategories',
            'tags' => 'filter.tags',
            'tag_operator' => 'filter.tag_operator',
        ];

        foreach (array_intersect_key($props, $args) as $key => $prop) {
            $model->setState($prop, $args[$key]);
        }

        if (!empty($args['catid'])) {
            $model->setState('category.id', (array) $args['catid']);
        }


        return $model->getItems();
    }

    public static function applyPageNavigation($article)
    {
        if (!isset($article->pagination)) {
            $p = clone $article->params;
            $p->set('show_item_navigation', true);

            if (!PluginHelper::importPlugin('content', 'pagenavigation')) {
                return null;
            }

            $reflection = new \ReflectionClass(\PlgContentPagenavigation::class);
            $plugin = $reflection->newInstanceWithoutConstructor();
            $plugin->params = new Registry(['display' => 0]);
            $plugin->onContentBeforeDisplay('com_content.article', $article, $p, 0);
        }

        return !empty($article->prev) || !empty($article->next);
    }
}
