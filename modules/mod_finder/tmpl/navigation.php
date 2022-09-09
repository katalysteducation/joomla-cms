<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_finder
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_SITE . '/components/com_finder/helpers/html');
require_once JPATH_SITE . '/components/com_videos/helpers/videos.php';

$app			= JFactory::getApplication();
$templateName	= $app->getTemplate();
$menu			= $app->getMenu();
// Load the smart search component language file.
$lang			= JFactory::getLanguage();
$lang->load('com_finder', JPATH_SITE);

if (JFactory::getApplication()->input->get('option') == 'com_videos') {
	$search_mode = 'slim';
}
elseif ($menu->getActive() == $menu->getDefault($lang->getTag())) {
	$search_mode = 'big';
}
else {
	$search_mode = 'regular';
}

$videos		= VideosFrontendHelper::getModel('Frontend');
$subjects	= $videos->getSubjects();
$levels		= $videos->getLevels();
$types		= $videos->getTypes();

if ((int) $params->get('set_itemid') > 0) {
	$route = 'index.php?Itemid='.$params->get('set_itemid');
}

$logo_url = $app->get('logo');
$desktop_bg = $app->get('dektop');

?>
<section data-ee="SearchBox" data-mode="<?php echo $search_mode;?>" data-click="hide()">
	<a href="#" class="searchbox-button active" id="searchbox-button" data-click="open()"><i class="material-icons searchbox-button__icon">search</i></a>
	<!-- SEARCHBOX -->
	<div class="searchbox" id="SearchBox" action="<?php echo JRoute::_($route); ?>">
		<div class="searchbox__box">
			<div class="searchbox__box__input">
	  		<input id="SearchInput" type="text" name="search" value="<?php htmlspecialchars(JFactory::getApplication()->input->get('q', '', 'string'));?>" placeholder="Wpisz tytuł wideo, kod podstawy lub szukaną frazę...">
				<a href="#" class="searchbox__box__input__close" data-click="close()"><i class="material-icons searchbox__box__input__close__icon">close</i></a>
			</div>
		</div>
	</div>
</section>
<!-- ./SEARCHBOX -->
