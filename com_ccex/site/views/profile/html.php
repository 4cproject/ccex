<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsProfileHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    $profileModel = new CCExModelsProfile();
    $orgTypeModel = new CCExModelsOrganizationtype();
    $currencyModel = new CCExModelsCurrency();
    $countryModel = new CCExModelsCountry();

    switch($layout) {

      case "edit":
        $this->organization = $profileModel->organizationOrEmpty();
        $this->collection = $this->organization->CollectionOrEmpty();

        $this->orgTypes = $orgTypeModel->listItems();
        $this->currencies = $currencyModel->listItems();
        $this->countries = $countryModel->listItems();
      break;

      default:
      break;

    }

    //display
    return parent::render();
  } 
}
