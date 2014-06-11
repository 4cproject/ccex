<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsIntervalHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    $intervalModel = new CCExModelsInterval();

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
