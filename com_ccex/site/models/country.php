<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsCountry extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_country_id = null;
  var $_name        = null;
  var $_pagination  = null;
  var $_total       = null;

  function __construct() {
    $app = JFactory::getApplication();
    $this->_country_id = $app->input->get('id', null);
    
    parent::__construct();       
  }
 
  public function getItem() {
    $country = parent::getItem();

    return CCExHelpersCast::cast('CCExModelsCountry', $country);
  }
 
  /**
  * Builds the query to be used by the Country model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('c.country_id, c.name');
    $query->from('#__ccex_countries as c');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {

    if(is_numeric($this->_country_id)) {
      $query->where('c.country_id = ' . (int) $this->_country_id);
    }

    return $query;
  }
}
