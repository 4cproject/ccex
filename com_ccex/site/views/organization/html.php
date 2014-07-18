<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExViewsOrganizationHtml extends JViewHtml
{
    function render() {
        $app = JFactory::getApplication();
        $layout = $app->input->get('layout');
        
        $organization_id = $app->input->get('organization_id', null);
        
        $userModel = new CCExModelsUser();
        $organizationModel = new CCExModelsOrganization();
        $orgTypeModel = new CCExModelsOrganizationtype();
        $currencyModel = new CCExModelsCurrency();
        $countryModel = new CCExModelsCountry();
        
        switch ($layout) {
            case "add":
                $this->_formView = CCExHelpersView::load('Organization', '_form', 'phtml');
                
                $this->_formView->organization = $organizationModel;
                $this->_formView->orgTypes = $orgTypeModel->listItems();
                $this->_formView->currencies = $currencyModel->listItems();
                $this->_formView->countries = $countryModel->listItems();
                break;

            case "edit":
                $organization = $organizationModel->getItemBy("_organization_id", $organization_id);
                
                if (!$organization) {
                    $app->enqueueMessage(JText::_('COM_CCEX_ERROR_NOT_FOUND'), "error");
                    $app->redirect(JRoute::_('index.php?view=comparecosts&layout=index', false));
                }
                
                $this->organization = $organization;
                
                $this->_formView = CCExHelpersView::load('Organization', '_form', 'phtml');
                $this->_formView->organization = $organization;
                $this->_formView->orgTypes = $orgTypeModel->listItems();
                $this->_formView->currencies = $currencyModel->listItems();
                $this->_formView->countries = $countryModel->listItems();
                break;

            default:
                break;
        }
        
        return parent::render();
    }
}
