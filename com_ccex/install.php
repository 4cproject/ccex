<?php // No direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

jimport('joomla.installer.installer');
jimport('joomla.installer.helper');

/**
* Method to install the component
* 
* @param  mixed    $parent     The class calling this method
* @return void
*/
function install($parent) {
  echo JText::_('COM_CCEX_INSTALL_SUCCESSFULL');
}

/**
* Method to update the component
* 
* @param  mixed  $parent   The class calling this method
* @return void
*/
function update($parent) {   
  echo JText::_('COM_CCEX_UPDATE_SUCCESSFULL');
}

/**
* method to run before an install/update/uninstall method
*
* @param  mixed  $parent   The class calling this method
* @return void
*/
function preflight($type, $parent) {
}
 
function postflight($type, $parent){
}
