<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsCollection extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_collection_id  = null;
  var $_organization_id = null;
  var $_pagination      = null;
  var $_total           = null;

  function __construct() {
    $app = JFactory::getApplication();
    $this->_collection_id = $app->input->get('collection_id', null);
    
    parent::__construct();       
  }
 
  public function getItem() {
    $collection = parent::getItem();

    if($collection){
      return CCExHelpersCast::cast('CCExModelsCollection', $collection);
    }
  }
 
  /**
  * Builds the query to be used by the Collection model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('p.collection_id, p.organization_id, p.name, p.description, p.scope');
    $query->from('#__ccex_collections as p');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {

    if(is_numeric($this->_collection_id)) {
      $query->where('p.collection_id = ' . (int) $this->_collection_id);
    }else{
      if($this->_organization_id) {
        $query->where("p.organization_id = '" . $this->_organization_id . "'");
      }
    }
    
    return $query;
  }

  public function store($data=null) {    
    $data = $data ? $data : JRequest::get('post');
    $date = date("Y-m-d H:i:s");

    $row_collection = JTable::getInstance('collection','Table');
    if (!$row_collection->bind($data['collection'])){ return 0; }

    $row_collection->modified = $date;
    if (!$row_collection->check()){ return 0; }
    if (!$row_collection->store()){ return 0; }

    $data['interval']['collection_id'] = $row_collection->collection_id;
    $intervalModel = new CCExModelsInterval();
    $result = $intervalModel->store($data['interval']);
    
    $return = array('collection_id' => $row_collection->collection_id);
    foreach( $result as $key => $value ){
      $return[$key] = $value;
    }

    return $return;
  }

  public function organization() {
    $organizationModel = new CCExModelsOrganization();
    $organization = $organizationModel->getItemBy('_organization_id', $this->organization_id);

    return $organization;
  }

  public function intervals() {
    $intervalModel = new CCExModelsInterval();

    if(is_numeric($this->_collection_id)){
      return $intervalModel->listItemsByCollection($this->_collection_id);
    }else if(isset($this->collection_id)){
      return $intervalModel->listItemsByCollection($this->collection_id);
    }else{
      return array();
    }
  }

  public function numberIntervals(){
    return count($this->intervals());
  }

  public function totalDuration(){
    $duration = 0;

    foreach ($this->intervals() as $interval) {
      $interval = CCExHelpersCast::cast('CCExModelsInterval',  $interval);
      $duration += $interval->duration();
    }

    return $duration;
  }

  public function totalCost(){
    $cost = 0;

    foreach ($this->intervals() as $interval) {
      $interval = CCExHelpersCast::cast('CCExModelsInterval',  $interval);
      $cost += $interval->sumCosts();
    }

    return $cost;
  }

  public function totalCostPerGB() {
    $cost = 0;

    foreach ($this->intervals() as $interval) {
      $interval = CCExHelpersCast::cast('CCExModelsInterval',  $interval);
      $cost += $interval->sumCostsPerGB();
    }

    return $cost;
  }

  public function totalCostPerYear() {
    $cost = 0;

    foreach ($this->intervals() as $interval) {
      $interval = CCExHelpersCast::cast('CCExModelsInterval',  $interval);
      $cost += $interval->sumCostsPerYear();
    }

    return $cost;
  }

  public function totalCostPerGBPerYear() {
    $cost = 0;

    foreach ($this->intervals() as $interval) {
      $interval = CCExHelpersCast::cast('CCExModelsInterval',  $interval);
      $cost += $interval->sumCostsPerGBPerYear();
    }

    return $cost;
  }

  public function percentageActivityMapping(){
    $sum = 0;
    $size = 0;
    foreach ($this->intervals() as $interval) {
      $interval = CCExHelpersCast::cast('CCExModelsInterval',  $interval);
      $sum += $interval->percentageActivityMapping();
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
    foreach ($this->intervals() as $interval) {
      $interval = CCExHelpersCast::cast('CCExModelsInterval',  $interval);
      $sum += $interval->percentageFinancialAccountingMapping();
      $size++;
    }

    if($size){
      return intval($sum/$size);
    }else{
      return 0;
    }
  }

  public function intervalsWithoutLast(){
    return array_slice($this->intervals(), 0, -1);
  }

  public function lastInterval() {
    return CCExHelpersCast::cast('CCExModelsInterval',end($this->intervals()));
  }

  public function newInterval() {
    $newInterval = new CCExModelsInterval();
    $newInterval->set('collection_id', $this->_collection_id);
    $newInterval->set('begin_year', date("Y"));

    return $newInterval;
  }

  public function activeInterval($intervalID) {
    if($intervalID){
      $intervalModel = new CCExModelsInterval();
      return $intervalModel->getItemBy('_interval_id', $intervalID);
    }else{
      return $this->lastInterval();
    }
  }
}
