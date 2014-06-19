<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsComparecostsHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    $userModel = new CCExModelsUser();
    $organization = $userModel->organization();

    if (!$organization) {
        $app->enqueueMessage(JText::_('COM_CCEX_ORGANIZATION_REQUIRED_MSG'), "notice");
        $app->redirect(JRoute::_('index.php?view=organization&layout=add', false));
    }

    switch($layout) {
      case "index":
        $this->_summaryOrganization = CCExHelpersView::load('Organization', '_summary', 'phtml');
        $this->_summaryOrganization->organization = $organization;

        $this->_showOrganization = CCExHelpersView::load('Organization','_show','phtml');
        $this->_showOrganization->organization = $organization;

        $this->_indexCollection = CCExHelpersView::load('Collection','_index','phtml');
        $this->_indexCollection->collections = $organization->collections();
        $this->_indexCollection->_showCollection = CCExHelpersView::load('Collection','_show','phtml');
        $this->_indexCollection->_showCollection->_indexInterval = CCExHelpersView::load('Interval','_index','phtml');
        $this->_indexCollection->_showCollection->_indexInterval->_showInterval = CCExHelpersView::load('Interval','_show','phtml');
        $this->_indexCollection->_showCollection->_indexInterval->_showInterval->_indexCost = CCExHelpersView::load('Cost','_index','phtml');
        break;

      default:
        break;
    }

    return parent::render();
  } 
}
