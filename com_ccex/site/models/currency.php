<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsCurrency extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_currency_id = null;
  var $_name        = null;
  var $_pagination  = null;
  var $_total       = null;

  function __construct() {
    $app = JFactory::getApplication();
    $this->_currency_id = $app->input->get('id', null);
    
    parent::__construct();       
  }

  public function getItem() {
    $currency = parent::getItem();

    return $currency;
  }

  /**
  * Builds the query to be used by the Currency model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('c.currency_id, c.name');
    $query->from('#__ccex_currencies as c');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {

    if(is_numeric($this->_currency_id)) {
      $query->where('c.currency_id = ' . (int) $this->_currency_id);
    }

    return $query;
  }

  /**
  * Delete a Currency
  * @param int      ID of the Currency to delete
  * @return boolean True if successfully deleted
  */
  public function delete($id = null)
  {
    $app  = JFactory::getApplication();
    $id   = $id ? $id : $app->input->get('currency_id');

    if (!$id) {
      if ($currency_id = $app->input->get('currency_id')) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->delete()
            ->from('#__ccex_currencies')
            ->where('currency_id = ' . $currency_id);
        $db->setQuery($query);
        if($db->query()) {
          return true;
        }
      } 
    } else {
      $waitlist = JTable::getInstance('Currency','Table');
      $waitlist->load($id);

      if ($waitlist->delete()) {
        return true;
      }      
    }

    return false;
  }

}
