<?php
/**
 * @version          $Id: router.php 55 2014-01-22 03:50:36Z thongta $
 * @package          obRSS Feed Creator for Joomla.
 * @copyright    (C) 2007-2012 foobla.com. All rights reserved.
 * @author           foobla.com
 * @license          GNU/GPL, see LICENSE
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once JPATH_SITE . DS . 'components' . DS . 'com_obrss' . DS . 'helpers' . DS . 'router.php';
// JoomSEF
if ( file_exists( JPATH_BASE . DS . 'components/com_sef/classes/config.php' ) ) {
// 	include_once(JPATH_BASE.DS.'components/com_sef/classes/config.php');
// 	$sefConfig = SEFConfig::getConfig();
// 	$Enabled1  = $sefConfig->enabled;
}
// sh404SEF
if ( file_exists( JPATH_BASE . DS . 'components/com_sh404sef/config/config.sef.php' ) ) {
// 	include_once(JPATH_BASE.DS.'components/com_sh404sef/config/config.sef.php');
}
$Enabled  = isset( $Enabled ) ? $Enabled : 0;
$Enabled1 = isset( $Enabled1 ) ? $Enabled1 : 0;
// if ($Enabled1 == 0 && $Enabled ==0) {
if ( 1 == 1 ) {
	function obRSSBuildRoute( &$query ) {
		$segments = array();
		if ( isset( $query['task'] ) && isset( $query['id'] ) && $query['task'] == 'feed' ) {
			#id:alias
			$alias = explode( ":", $query['id'] );
			$jv    = new JVersion();
			if ( ! isset( $alias[1] ) && ( $jv->RELEASE == '3.0' || $jv->RELEASE == '3.1' || $jv->RELEASE == '3.2' || $jv->RELEASE == '3.3' || $jv->RELEASE == '3.4' || $jv->RELEASE == '3.5' ) ) {
				return $segments;
			}
			$segments[] = $alias[1];

			unset( $query['task'] );

			// Unset format only when SEF Suffix turning OFF, we will get rid of ?format=feed unwanted string
			$config = new JConfig();
			if ( ! $config->sef_suffix ) {
				unset( $query['format'] );
			}

			unset( $query['id'] );
		}

		return $segments;
	}

	function obRSSParseRoute( $segments ) {
		$vars  = array();
		$count = count( $segments );
		if ( $count ) {
			$vars['task'] = 'feed'; // load a feed
			$alias        = str_replace( ':', '-', $segments[ $count - 1 ] );
			#var_dump($alias);exit();
			# get id from alias
			$db  = JFactory::getDBO();
			$qry = '
				SELECT `id`, `feed_type`
				FROM `#__obrss`
				WHERE
					`alias` = "' . $alias . '"
			';
			$db->setQuery( $qry );
			$feed       = $db->loadObject();
			$vars['id'] = $feed->id;
			include_once( JPATH_SITE . DS . 'components' . DS . 'com_obrss' . DS . 'helpers' . DS . 'itemshelper.php' );
			$vars['format'] = itemsHelper::getFeedTypePrefix( $feed->feed_type );
		}

		return $vars;
	}
}