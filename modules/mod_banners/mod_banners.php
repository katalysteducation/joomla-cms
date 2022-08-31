<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_banners
 *
 * @copyright   (C) 2005 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Component\Banners\Administrator\Helper\BannersHelper as BannersComponentHelper;
use Joomla\Module\Banners\Site\Helper\BannersHelper;
// TS change
use Joomla\Module\Banners\Site\Module\BannersModule;

$headerText = trim($params->get('header_text', ''));
$footerText = trim($params->get('footer_text', ''));

BannersComponentHelper::updateReset();

$model = $app->bootComponent('com_banners')->getMVCFactory()->createModel('Banners', 'Site', ['ignore_request' => true]);
$list = BannersHelper::getList($params, $model, $app);

// TS change - Start
$moduleclassSFX = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');

$data = [
    'list' => $list,
    'headerText' => $headerText,
    'footerText' => $footerText,
    'class_sfx' => $moduleclassSFX,
];

$modInstance = new BannersModule($params, $module);
$modInstance->setData($data);

$layout = '@module/mod_banners/' . explode(':', $params->get('layout', 'default'))[1] . '/' . explode(':', $params->get('layout', 'default'))[1] . '.html.twig';

echo $modInstance->render($layout);
// TS change - End
