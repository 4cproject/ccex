<?php // No direct access
ini_set( 'display_errors', true );
error_reporting( E_ALL ); 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
//sessions
jimport( 'joomla.session.session' );
 
//load tables
JTable::addIncludePath(JPATH_COMPONENT.'/tables');
 
//load classes
JLoader::registerPrefix('CCEx', JPATH_COMPONENT);
 
//Load plugins
//JPluginHelper::importPlugin('ccex');
 
//application
$app = JFactory::getApplication();
 
// Require specific controller if requested
if($controller = $app->input->get('controller','default')) {
  require_once (JPATH_COMPONENT.'/controllers/'.$controller.'.php');
}
 
// Create the controller
$classname  = 'CCExControllers'.$controller;
$controller = new $classname();
 
// Perform the Request task
$controller->execute();
