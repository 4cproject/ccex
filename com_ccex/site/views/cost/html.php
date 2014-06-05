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
        $this->collection = $organization->collection();
        $this->costs = $organization->collection()->costs();
        break;
      case "add":
        $this->_formView = CCExHelpersView::load('Cost','_form','phtml');
        $this->_formView->currency = $organization->currency();
        $this->_formView->collection = $organization->collection();
        break;
      case "edit":
        $this->_formView = CCExHelpersView::load('Cost','_form','phtml');
        $this->_formView->cost = $costModel->getItem();
        $this->_formView->currency = $organization->currency();
        $this->_formView->collection = $organization->collection();
        break;

      default:
        break;

    }

    //display
    return parent::render();
  } 
}
