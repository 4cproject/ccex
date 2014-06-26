<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsCost extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_user_id         = null;
  var $_interval_id = null;
  var $_cost_id         = null;
  var $_pagination      = null;
  var $_total           = null;

  function __construct() {
    $app = JFactory::getApplication();

    $this->_cost_id = $app->input->get('cost_id', null);
    
    parent::__construct();       
  }
 
  public function getItem() {
    $cost = parent::getItem();

    if($cost){
      return CCExHelpersCast::cast('CCExModelsCost', $cost);
    }
  }

  /**
  * Builds the query to be used by the Cost model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('c.cost_id, c.interval_id, c.name, c.description, c.cost, c.human_resources, c.cat_hardware, c.cat_software, c.cat_external, c.cat_producer, c.cat_it_developer, c.cat_support, c.cat_analyst, c.cat_manager, c.cat_overhead, c.cat_production, c.cat_ingest, c.cat_storage, c.cat_access');
    $query->from('#__ccex_costs as c');

    return $query;
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  */
  protected function _buildWhere(&$query) {
    if(is_numeric($this->_cost_id)) {
      $query->where('c.cost_id = ' . (int) $this->_cost_id);
    }else{
      if(is_numeric($this->_interval_id)) {
        $query->where('c.interval_id = ' . (int) $this->_interval_id);
      }
    }

    return $query;
  }

  public function store($data=null) {    
    $data = $data ? $data : JRequest::get('post');
    $date = date("Y-m-d H:i:s");

    $row_cost = JTable::getInstance('cost','Table');
    if (!$row_cost->bind($data['cost'])){ return false; }

    $row_cost->modified = $date;
    if (!$row_cost->check()){ return false; }
    if (!$row_cost->store()){ return false; }
    
    $return = array('cost_id' => $row_cost->cost_id);

    return $return;
  }

  public function listItemsByInterval($interval_id){
    $this->set('_interval_id', $interval_id);
    return $this->listItems();
  }

  public function formattedCost() {
    return CCExHelpersTag::formatCurrencyWithSymbol($this->cost, $this->interval()->collection()->organization()->currency()->symbol);
  }

  public function interval() {
    $intervalModel = new CCExModelsInterval();
    $intervalModel->set('_interval_id', $this->interval_id);
    $interval = $intervalModel->getItem();
    
    return $interval;
  }

  public function costPerGB(){
    return $this->cost / $this->interval()->data_volume;
  }

  public function costPerYear(){
    return $this->cost / $this->interval()->duration;
  }

    public function costPerGBPerYear(){
    return $this->costPerGB() / $this->interval()->duration;
  }

  public function formattedCostPerGB() {
    return sprintf('%s/GB', CCExHelpersTag::formatCurrencyWithSymbol($this->costPerGB(), $this->interval()->collection()->organization()->currency()->symbol));
  }

  public function formattedCostPerYear() {
    return sprintf('%s/Y', CCExHelpersTag::formatCurrencyWithSymbol($this->costPerYear(), $this->interval()->collection()->organization()->currency()->symbol));
  }

  public function formattedCostPerGBPerYear() {
    return sprintf('%s/GB·Y', CCExHelpersTag::formatCurrencyWithSymbol($this->costPerGBPerYear(), $this->interval()->collection()->organization()->currency()->symbol));
  }

  public function percentageActivityMapping(){
    return $this->cat_hardware + $this->cat_software + $this->cat_external + $this->cat_producer + $this->cat_it_developer + $this->cat_support + $this->cat_analyst + $this->cat_manager + $this->cat_overhead;
  }

  public function percentageFinancialAccountingMapping(){
    return $this->cat_production + $this->cat_ingest + $this->cat_storage + $this->cat_access;
  }

}
