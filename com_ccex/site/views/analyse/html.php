<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsAnalyseHtml extends JViewHtml {
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
            $this->beginOfFirstInterval = $organization->financialAccountingBeginOfFirstInterval();
            $this->financialAccountingMasterCategoriesJSON = $organization->financialAccountingCategoriesJSON();
            $this->financialAccountingMasterSeriesJSON = $organization->financialAccountingSeriesJSON();
            $this->financialAccountingSeriesJSON = $organization->financialAccountingSeriesJSON(array(), $this->beginOfFirstInterval["begin_of_first_interval"], true);
            $this->financialAccountingCategoriesJSON = $organization->financialAccountingCategoriesJSON(array(), $this->beginOfFirstInterval["begin_of_first_interval"]);
            $this->collections = $organization->collections();
        break;

      default:
        break;
    }

    return parent::render();
  } 
}
