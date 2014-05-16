<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsProfile extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_user_id         = null;
  var $_organization_id = null;
  var $_name            = null;
  var $_pagination      = null;
  var $_total           = null;

  function __construct() {
    $app = JFactory::getApplication();

    $this->_user_id = JFactory::getUser()->id;
    
    parent::__construct();       
  }
 
  public function getItem() {
    $profile = JFactory::getUser($this->_user_id);
    // $userDetails = JUserHelper::getProfile($this->_user_id);
    // $profile->details =  isset($userDetails->profile) ? $userDetails->profile : array();

    $organizationModel = new CCExModelsOrganization();
    $organizationModel->set('_user_id',$this->_user_id);
    $organization = $organizationModel->getItem();

    if(!$organization){
      $organization = new CCExModelsOrganization();
      $data = array("table" => "organization", "user_id" => $this->_user_id);
      
      if (!$organization->store($data)){
        $organization = null;
      }
    }

    $profile->organization = $organization;

    return $profile;
  }

  /**
  * Builds the query to be used by the Country model
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

  public function store($data=null) {    
    $data = $data ? $data : JRequest::get('post');
    $date = date("Y-m-d H:i:s");

    $organizationModel = new CCExModelsOrganization();
    $organizationModel->set('_user_id',$this->_user_id);
    $organization = $organizationModel->getItem();

    if(!$organization){ return false; }

    $data['organization']['organization_id'] = $organization->organization_id;
    $row_organization = JTable::getInstance('organization','Table');

    if (!$row_organization->bind($data['organization'])){ return false; }

    $row_organization->modified = $date;

    if (!$row_organization->check()){ return false; }
    if (!$row_organization->store()){ return false; }

    return $row_organization;
  }
}
