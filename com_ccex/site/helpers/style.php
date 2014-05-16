<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExHelpersStyle {
	function load() {
		$document = JFactory::getDocument();

		//javascripts
		$document->addScript(JURI::base().'components/com_ccex/assets/js/ccex.js');
	}
}
