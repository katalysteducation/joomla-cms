<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// TS changes - start
use Joomla\Module\Menu\Site\Helper\MenuHelper;
use Joomla\Module\Menu\Site\Module\MenuModule;
// TS changes - end

$list = MenuHelper::getList($params);
$base = MenuHelper::getBase($params);
$active = MenuHelper::getActive($params);
$default = MenuHelper::getDefault();
$active_id = $active->id;
$default_id = $default->id;
$path = $base->tree;
$showAll = $params->get('showAllChildren', 1);
$class_sfx = htmlspecialchars($params->get('class_sfx', ''), ENT_COMPAT, 'UTF-8');

// TS changes - start
$data = [
    'module' => $module,
    'list' => $list,
    'active' => $active,
    'default' => $default,
    'active_id' => $active_id,
    'default_id' => $default_id,
    'path' => $path,
    'showAll' => $showAll,
    'class_sfx' => $class_sfx,
];

$modInstance = new MenuModule($params, $module);
$modInstance->setData($data);

$layout = '@module/mod_menu/' . explode(':', $params->get('layout', 'default'))[1] . '/' . explode(':', $params->get('layout', 'default'))[1] . '.html.twig';

echo $modInstance->render($layout);
// TS changes - end
