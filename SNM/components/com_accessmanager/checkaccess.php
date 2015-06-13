<?php
/**
* @package Access-Manager (com_accessmanager)
* @version 2.2.1
* @copyright Copyright (C) 2012 - 2014 Carsten Engel. All rights reserved.
* @license GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html 
* @author http://www.pages-and-items.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

//silly workaround for developers who install the trail version while totally ignoring 
//all warnings about that you need Ioncube installed or else it will criple the site
$am_trial_version = 0;

$ds = DIRECTORY_SEPARATOR;

if(!$am_trial_version || ($am_trial_version && extension_loaded('ionCube Loader'))){
	require_once(JPATH_ROOT.$ds.'components'.$ds.'com_accessmanager'.$ds.'checkaccess2.php');
}

?>