<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsOrganizationHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    $userModel = new CCExModelsUser();
    $organizationModel = new CCExModelsOrganization();
    $orgTypeModel = new CCExModelsOrganizationtype();
    $currencyModel = new CCExModelsCurrency();
    $countryModel = new CCExModelsCountry();

    switch($layout) {
      case "add":
          $this->_formView = CCExHelpersView::load('Organization','_form','phtml');

          $this->_formView->organization = $organizationModel;

          $this->_formView->orgTypes = $orgTypeModel->listItems();
          $this->_formView->currencies = $currencyModel->listItems();
          $this->_formView->countries = $countryModel->listItems();
        break;
      case "edit":
          $organization = $organizationModel->getItem();


          $this->organization = $organization;
          $this->_formView = CCExHelpersView::load('Organization','_form','phtml');
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
