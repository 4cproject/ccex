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
    $profile = JFactory::getUser($this->_user_id);
    // $userDetails = JUserHelper::getProfile($this->_user_id);
    // $profile->details =  isset($userDetails->profile) ? $userDetails->profile : array();

    $organizationModel = new CCExModelsOrganization();
    $organizationModel->set('_user_id',$this->_user_id);
    $organization = $organizationModel->getItem();

    if(!$organization){
      $organization = new CCExModelsOrganization();
      $organization->org_type = new CCExModelsOrganizationtype();
      $organization->org_type->name="Other";
      $organizationProfile = null;
    }else{
      $organizationProfileModel = new CCExModelsOrganizationprofile();
      $organizationProfileModel->set('_organization_id',$organization->organization_id);
      $organizationProfile = $organizationProfileModel->getItem();
    }  

    if($organizationProfile){
      $profileScopeModel = new CCExModelsProfilescope();
      $profileScopeModel->set('_profile_scope_id',$organizationProfile->profile_scope_id);
      $profileScope = $profileScopeModel->getItem();  

      if($profileScope){
        $organizationProfile->scope = $profileScope;
      } else {
        $organizationProfile->scope = new CCExModelsProfilescope();
      }
    }else{
      $organizationProfile = new CCExModelsOrganizationprofile();
      $organizationProfile->scope = new CCExModelsProfilescope();
    }

    $organization->profile = $organizationProfile;
    $profile->organization = $organization;

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

    $organizationModel = new CCExModelsOrganization();
    $organizationModel->set('_user_id',$this->_user_id);
    $organization = $organizationModel->getItem();

    if(!$organization){ 
      $organization = new CCExModelsOrganization();
      $data['organization']['user_id'] = $this->_user_id;
    }else{
      $data['organization']['organization_id'] = $organization->organization_id;
    }
    
    $row_organization = JTable::getInstance('organization','Table');
    if (!$row_organization->bind($data['organization'])){ return false; }

    $row_organization->modified = $date;
    if (!$row_organization->check()){ return false; }
    if (!$row_organization->store()){ return false; }

    $organizationProfileModel = new CCExModelsOrganizationprofile();
    $organizationProfileModel->set('_organization_id',$row_organization->organization_id);
    $organizationProfile = $organizationProfileModel->getItem();

    if($organizationProfile){
      $data['profile']['org_profile_id'] = $organizationProfile->org_profile_id;
      if($organizationProfile->profile_scope_id){
        $data['scope']['profile_scope_id'] = $organizationProfile->profile_scope_id;
      }
    } 
    
    if(isset($data['scope']['staff'])){
      $scope_size = explode('|', $data['scope']['staff']);
            
      $data['scope']['min_size'] = $scope_size[0];
      $data['scope']['max_size'] = $scope_size[1];
    }

    $row_scope = JTable::getInstance('profilescope','Table');
    if (!$row_scope->bind($data['scope'])){ return false; }

    $row_scope->modified = $date;
    if (!$row_scope->check()){ return false; }
    if (!$row_scope->store()){ return false; }

    $data['profile']['profile_scope_id'] = $row_scope->profile_scope_id;
    $data['profile']['organization_id'] = $row_organization->organization_id;

    if(isset($data['profile']['data_volume_number'])){
      if(isset($data['profile']['data_volume_unit'])){
        $data['profile']['data_volume'] = $data['profile']['data_volume_number'] * $data['profile']['data_volume_unit'];
      }else{
        $data['profile']['data_volume'] = $data['profile']['data_volume_number'];
      }

    }

    $row_profile = JTable::getInstance('organizationprofile','Table');
    if (!$row_profile->bind($data['profile'])){ return false; }

    $row_profile->modified = $date;
    if (!$row_profile->check()){ return false; }
    if (!$row_profile->store()){ return false; }

    return true;
  }
}
