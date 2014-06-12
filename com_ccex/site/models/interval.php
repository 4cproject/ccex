<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsInterval extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_collection_id   = null;
  var $_interval_id         = null;
  var $_pagination      = null;
  var $_total           = null;

  function __construct() {
    $app = JFactory::getApplication();

    $this->_interval_id = $app->input->get('interval_id', null);
    
    parent::__construct();       
  }
 
  public function getItem() {
    $interval = parent::getItem();

    if($interval){
      return CCExHelpersCast::cast('CCExModelsInterval', $interval);
    }
  }

  /**
  * Builds the query to be used by the Interval model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('i.interval_id, i.collection_id, i.begin_year, i.duration, i.data_volume, i.number_copies, i.asset_unformatted_text, i.asset_word_processing, i.asset_spreadsheet, i.asset_graphics, i.asset_audio, i.asset_video, i.asset_hypertext, i.asset_geodata, i.asset_email, i.asset_database, i.asset_research_data, i.staff_min_size, i.staff_max_size');
    $query->from('#__ccex_interval as i');
    $query->order('i.begin_year');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {
    if(is_numeric($this->_interval_id)) {
      $query->where('i.interval_id = ' . (int) $this->_interval_id);
    }else{
      if(is_numeric($this->_collection_id)) {
        $query->where('i.collection_id = ' . (int) $this->_collection_id);
      }
    }

    return $query;
  }

  public function store($data=null) {    
    $data = $data ? $data : JRequest::get('post');
    $date = date("Y-m-d H:i:s");

    if(isset($data['data_volume_number'])){
      if(isset($data['data_volume_unit'])){
        $data['data_volume'] = $data['data_volume_number'] * $data['data_volume_unit'];
      }else{
        $data['data_volume'] = $data['data_volume_number'];
      }
    }

    $row_cost = JTable::getInstance('interval','Table');
    if (!$row_cost->bind($data)){ return false; }

    $row_cost->modified = $date;
    if (!$row_cost->check()){ return false; }
    if (!$row_cost->store()){ return false; }
    
    return true;
  }

  public function listItemsByCollection($collection_id){
    $this->set('_collection_id', $collection_id);
    return $this->listItems();
  }

  public function collection() {
    $collectionModel = new CCExModelsCollection();
    $collectionModel->set('collection_id', $this->collection_id);
    $collection = $collectionModel->getItem();
    
    return $collection;
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

  public function costs() {
    $costModel = new CCExModelsCost();
    $costs = $costModel->listItemsBy('_interval_id', $this->interval_id);

    return $costs;
  }

  public function sumCosts() {
    $sum = 0;
    foreach ($this->costs() as $cost) {
      $sum += $cost->cost;
    }

    return $sum;
  }

  public function formattedSumCosts() {
    return CCExHelpersTag::formatCurrencyWithSymbol($this->sumCosts(), $this->organization()->currency()->symbol);
  }

  public function sumCostsPerGB() {
    return $this->sumCosts() / $this->data_volume;
  }

  public function formattedSumCostsPerGB() {
    return sprintf('%s/GB', CCExHelpersTag::formatCurrencyWithSymbol($this->sumCostsPerGB(), $this->organization()->currency()->symbol));
  }

  public function percentageActivityMapping(){
    $sum = 0;
    $size = 0;
    foreach ($this->costs() as $cost) {
      $cost = CCExHelpersCast::cast('CCExModelsCost',  $cost);
      $sum += $cost->percentageActivityMapping();
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
    foreach ($this->costs() as $cost) {
      $cost = CCExHelpersCast::cast('CCExModelsCost',  $cost);
      $sum += $cost->percentageFinancialAccountingMapping();
      $size++;
    }

    if($size){
      return intval($sum/$size);
    }else{
      return 0;
    }
  }

  public function toString(){
    $string = $this->begin_year;

    if (isset($this->duration) && $this->duration > 1) {
      $string .= "-" . ($this->begin_year + $this->duration -1);
    }

    return $string;
  }

}
