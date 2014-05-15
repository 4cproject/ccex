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
    $this->_org_type_id = $app->input->get('id', null);
    
    parent::__construct();       
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

  public function getItem() {
    $organizationType = parent::getItem();

    return $organizationType;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {

    if(is_numeric($this->_org_type_id)) {
      $query->where('t.org_type_id = ' . (int) $this->_org_type_id);
    }

    if($this->_name) {
      $query->where('t.name = ' . (int) $this->_name);
    }

    return $query;
  }

  /**
  * Delete a OrganizationType
  * @param int      ID of the OrganizationType to delete
  * @return boolean True if successfully deleted
  */
  public function delete($id = null)
  {
    $app  = JFactory::getApplication();
    $id   = $id ? $id : $app->input->get('org_type_id');

    if (!$id) {
      if ($org_type_id = $app->input->get('org_type_id')) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->delete()
            ->from('#__ccex_organization_types')
            ->where('org_type_id = ' . $org_type_id);
        $db->setQuery($query);
        if($db->query()) {
          return true;
        }
      } 
    } else {
      $waitlist = JTable::getInstance('Organizationtype','Table');
      $waitlist->load($id);

      if ($waitlist->delete()) {
        return true;
      }      
    }

    return false;
  }

}
