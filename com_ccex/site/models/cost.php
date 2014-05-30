<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsCost extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  var $_user_id         = null;
  var $_collection_id = null;
  var $_cost_id         = null;
  var $_pagination      = null;
  var $_total           = null;

  function __construct() {
    $app = JFactory::getApplication();

    $this->_cost_id = $app->input->get('id', null);
    $this->_user_id = JFactory::getUser()->id;
    
    parent::__construct();       
  }
 
  public function getItem() {
    $cost = parent::getItem();

    return $cost;
  }

  /**
  * Builds the query to be used by the Cost model
  * @return   object  Query object
  */
  protected function _buildQuery() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('c.cost_id, c.collection_id, c.name, c.description, c.cost, c.human_resources, c.cat_hardware, c.cat_software, c.cat_external, c.cat_producer, c.cat_it_developer, c.cat_support, c.cat_analyst, c.cat_manager, c.cat_overhead, c.cat_production, c.cat_ingest, c.cat_storage, c.cat_access');
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
      if(is_numeric($this->_collection_id)) {
        $query->where('c.collection_id = ' . (int) $this->_collection_id);
      }
    }

    return $query;
  }

  public function listItemsByCollection($collection_id){
    $this->set('_collection_id', $collection_id);
    return $this->listItems();
  }

  public function formattedCostwithCurrency() {
    return sprintf('%s %s', $this->formattedCost(), $this->Collection()->organization()->currency()->symbol);
  }

  public function formattedCost() {
    $number = sprintf('%.2f', $this->cost);  
    while (true) { 
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
        if ($replaced != $number) { 
            $number = $replaced; 
        } else { 
            break; 
        } 
    } 
    return $number; 
  }

  public function Collection() {
    $CollectionModel = new CCExModelsCollection();
    $CollectionModel->set('collection_id', $this->collection_id);
    $Collection = $CollectionModel->getItem();
    
    if($Collection){
      return CCExHelpersCast::cast('CCExModelsCollection', $Collection);
    }else{
      return null;
    }
  }

}
