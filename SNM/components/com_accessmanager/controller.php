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


jimport('joomla.application.component.controller');


class accessmanagerController extends JControllerLegacy{

	var $am_config;

	function display($cachable = false, $urlparams = false){		
		// Set a default view if none exists
		if (!JRequest::getCmd('view')){
			JRequest::setVar('view', 'noaccess');
		}
		
		parent::display();
				
	}
	
	function __construct(){	
		$this->am_config = $this->get_config();	
		parent::__construct();			
	}
	
	
	function get_config(){				
		$database = JFactory::getDBO();		
		$database->setQuery("SELECT config "
		."FROM #__accessmanager_config "
		."WHERE id='am' "
		."LIMIT 1"
		);		
		$raw = $database->loadResult();			
		$registry = new JRegistry;
		$registry->loadString($raw);
		$config = $registry->toArray();			
		return $config;			
	}

	
	
	

}
?>