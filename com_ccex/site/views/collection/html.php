<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsCollectionHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    $collectionModel = new CCExModelsCollection();
    $userModel = new CCExModelsUser();

    $organization = $userModel->organization();

    if (!$organization) {
        $app->enqueueMessage(JText::_('COM_CCEX_ORGANIZATION_REQUIRED_MSG'), "notice");
        $app->redirect(JRoute::_('index.php?view=organization&layout=add', false));
    }

    switch($layout) {
      case "add":
          $this->_formView = CCExHelpersView::load('Collection','_form','phtml');

          $this->_formView->collection = $collectionModel;
          $this->_formView->organization = $organization;
        break;
      case "edit":
          $this->_formView = CCExHelpersView::load('Collection','_form','phtml');

          $this->_formView->collection = $collectionModel->getItem();
          $this->_formView->organization = $organization;
        break;

      default:
        break;
    }

    return parent::render();
  } 
}
