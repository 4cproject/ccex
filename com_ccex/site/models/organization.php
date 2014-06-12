<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsOrganization extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_organization_id = null;
  var $_user_id         = null;
  var $_name            = null;
  var $_pagination      = null;
  var $_total           = null;

  function __construct() {
    $app = JFactory::getApplication();
    $this->_organization_id = $app->input->get('organization_id', null);
    
    parent::__construct();  
  }

  public function getItem() {
    $organization = parent::getItem();

    if($organization){
      return CCExHelpersCast::cast('CCExModelsOrganization', $organization);
    }
  }
  
  /**
  * Builds the query to be used by the Organization model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('o.organization_id, o.name, o.other_org_type, o.description, o.country_id, o.currency_id, o.linked_data_provider, o.linked_cost_data, o.share_information, o.share_data');
    $query->from('#__ccex_organizations as o');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {

    if(is_numeric($this->_organization_id)) {
      $query->where('o.organization_id = ' . (int) $this->_organization_id);
    }

    if(is_numeric($this->_user_id)) {
      $query->where('o.user_id = ' . (int) $this->_user_id);
    }

    return $query;
  }

  public function store($data=null) {    
    $data = $data ? $data : JRequest::get('post');
    $date = date("Y-m-d H:i:s");
    $userModel = new CCExModelsUser();

    $data['organization']['user_id'] = $userModel->_user_id;

    $row_organization = JTable::getInstance('organization','Table');
    if (!$row_organization->bind($data['organization'])){ return false; }

    $row_organization->modified = $date;
    if (!$row_organization->check()){ return false; }
    if (!$row_organization->store()){ return false; }

    $organizationModel = new CCExModelsOrganization();
    $organization = $organizationModel->getItemBy('organization_id', $row_organization->organization_id);

    $organization->removeAllTypes();
    if(array_key_exists('org_type', $data)){
      $organization->addTypes($data['org_type']);
    }

    return true;
  }

  public function currency() {
    $currencyModel = new CCExModelsCurrency();
    $currency = $currencyModel->getItemBy('_currency_id', $this->currency_id);
    
    return $currency;
  }

  public function collections(){
    $collectionModel = new CCExModelsCollection();
    $collections = $collectionModel->listItemsBy('_organization_id', $this->organization_id);
    
    return $collections;
  }

  public function country() {
    $countryModel = new CCExModelsCountry();
    $country = $countryModel->getItemBy('_country_id', $this->country_id);
    
    return $country;
  }

  public function organizationOrgTypes() {
    $organizationOrgTypeModel = new CCExModelsOrganizationorgtype();
    $organizationOrgTypes = $organizationOrgTypeModel->listItemsBy('_organization_id', $this->organization_id);

    return $organizationOrgTypes;
  }

  public function types() {
    $organizationTypeModel = new CCExModelsOrganizationtype();
    $organizationTypes = array();

    foreach ($this->organizationOrgTypes() as $organizationOrgType) {
      array_push($organizationTypes, $organizationTypeModel->getItemBy('_org_type_id',  $organizationOrgType->org_type_id));
    }

    return $organizationTypes;
  }

  public function isOfType($org_type_id){
    foreach ($this->types() as $type) {
      if($type->org_type_id == $org_type_id){
        return true;
      }
    }

    return false;
  }

  public function removeAllTypes() {
    $organizationOrgTypeModel = new CCExModelsOrganizationorgtype();

    foreach ($this->organizationOrgTypes() as $type) {
      $organizationOrgTypeModel->delete($type->organization_org_type_id);
    }
  }

  public function addTypes($typeIds){
    $organizationOrgTypeModel = new CCExModelsOrganizationorgtype();

    foreach ($typeIds as $typeId) {
      $data = array();
      $data['org_type_id'] = $typeId;
      $data['organization_id'] = $this->organization_id; 

      $organizationOrgTypeModel->store($data);
    }
  }

  public function haveOtherType(){
    foreach ($this->types() as $type) {
      if($type->name == "Other"){
        return true;
      }
    }

    return false;
  }

  public function typesToString(){
    $string = "";
    $other = false;
    $types = $this->types();

    if($types){
      $string .= array_shift($types)->name;
      
      foreach ($types as $type) {
        if($type->name == "Other"){
          $other = true;
        }else{
          $string .= ", " . $type->name;
        }
      }

      if($other){
        $string .= ", " . $this->other_org_type;
      }
    }

    return $string;
  }

}
