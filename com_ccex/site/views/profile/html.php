<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsProfileHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    //retrieve task list from model
    $profileModel = new CCExModelsProfile();
    $orgTypeModel = new CCExModelsOrganizationtype();
    $currencyModel = new CCExModelsCurrency();
    $countryModel = new CCExModelsCountry();

    switch($layout) {

      case "edit":
        $this->profile = $profileModel->getItem();
        $this->organization = $this->profile->organization;
        $this->org_profile = CCExHelpersCast::cast('CCExModelsOrganizationprofile', $this->organization->profile);
        $this->scope = $this->org_profile->scope;

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
