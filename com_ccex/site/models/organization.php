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
    $this->_organization_id = $app->input->get('id', null);
    
    parent::__construct();  
  }

  public function getItem() {
    $organization = parent::getItem();

    return $organization;
  }
  
  /**
  * Builds the query to be used by the Organization model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('o.organization_id, o.name, o.org_type_id, o.other_org_type, o.description, o.country_id, o.currency_id, o.linked_data_provider, o.linked_cost_data, o.share_information, o.share_data');
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

  public function currency() {
    $currencyModel = new CCExModelsCurrency();
    $currency = $currencyModel->getItemBy('_currency_id', $this->currency_id);
    
    if($currency){
      return CCExHelpersCast::cast('CCExModelsCurrency', $currency);
    }else{
      return null;
    }
  }

  public function organizationType() {
    $organizationTypeModel = new CCExModelsOrganizationtype();
    $organizationType = $organizationTypeModel->getItemBy('_org_type_id', $this->org_type_id);
    
    if($organizationType){
      return CCExHelpersCast::cast('CCExModelsOrganizationtype', $organizationType);
    }else{
      return null;
    }
  }

  public function organizationTypeOrOther() {
    $organizationType = $this->organizationType();

    if(!$organizationType){
      $organizationType = new CCExModelsOrganizationtype();
      $organizationType->set('name', 'Other');
    }

    if($organizationType){
      return CCExHelpersCast::cast('CCExModelsOrganizationtype', $organizationType);
    }else{
      return null;
    }
  }

  public function Collection(){
    $CollectionModel = new CCExModelsCollection();
    $Collection = $CollectionModel->getItemBy('_organization_id', $this->organization_id);
    
    if($Collection){
      return CCExHelpersCast::cast('CCExModelsCollection', $Collection);
    }else{
      return null;
    }
  }

  public function CollectionOrEmpty(){
    $Collection = $this->Collection();

    if(!$Collection){
      $Collection = new CCExModelsCollection();
      $Collection->set('organization_id', $this->organization_id);
      $Collection->set('collection_id');
    }

    if($Collection){
      return CCExHelpersCast::cast('CCExModelsCollection', $Collection);
    }else{
      return null;
    }
  }
}
