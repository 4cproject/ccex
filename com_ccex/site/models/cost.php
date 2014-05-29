<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsCost extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_user_id         = null;
  var $_organization_id = null;
  var $_cost_id         = null;
  var $_pagination      = null;
  var $_total           = null;

  function __construct() {
    $app = JFactory::getApplication();

    $this->_user_id = JFactory::getUser()->id;
    
    parent::__construct();       
  }
 
  public function getItem() {
    $cost = parent::getItem();

    return $cost;
  }

  /**
  * Builds the query to be used by the Cost model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {
    return $query;
  }

}
