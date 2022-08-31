<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_finder
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Finder\Administrator\Helper\LanguageHelper;
use Joomla\Component\Finder\Site\Helper\RouteHelper;
use Joomla\Module\Finder\Site\Helper\FinderHelper;
// TS change - start
// use Joomla\Component\Videos\Site\Helper\Videos;
use Joomla\Module\Finder\Site\Module\FinderModule;
// TS change - end

$cparams = ComponentHelper::getParams('com_finder');

// Check for OpenSearch
if ($params->get('opensearch', $cparams->get('opensearch', 1))) {
    $defaultTitle = Text::_('MOD_FINDER_OPENSEARCH_NAME') . ' ' . $app->get('sitename');
    $ostitle = $params->get('opensearch_name', $cparams->get('opensearch_name', $defaultTitle));
    $app->getDocument()->addHeadLink(
        Uri::getInstance()->toString(array('scheme', 'host', 'port')) . Route::_('index.php?option=com_finder&view=search&format=opensearch'),
        'search',
        'rel',
        array('title' => $ostitle, 'type' => 'application/opensearchdescription+xml')
    );
}

// Get the route.
$route = RouteHelper::getSearchRoute($params->get('searchfilter', null));

// TS change - start
if ((int) $params->get('set_itemid') > 0) {
    $route = 'index.php?Itemid=' . $params->get('set_itemid');
}
// TS change - end

// Load component language file.
LanguageHelper::loadComponentLanguage();

// Load plugin language files.
LanguageHelper::loadPluginLanguage();

// Get Smart Search query object.
$query = FinderHelper::getQuery($params);

// TS change - start
// $videos = VideosFrontendHelper::getModel('Frontend');
// $subjects = $videos->getSubjects();
// $levels = $videos->getLevels();
// $types = $videos->getTypes();

// To remove - start
$subjects = [
    (object) [
        'id' => '1',
        'subject_title' => 'Matematyka',
        'state' => '1',
        'ordering' => '1',
    ],
    (object) [
        'id' => '2',
        'subject_title' => 'Fizyka',
        'state' => '1',
        'ordering' => '2',
    ],
    (object) [
        'id' => '3',
        'subject_title' => 'Chemia',
        'state' => '1',
        'ordering' => '3',
    ],
    (object) [
        'id' => '4',
        'subject_title' => 'Biologia',
        'state' => '1',
        'ordering' => '4',
    ],
];

$levels = [
    (object) [
        'id' => '2',
        'level_title' => 'Szkoła Podstawowa IV-VI',
        'state' => '1',
        'ordering' => '2',
    ],
    (object) [
        'id' => '5',
        'level_title' => 'Szkoła Podstawowa VII-VIII',
        'state' => '1',
        'ordering' => '5',
    ],
    (object) [
        'id' => '6',
        'level_title' => 'Szkoła Ponadpodstawowa',
        'state' => '1',
        'ordering' => '6',
    ],
];

$types = [
    (object) [
        'id' => '1',
        'type_title' => 'Film',
        'state' => '1',
    ],
    (object) [
        'id' => '2',
        'type_title' => 'Playlista',
        'state' => '1',
    ],
    (object) [
        'id' => '3',
        'type_title' => 'Zadanie',
        'state' => '1',
    ],
    (object) [
        'id' => '4',
        'type_title' => 'Riddle',
        'state' => '1',
    ],
];
// To remove - end

$data = [
    'route' => $route,
    'query' => $query,
    'search' => htmlspecialchars(JFactory::getApplication()->input->get('q', '', 'string')),
    'subjects' => $subjects,
    'levels' => $levels,
    'types' => $types,
];

$modInstance = new FinderModule($params, $module);
$modInstance->setData($data);

$layout = '@module/mod_finder/' . explode(':', $params->get('layout', 'default'))[1] . '/' . explode(':', $params->get('layout', 'default'))[1] . '.html.twig';

echo $modInstance->render($layout);
// TS change - end
