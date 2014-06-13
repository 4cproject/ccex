<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsCostHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    $intervalModel = new CCExModelsInterval();
    $costModel = new CCExModelsCost();
    $userModel = new CCExModelsUser();
    $organization = $userModel->organization();

    if (!$organization) {
        $app->enqueueMessage(JText::_('COM_CCEX_ORGANIZATION_REQUIRED_MSG'), "notice");
        $app->redirect(JRoute::_('index.php?view=organization&layout=add', false));
    }

    switch($layout) {
      case "add":
        $this->_formView = CCExHelpersView::load('Cost','_form','phtml');
        $this->_formView->currency = $organization->currency();
        $this->_formView->interval = $intervalModel->getItem();
        break;
      case "edit":
        $cost = $costModel->getItem();

        $this->_formView = CCExHelpersView::load('Cost','_form','phtml');
        $this->_formView->cost = $cost;
        $this->_formView->currency = $organization->currency();
        $this->_formView->interval = $cost->interval();
        break;

      default:
        break;

    }

    return parent::render();
  } 
}
