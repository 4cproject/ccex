<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsAnalyseHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    $userModel = new CCExModelsUser();
    $financialAccounting = new CCExModelsFinancialaccounting();
    $organization = $userModel->organization();
    $financialAccounting->set("_organization", $organization);

    if (!$organization) {
        $app->enqueueMessage(JText::_('COM_CCEX_ORGANIZATION_REQUIRED_MSG'), "notice");
        $app->redirect(JRoute::_('index.php?view=organization&layout=add', false));
    }

    switch($layout) {
      case "index":
            $this->_financialAccounting = CCExHelpersView::load('Analyse','_financialaccounting','phtml');
            $this->_financialAccounting->beginOfFirstInterval = $financialAccounting->financialAccountingBeginOfFirstInterval();
            $this->_financialAccounting->financialAccountingMasterCategoriesJSON = $financialAccounting->financialAccountingCategoriesJSON();
            $this->_financialAccounting->financialAccountingMasterSeriesJSON = $financialAccounting->financialAccountingSeriesJSON();
            $this->_financialAccounting->financialAccountingSeriesJSON = $financialAccounting->financialAccountingSeriesJSON(array(), $this->_financialAccounting->beginOfFirstInterval["begin_of_first_interval"], true);
            $this->_financialAccounting->financialAccountingCategoriesJSON = $financialAccounting->financialAccountingCategoriesJSON(array(), $this->_financialAccounting->beginOfFirstInterval["begin_of_first_interval"]);
            $this->collections = $organization->collections();
        break;

      default:
        break;
    }

    return parent::render();
  } 
}
