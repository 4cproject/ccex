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

    return CCExHelpersCast::cast('CCExModelsOrganization', $organization);
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
    
    return $currency;
  }

  public function organizationType() {
    $organizationTypeModel = new CCExModelsOrganizationtype();
    $organizationType = $organizationTypeModel->getItemBy('_org_type_id', $this->org_type_id);
    
    return $organizationType;
  }

  public function organizationTypeOrOther() {
    $organizationType = $this->organizationType();

    if(!$organizationType){
      $organizationType = new CCExModelsOrganizationtype();
      $organizationType->set('name', 'Other');
    }

    return $organizationType;
  }

  public function collection(){
    $collectionModel = new CCExModelsCollection();
    $collection = $collectionModel->getItemBy('_organization_id', $this->organization_id);
    
    return $collection;
  }

  public function collectionOrEmpty(){
    $collection = $this->collection();

    if(!$collection){
      $collection = new CCExModelscollection();
      $collection->set('organization_id', $this->organization_id);
      $collection->set('collection_id');
    }

    return $collection;
  }

}
