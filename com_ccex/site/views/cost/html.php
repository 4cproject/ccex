<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsCostHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    $costModel = new CCExModelsCost();
    $profileModel = new CCExModelsProfile();

    $organization = $profileModel->organization();

    switch($layout) {

      case "index":
        $this->costs = $organization->collection()->costs();
      case "add":
        $this->currency = $organization->currency();
        $this->collection = $organization->collection();
      break;

      default:
      break;

    }

    //display
    return parent::render();
  } 
}
