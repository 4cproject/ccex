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
            $this->financialAccountingSeriesJSON = $organization->financialAccountingSeriesJSON();
            $this->financialAccountingCategoriesJSON = $organization->financialAccountingCategoriesJSON();
            $this->collections = $organization->collections();
        break;

      default:
        break;
    }

    return parent::render();
  } 
}
