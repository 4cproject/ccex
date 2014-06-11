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

    $query->select('p.collection_id, p.organization_id, p.name, p.description, p.data_volume, p.number_copies, p.asset_unformatted_text, p.asset_word_processing, p.asset_spreadsheet, p.asset_graphics, p.asset_audio, p.asset_video, p.asset_hypertext, p.asset_geodata, p.asset_email, p.asset_database, p.asset_research_data, p.scope, p.staff_min_size, p.staff_max_size');
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

  public function organization() {
    $organizationModel = new CCExModelsOrganization();
    $organization = $organizationModel->getItemBy('_organization_id', $this->organization_id);

    return $organization;
  }

  public function costs() {
    $costModel = new CCExModelsCost();
    $costs = $costModel->listItemsBy('_collection_id', $this->collection_id);

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
}
