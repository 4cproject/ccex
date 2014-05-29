<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsCostHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    switch($layout) {

      case "index":
      break;

      default:
      break;

    }

    //display
    return parent::render();
  } 
}
