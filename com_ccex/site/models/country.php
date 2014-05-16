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

    return $country;
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

  /**
  * Delete a Country
  * @param int      ID of the Country to delete
  * @return boolean True if successfully deleted
  */
  public function delete($id = null)
  {
    $app  = JFactory::getApplication();
    $id   = $id ? $id : $app->input->get('country_id');

    if (!$id) {
      if ($country_id = $app->input->get('country_id')) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->delete()
            ->from('#__ccex_countries')
            ->where('country_id = ' . $country_id);
        $db->setQuery($query);
        if($db->query()) {
          return true;
        }
      } 
    } else {
      $waitlist = JTable::getInstance('Country','Table');
      $waitlist->load($id);

      if ($waitlist->delete()) {
        return true;
      }      
    }

    return false;
  }

}
