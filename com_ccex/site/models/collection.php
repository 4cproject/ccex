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

    $row_cost = JTable::getInstance('collection','Table');
    if (!$row_cost->bind($data['collection'])){ return false; }

    $row_cost->modified = $date;
    if (!$row_cost->check()){ return false; }
    if (!$row_cost->store()){ return false; }
    
    return true;
  }

  public function organization() {
    $organizationModel = new CCExModelsOrganization();
    $organization = $organizationModel->getItemBy('_organization_id', $this->organization_id);

    return $organization;
  }

  public function intervals() {
    $intervalModel = new CCExModelsInterval();

    return $intervalModel->listItemsByCollection($this->_collection_id);
  }

  public function intervalsOrNewWithCurrentYear() {
    $intervals = $this->intervals();

    if(!$intervals){
      $newInterval = new CCExModelsInterval();
      $newInterval->set('collection_id', $this->_collection_id);
      $newInterval->set('begin_year', date("Y"));

      array_push($intervals, $newInterval);
    }
    
    return $intervals;
  }

  public function activeInterval() {
    $intervals = $this->intervalsOrNewWithCurrentYear();
    $activeInterval = array_shift($intervals);

    foreach ($intervals as $interval) {
      if($interval->begin_year > $activeInterval->begin_year){
        $activeInterval = $interval;
      }
    }

    return $activeInterval;
  }
}
