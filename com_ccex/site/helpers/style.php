<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExHelpersStyle {
	function load() {
		$document = JFactory::getDocument();

		//javascripts
		$document->addStylesheet(JURI::base().'components/com_ccex/assets/css/form.css');
	}
}
