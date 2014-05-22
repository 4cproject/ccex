<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsProfilescope extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_profile_scope_id = null;
  var $_name        = null;
  var $_pagination  = null;
  var $_total       = null;

  function __construct() {
    $app = JFactory::getApplication();
    $this->_profile_scope_id = $app->input->get('id', null);
    
    parent::__construct();       
  }
 
  public function getItem() {
    $profileScope = parent::getItem();

    return $profileScope;
  }
 
  /**
  * Builds the query to be used by the ProfileScope model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('s.profile_scope_id, s.name, s.min_size, s.max_size');
    $query->from('#__ccex_profile_scopes as s');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {

    if(is_numeric($this->_profile_scope_id)) {
      $query->where('s.profile_scope_id = ' . (int) $this->_profile_scope_id);
    }else{
      if($this->_name) {
        $query->where("s.name = '" . $this->_name . "'");
      }
    }
    
    return $query;
  }
}
