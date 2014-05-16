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

    $query->select('o.organization_id, o.name');
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

  /**
  * Delete a Organization
  * @param int      ID of the Organization to delete
  * @return boolean True if successfully deleted
  */
  public function delete($id = null)
  {
    $app  = JFactory::getApplication();
    $id   = $id ? $id : $app->input->get('organization_id');

    if (!$id) {
      if ($organization_id = $app->input->get('organization_id')) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->delete()
            ->from('#__ccex_organizations')
            ->where('organization_id = ' . $organization_id);
        $db->setQuery($query);
        if($db->query()) {
          return true;
        }
      } 
    } else {
      $waitlist = JTable::getInstance('Organization','Table');
      $waitlist->load($id);

      if ($waitlist->delete()) {
        return true;
      }      
    }

    return false;
  }

}
