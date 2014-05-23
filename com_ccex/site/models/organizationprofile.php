<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsOrganizationprofile extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_org_profile_id  = null;
  var $_organization_id = null;
  var $_pagination      = null;
  var $_total           = null;

  function __construct() {
    $app = JFactory::getApplication();
    $this->_org_profile_id = $app->input->get('id', null);
    
    parent::__construct();       
  }
 
  public function getItem() {
    $organizationProfile = parent::getItem();

    return $organizationProfile;
  }
 
  /**
  * Builds the query to be used by the OrganizationProfile model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('p.org_profile_id, p.organization_id, p.profile_scope_id, p.data_volume, p.number_copies, p.asset_unformatted_text, p.asset_word_processing, p.asset_spreadsheet, p.asset_graphics, p.asset_audio, p.asset_video, p.asset_hypertext, p.asset_geodata, p.asset_email, p.asset_database, p.asset_research_data');
    $query->from('#__ccex_organization_profiles as p');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {

    if(is_numeric($this->_org_profile_id)) {
      $query->where('p.org_profile_id = ' . (int) $this->_org_profile_id);
    }else{
      if($this->_organization_id) {
        $query->where("p.organization_id = '" . $this->_organization_id . "'");
      }
    }
    
    return $query;
  }

  public function dataVolume(){
    $result = new stdClass();
    $result->format = "Gigabytes";
    $result->value = 0;

    if(isset($this->data_volume)){
      $datav = $this->data_volume;

      if($datav >= 1048576){
        $result->format = "Petabytes";
        $result->value = round($datav/1048576);
      }elseif($datav >= 1024){
        $result->format = "Terabytes";
        $result->value = round($datav/1024);
      }else{
        $result->value = round($datav);
      }
    }

    return $result;
  }
}
