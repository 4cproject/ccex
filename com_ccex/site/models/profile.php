<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsProfile extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_user_id         = null;
  var $_organization_id = null;
  var $_pagination      = null;
  var $_total           = null;

  function __construct() {
    $app = JFactory::getApplication();

    $this->_user_id = JFactory::getUser()->id;
    
    parent::__construct();       
  }
 
  public function getItem() {
    $profile = parent::getItem();

    return $profile;
  }

  /**
  * Builds the query to be used by the Profile model
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

    $organization = $this->organizationOrEmpty();
    $data['organization']['organization_id'] = $organization->organization_id;
    $data['organization']['user_id'] = $this->_user_id;

    $row_organization = JTable::getInstance('organization','Table');
    if (!$row_organization->bind($data['organization'])){ return false; }

    $row_organization->modified = $date;
    if (!$row_organization->check()){ return false; }
    if (!$row_organization->store()){ return false; }

    $Collection = $organization->CollectionOrEmpty();
    $data['profile']['collection_id'] = $Collection->collection_id;
    $data['profile']['organization_id'] = $row_organization->organization_id;

    if(isset($data['profile']['staff'])){
      $scope_size = explode('|', $data['profile']['staff']);
            
      $data['profile']['staff_min_size'] = $scope_size[0];
      $data['profile']['staff_max_size'] = $scope_size[1];
    }
    if(isset($data['profile']['data_volume_number'])){
      if(isset($data['profile']['data_volume_unit'])){
        $data['profile']['data_volume'] = $data['profile']['data_volume_number'] * $data['profile']['data_volume_unit'];
      }else{
        $data['profile']['data_volume'] = $data['profile']['data_volume_number'];
      }
    }

    $row_profile = JTable::getInstance('Collection','Table');
    if (!$row_profile->bind($data['profile'])){ return false; }

    $row_profile->modified = $date;
    if (!$row_profile->check()){ return false; }
    if (!$row_profile->store()){ return false; }

    return true;
  }

  public function organization(){
    $organizationModel = new CCExModelsOrganization();
    $organization = $organizationModel->getItemBy('_user_id',$this->_user_id);

    if($organization){
      return CCExHelpersCast::cast('CCExModelsOrganization', $organization);
    }else{
      return null;
    }
  }

  public function organizationOrEmpty(){
    $organization = $this->organization();

    if(!$organization){
      $organization = new CCExModelsOrganization();
      $organization->set('_user_id',$this->_user_id);
      $organization->set('organization_id');
      $organization->set('org_type_id');
    }

    if($organization){
      return CCExHelpersCast::cast('CCExModelsOrganization', $organization);
    }else{
      return null;
    }
  }
}
