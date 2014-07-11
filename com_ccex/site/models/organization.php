<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsOrganization extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  protected $_organization_id = null;
  protected $_user_id         = null;
  protected $_name            = null;
  protected $_pagination      = null;
  protected $_total           = null;
  protected $_deleted         = 0;

  function __construct() {
    parent::__construct();  
  }

  public function getItem() {
    $organization = null;

    if(is_numeric($this->_organization_id) || is_numeric($this->_user_id)) {
      $organization = parent::getItem();

      if($organization){
        $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
      }
    }

    if($organization && $organization->havePermissions($this->_session_user_id)){
      return $organization;
    }

    return null;
  }
  
  /**
  * Builds the query to be used by the Organization model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('o.organization_id, o.user_id , o.name, o.other_org_type, o.description, o.country_id, o.currency_id, o.global_comparison, o.peer_comparison, o.contact_and_sharing, o.snapshots');
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
    }elseif (is_numeric($this->_user_id)) {
      $query->where('o.user_id = ' . (int) $this->_user_id);
    }

    $query->where('o.deleted = ' . (int) $this->_deleted);

    return $query;
  }

  /**
  * Override the default store
  *
  */
  public function store($data=null) {    
    $data = $data ? $data : JRequest::get('post');
    $date = date("Y-m-d H:i:s");

    $userModel = new CCExModelsUser();
    $data['organization']['user_id'] = $userModel->user_id;

    if(!$data['organization']['user_id'] ||
       !$data['organization']['country_id'] ||
       !$data['organization']['currency_id'] ||
       !$data['organization']['name']){
      return null;
    }

    $row_organization = JTable::getInstance('organization','Table');
    if (!$row_organization->bind($data['organization'])){ return null; }

    $row_organization->modified = $date;
    if (!$row_organization->check()){ return null; }
    if (!$row_organization->store()){ return null; }

    $organizationModel = new CCExModelsOrganization();
    $organization = $organizationModel->getItemBy('_organization_id', $row_organization->organization_id);

    $organization->removeAllTypes();
    if(array_key_exists('org_type', $data)){
      $organization->addTypes($data['org_type']);
    }

    $return = array('organization_id' => $row_organization->organization_id);

    return $return;
  }

  public function havePermissions($user_id) {
    if($user_id && $this->user_id == $user_id){
      return true;
    }

    return false;
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

  public function intervals(){
    $intervals = array();

    foreach ($this->collections() as $collection) {
      $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
      $intervals = array_merge( $intervals, $collection->intervals() );
    }

    return $intervals;
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
      $data['organization_id'] = $this->organization_id; 

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

  // B FIX THIS
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
  // E

  private function beginAndLastYear(){
    $intervals = $this->intervals();
    $firstInterval = array_shift($intervals);

    $beginYear = $firstInterval->begin_year;
    $lastYear = $beginYear + $firstInterval->duration-1;

    foreach ($intervals as $interval) {
      if($interval->begin_year < $beginYear){
        $beginYear = $interval->begin_year;
      }

      if(($interval->begin_year + $interval->duration-1) > $lastYear){
        $lastYear = $interval->begin_year + $interval->duration-1;
      }
    }

    return array(
      "begin_year" => $beginYear,
      "last_year"  => $lastYear
    );
  }

  private function categoriesNumberandRange(){
    $beginAndLastYear = $this->beginAndLastYear();
    $beginYear = $beginAndLastYear["begin_year"];
    $lastYear = $beginAndLastYear["last_year"];

    $numberOfYears = $lastYear-$beginYear+1;

    if($numberOfYears > 10){
      $indexRange = 2;

      while(($numberOfYears / $indexRange) > 10){
        $indexRange++;
      }

      $range = $indexRange;
      $number = ceil($numberOfYears / $indexRange);
    }else{
      $number = $numberOfYears;
      $range = 1;
    }

    return array(
      "number" => $number,
      "range"  => $range
    );
  }

  private function categories($beginYear, $number, $range){
    $categories = array();
    $currentYear = $beginYear;
    $currentNumber = $number;

    while($currentNumber>0){
      if($range>1) {
        array_push($categories, $currentYear . "-" . ($currentYear+$range-1));
        $currentYear += $range;
      }else{
        array_push($categories, strval($currentYear));
        $currentYear++;
      }
      $currentNumber--;
    }

    return $categories;
  }

  private function categoriesPositionsToUpdate($interval, $beginYear, $number, $range){
    $positions = array();

    $currentYear = $beginYear;
    $currentNumber = 0;

    $interval_begin = $interval->begin_year;
    $interval_end = $interval_begin + $interval->duration-1;

    while($currentNumber<$number){
      if(($currentYear >= $interval_begin && $currentYear <= $interval_end) || 
         ($currentYear + $range-1 >= $interval_begin && $currentYear + $range-1 <= $interval_end)){
          array_push($positions, $currentNumber);
      }
      $currentYear += $range;
      $currentNumber++;
    }

    return $positions;
  }

  private function series($collections, $beginYear, $number, $range){
    if(count($collections)){
      $series = $this->collectionsSeries($collections, $beginYear, $number, $range);
    }else{
      $series = $this->organizationSeries($beginYear, $number, $range);
    }

    return $series;
  }

  private function collectionsSeries($collections, $beginYear, $number, $range){
    $series = array();
    $linked = true;

    foreach ($collections as $collectionID) {
      $collectionModel = new CCExModelsCollection();
      $collection = $collectionModel->getItemBy("_collection_id", $collectionID);

      if($collection){
        $data = $this->serieData($collection->intervals(), $beginYear, $number, $range);

        array_push($series, $this->hardwareSerie($data["cat_hardware"], $collection->name, $linked));
        array_push($series, $this->softwareSerie($data["cat_software"], $collection->name, $linked));
        array_push($series, $this->externalSerie($data["cat_external"], $collection->name, $linked));
        array_push($series, $this->producerSerie($data["cat_producer"], $collection->name, $linked));
        array_push($series, $this->itDeveloperSerie($data["cat_it_developer"], $collection->name, $linked));
        array_push($series, $this->supportSerie($data["cat_support"], $collection->name, $linked));
        array_push($series, $this->preservationAnalystSerie($data["cat_analyst"], $collection->name, $linked));
        array_push($series, $this->managerSerie($data["cat_manager"], $collection->name, $linked));
        array_push($series, $this->overheadSerie($data["cat_overhead"], $collection->name, $linked));
        array_push($series, $this->otherSerie($data["cat_other"], $collection->name, $linked));

        $linked=false;
      }
    }

    return $series;
  }

  private function organizationSeries($beginYear, $number, $range){
    $series = array();

    $data = $this->serieData($this->intervals(), $beginYear, $number, $range);

    array_push($series, $this->hardwareSerie($data["cat_hardware"]));
    array_push($series, $this->softwareSerie($data["cat_software"]));
    array_push($series, $this->externalSerie($data["cat_external"]));
    array_push($series, $this->producerSerie($data["cat_producer"]));
    array_push($series, $this->itDeveloperSerie($data["cat_it_developer"]));
    array_push($series, $this->supportSerie($data["cat_support"]));
    array_push($series, $this->preservationAnalystSerie($data["cat_analyst"]));
    array_push($series, $this->managerSerie($data["cat_manager"]));
    array_push($series, $this->overheadSerie($data["cat_overhead"]));
    array_push($series, $this->otherSerie($data["cat_other"]));

    return $series;
  }

  private function hardwareSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "Hardware",
      "data"      => $data,
      "color"     => "#00b050",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_hardware";
    }else{
      $serie["id"] = "cat_hardware";
    }

    return $serie;
  }

  private function softwareSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "Software",
      "data"      => $data,
      "color"     => "#006fc0",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_software";
    }else{
      $serie["id"] = "cat_software";
    }

    return $serie;
  }

  private function externalSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "External",
      "data"      => $data,
      "color"     => "#ff0000",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_external";
    }else{
      $serie["id"] = "cat_external";
    }

    return $serie;
  }

  private function producerSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "Producer",
      "data"      => $data,
      "color"     => "#e46c0a",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_producer";
    }else{
      $serie["id"] = "cat_producer";
    }

    return $serie;
  }

  private function itDeveloperSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "IT-developer",
      "data"      => $data,
      "color"     => "#E80796",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_it_developer";
    }else{
      $serie["id"] = "cat_it_developer";
    }

    return $serie;
  }

  private function supportSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "Support/operations",
      "data"      => $data,
      "color"     => "#5D07E8",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_support";
    }else{
      $serie["id"] = "cat_support";
    }

    return $serie;
  }

  private function preservationAnalystSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "Preservation analyst",
      "data"      => $data,
      "color"     => "#11FFF7",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_analyst";
    }else{
      $serie["id"] = "cat_analyst";
    }

    return $serie;
  }

  private function managerSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "Manager",
      "data"      => $data,
      "color"     => "#8dff1e",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_manager";
    }else{
      $serie["id"] = "cat_manager";
    }

    return $serie;
  }

  private function overheadSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "Overhead",
      "data"      => $data,
      "color"     => "#ffb271",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_overhead";
    }else{
      $serie["id"] = "cat_overhead";
    }

    return $serie;
  }

  private function otherSerie($data, $stack="All collections", $linked=false){
    $serie = array(
      "name"      => "Other",
      "data"      => $data,
      "color"     => "#aaa",
      "stack"     => $stack
    );

    if($linked){
      $serie["linkedTo"] = "cat_other";
    }else{
      $serie["id"] = "cat_other";
    }

    return $serie;
  }

  private function serieData($intervals, $beginYear, $number, $range){
    $data = array(
      "cat_hardware"     => array_fill(0, $number, 0),
      "cat_software"     => array_fill(0, $number, 0),
      "cat_external"     => array_fill(0, $number, 0),
      "cat_producer"     => array_fill(0, $number, 0),
      "cat_it_developer" => array_fill(0, $number, 0),
      "cat_support"      => array_fill(0, $number, 0),
      "cat_analyst"      => array_fill(0, $number, 0),
      "cat_manager"      => array_fill(0, $number, 0),
      "cat_overhead"     => array_fill(0, $number, 0),
      "cat_other"        => array_fill(0, $number, 0)
    );

    foreach ($intervals as $interval) {
      $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);

      $positionsToUpdate = $this->categoriesPositionsToUpdate($interval, $beginYear, $number, $range);
    
      foreach ($positionsToUpdate as $position) {
        $data["cat_hardware"][$position]     += round($interval->costsPerGBPerYearOfCategory("cat_hardware"), 2);
        $data["cat_software"][$position]     += round($interval->costsPerGBPerYearOfCategory("cat_software"), 2);
        $data["cat_external"][$position]     += round($interval->costsPerGBPerYearOfCategory("cat_external"), 2);
        $data["cat_producer"][$position]     += round($interval->costsPerGBPerYearOfCategory("cat_producer"), 2);
        $data["cat_it_developer"][$position] += round($interval->costsPerGBPerYearOfCategory("cat_it_developer"), 2);
        $data["cat_support"][$position]      += round($interval->costsPerGBPerYearOfCategory("cat_support"), 2);
        $data["cat_analyst"][$position]      += round($interval->costsPerGBPerYearOfCategory("cat_analyst"), 2);
        $data["cat_manager"][$position]      += round($interval->costsPerGBPerYearOfCategory("cat_manager"), 2);
        $data["cat_overhead"][$position]     += round($interval->costsPerGBPerYearOfCategory("cat_overhead"), 2);
        $data["cat_other"][$position]        += round($interval->costsPerGBPerYearOfCategory("cat_other"), 2);
      }
    }

    return $data;
  }

  public function financialAccounting($collections = array()){
    $beginAndLastYear = $this->beginAndLastYear();
    $categoriesNumberandRange = $this->categoriesNumberandRange();
    $beginYear = $beginAndLastYear["begin_year"];
    $number = $categoriesNumberandRange["number"];

    $range = $categoriesNumberandRange["range"];

    $result = array(
      "categories" => $this->categories($beginYear, $number, $range),
      "series" => $this->series($collections, $beginYear, $number, $range)
    );

    return $result;
  }

  public function financialAccountingCategories($collections = array()){
    $financialAccounting = $this->financialAccounting($collections);
    return $financialAccounting["categories"];
  }

  public function financialAccountingSeries($collections = array()){
    $financialAccounting = $this->financialAccounting($collections);
    return $financialAccounting["series"];
  }

  public function financialAccountingCategoriesJSON($collections = array()){
    return json_encode($this->financialAccountingCategories($collections));
  }

  public function financialAccountingSeriesJSON($collections = array()){
    return json_encode($this->financialAccountingSeries($collections));
  }
}
