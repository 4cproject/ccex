<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsOrganizationtype extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_org_type_id = null;
  var $_name        = null;
  var $_pagination  = null;
  var $_total       = null;

  function __construct() {
    $app = JFactory::getApplication();
    $this->_org_type_id = $app->input->get('org_type_id', null);
    
    parent::__construct();       
  }
 
  public function getItem() {
    $organizationType = parent::getItem();

    if($organizationType){
      return CCExHelpersCast::cast('CCExModelsOrganizationtype', $organizationType);
    }
  }
 
  /**
  * Builds the query to be used by the OrganizationType model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('t.org_type_id, t.name');
    $query->from('#__ccex_organization_types as t');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {

    if(is_numeric($this->_org_type_id)) {
      $query->where('t.org_type_id = ' . (int) $this->_org_type_id);
    }else{
      if($this->_name) {
        $query->where("t.name = '" . $this->_name . "'");
      }
    }
    
    return $query;
  }
}
