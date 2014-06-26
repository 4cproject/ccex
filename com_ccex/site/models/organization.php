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
    $this->_organization_id = $app->input->get('organization_id', null);
    
    parent::__construct();  
  }

  public function getItem() {
    $organization = parent::getItem();

    if($organization){
      return CCExHelpersCast::cast('CCExModelsOrganization', $organization);
    }
  }
  
  /**
  * Builds the query to be used by the Organization model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('o.organization_id, o.name, o.other_org_type, o.description, o.country_id, o.currency_id, o.global_comparison, o.peer_comparison, o.contact_and_sharing, o.snapshots');
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

  public function store($data=null) {    
    $data = $data ? $data : JRequest::get('post');
    $date = date("Y-m-d H:i:s");
    $userModel = new CCExModelsUser();

    $data['organization']['user_id'] = $userModel->_user_id;

    $row_organization = JTable::getInstance('organization','Table');
    if (!$row_organization->bind($data['organization'])){ return false; }

    $row_organization->modified = $date;
    if (!$row_organization->check()){ return false; }
    if (!$row_organization->store()){ return false; }

    $organizationModel = new CCExModelsOrganization();
    $organization = $organizationModel->getItemBy('_organization_id', $row_organization->organization_id);

    $organization->set('_organization_id', $row_organization->organization_id);
    $organization->set('organization_id', $row_organization->organization_id);

    $organization->removeAllTypes();
    if(array_key_exists('org_type', $data)){
      $organization->addTypes($data['org_type']);
    }

    $return = array('organization_id' => $row_organization->organization_id);

    return $return;
  }

  public function currency() {
    $currencyModel = new CCExModelsCurrency();
    $currency = $currencyModel->getItemBy('_currency_id', $this->currency_id);
    
    return $currency;
  }

  public function collections(){
    $collectionModel = new CCExModelsCollection();
    $collections = $collectionModel->listItemsBy('_organization_id', $this->organization_id);
    
    return $collections;
  }

  public function numberCollections(){
    return count($this->collections());
  }

  public function totalCost(){
    $cost = 0;

    foreach ($this->collections() as $collection) {
      $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
      $cost += $collection->totalCost();
    }

    return $cost;
  }

  public function totalCostPerGB() {
    $cost = 0;

    foreach ($this->collections() as $collection) {
      $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
      $cost += $collection->totalCostPerGB();
    }

    return $cost;
  }

  public function totalCostPerYear() {
    $cost = 0;

    foreach ($this->collections() as $collection) {
      $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
      $cost += $collection->totalCostPerYear();
    }

    return $cost;
  }

  public function totalCostPerGBPerYear() {
    $cost = 0;

    foreach ($this->collections() as $collection) {
      $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
      $cost += $collection->totalCostPerGBPerYear();
    }

    return $cost;
  }

  public function formattedSumCostPerGB() {
    return sprintf('%s/GB', CCExHelpersTag::formatCurrencyWithSymbol($this->totalCostPerGB(), $this->currency()->symbol));
  }

  public function formattedTotalCostPerYear() {
    return sprintf('%s/Y', CCExHelpersTag::formatCurrencyWithSymbol($this->totalCostPerYear(), $this->currency()->symbol));
  }

    public function formattedTotalCostPerGBPerYear() {
    return sprintf('%s/GB·Y', CCExHelpersTag::formatCurrencyWithSymbol($this->totalCostPerGBPerYear(), $this->currency()->symbol));
  }

  public function formattedTotalCost() {
    return CCExHelpersTag::formatCurrencyWithSymbol($this->totalCost(), $this->currency()->symbol);
  }

  public function totalDuration(){
    $duration = 0;

    foreach ($this->collections() as $collection) {
      $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
      $duration += $collection->totalDuration();
    }

    return $duration;
  }

  public function numberIntervals(){
    $numberIntervals = 0;

    foreach ($this->collections() as $collection) {
      $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
      $numberIntervals += $collection->numberIntervals();
    }

    return $numberIntervals;
  }

  public function percentageActivityMapping(){
    $sum = 0;
    $size = 0;
    foreach ($this->collections() as $collection) {
      $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
      $sum += $collection->percentageActivityMapping();
      $size++;
    }

    if($size){
      return intval($sum/$size);
    }else{
      return 0;
    }
  }

  public function percentageFinancialAccountingMapping(){
    $sum = 0;
    $size = 0;
    foreach ($this->collections() as $collection) {
      $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
      $sum += $collection->percentageFinancialAccountingMapping();
      $size++;
    }

    if($size){
      return intval($sum/$size);
    }else{
      return 0;
    }
  }

  public function country() {
    $countryModel = new CCExModelsCountry();
    $country = $countryModel->getItemBy('_country_id', $this->country_id);
    
    return $country;
  }

  public function organizationOrgTypes() {
    $organizationOrgTypeModel = new CCExModelsOrganizationorgtype();
    $organizationOrgTypes = $organizationOrgTypeModel->listItemsBy('_organization_id', $this->organization_id);

    return $organizationOrgTypes;
  }

  public function types() {
    $organizationTypeModel = new CCExModelsOrganizationtype();
    $organizationTypes = array();

    foreach ($this->organizationOrgTypes() as $organizationOrgType) {
      array_push($organizationTypes, $organizationTypeModel->getItemBy('_org_type_id',  $organizationOrgType->org_type_id));
    }

    return $organizationTypes;
  }

  public function isOfType($org_type_id){
    foreach ($this->types() as $type) {
      if($type->org_type_id == $org_type_id){
        return true;
      }
    }

    return false;
  }

  public function removeAllTypes() {
    $organizationOrgTypeModel = new CCExModelsOrganizationorgtype();

    foreach ($this->organizationOrgTypes() as $type) {
      $organizationOrgTypeModel->delete($type->organization_org_type_id);
    }
  }

  public function addTypes($typeIds){
    $organizationOrgTypeModel = new CCExModelsOrganizationorgtype();

    foreach ($typeIds as $typeId) {
      $data = array();
      $data['org_type_id'] = $typeId;
      $data['organization_id'] = $this->_organization_id; 

      $organizationOrgTypeModel->store($data);
    }
  }

  public function haveOtherType(){
    foreach ($this->types() as $type) {
      if($type->name == "Other"){
        return true;
      }
    }

    return false;
  }

  public function typesToString(){
    $string = "";
    $other = false;
    $types = $this->types();

    if($types){
      $string .= array_shift($types)->name;
      
      foreach ($types as $type) {
        if($type->name == "Other"){
          $other = true;
        }else{
          $string .= ", " . $type->name;
        }
      }

      if($other){
        $string .= ", " . $this->other_org_type;
      }
    }

    return $string;
  }

  public function globalComparison(){
    if($this->global_comparison){
      return "Yes";
    }else{
      return "No";
    }
  }

  public function peerComparison(){
    if($this->peer_comparison){
      return "Yes";
    }else{
      return "No";
    }
  }

  public function contactAndSharing(){
    if($this->contact_and_sharing){
      return "Yes";
    }else{
      return "No";
    }
  }

  public function snapshots(){
    if($this->snapshots){
      return "Yes";
    }else{
      return "No";
    }
  }
}
