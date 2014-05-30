<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsCostHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    $costModel = new CCExModelsCost();

    switch($layout) {

      case "index":
        $this->costs = $costModel->listItems();
      break;

      default:
      break;

    }

    //display
    return parent::render();
  } 
}
