<?php
/**
 * @package		MiwoVideos
 * @copyright	Copyright (C) 2009-2014 Miwisoft, LLC. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */
# No Permission
defined('MIWI') or die('Restricted access');

require_once(MPATH_WP_PLG.'/miwovideos/admin/library/miwovideos.php');

$db 		= MFactory::getDBO();
$user 		= MFactory::getUser();
$document 	= MFactory::getDocument();
$app 		= MFactory::getApplication();
$utility    = MiwoVideos::get('utility');
$config 	= MiwoVideos::getConfig();
$tmpl = $app->getTemplate();
if (file_exists(MPATH_WP_CNT.'/themes/'.$tmpl.'/html/com_miwovideos/assets/css/modules.css') and !MiwoVideos::isDashboard()) {
    $document->addStyleSheet(MURL_WP_CNT.'/themes/'.$tmpl.'/html/com_miwovideos/assets/css/modules.css');
} else {
    $document->addStyleSheet(MURL_MIWOVIDEOS.'/site/assets/css/miwovideosmodules.css');
}

$numberVideos = $params->get('number_videos', 5);
$filterby = $params->get('filterby');
if(!$filterby){
    $filterbywhere = 'created';
}else{
    $filterbywhere = 'ordering';
}
	
if ($app->getLanguageFilter()) {
	$extraWhere = ' AND language IN (' . $db->Quote(MFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')';
} else {
	$extraWhere = '' ;
}

$sql = 'SELECT id, title FROM #__miwovideos_playlists WHERE published=1'
	.' AND access IN ('.implode(',', $user->getAuthorisedViewLevels()).')'.$extraWhere.' ORDER BY '.$filterbywhere.''.($numberVideos ? ' LIMIT '.$numberVideos : '');
   
$db->setQuery($sql) ;	
$rows = $db->loadObjectList() ;

require(MModuleHelper::getLayoutPath('mod_miwovideos_playlist', 'default'));