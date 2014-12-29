<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsCollection extends CCExModelsDefault
{
    protected $_collection_id = null;
    protected $_organization_id = null;
    protected $_pagination = null;
    protected $_total = null;
    protected $_deleted = 0;
    protected $_final = null;
    protected $_assetTypes = null;
    
    function __construct() {
        $this->_assetTypes = array("asset_unformatted_text", "asset_word_processing", "asset_spreadsheet", "asset_graphics", "asset_audio", "asset_video", "asset_hypertext", "asset_geodata", "asset_email", "asset_database");
        
        parent::__construct();
    }
    
    public function getItem() {
        $collection = null;
        
        if (is_numeric($this->_collection_id)) {
            $collection = parent::getItem();
            
            if ($collection) {
                $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            }
        }
        
        if ($collection && $collection->havePermissions($this->_session_user_id)) {
            return $collection;
        }
        
        return null;
    }
    
    public function getItemUnrestricted() {
        $collection = null;
        
        if (is_numeric($this->_collection_id)) {
            $collection = parent::getItem();
            
            if ($collection) {
                $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            }
        }
        
        return $collection;
    }
    
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('p.collection_id, p.organization_id, p.name, p.description, p.scope, p.final');
        $query->from('#__ccex_collections as p');
        
        return $query;
    }
    
    protected function _buildWhere(&$query) {
        if (is_numeric($this->_collection_id)) {
            $query->where('p.collection_id = ' . $this->_collection_id);
        } else if ($this->_organization_id) {
            $query->where('p.organization_id = ' . $this->_organization_id);
        }
        
        if ($this->_final) {
            $query->where('p.final = 1');
        }
        
        $query->where('p.deleted = ' . (int)$this->_deleted);
        
        return $query;
    }
    
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $organizationModel = new CCExModelsOrganization();
        $row_collection = JTable::getInstance('collection', 'Table');
        
        if (!$data['collection']['name'] || !$data['collection']['scope'] || !$data['collection']['organization_id'] || !$organizationModel->getItemBy("_organization_id", $data['collection']['organization_id']) || !$row_collection->bind($data['collection'])) {
            return null;
        }
        
        $row_collection->modified = $date;
        if (!$row_collection->check() || !$row_collection->store()) {
            return null;
        }
        
        $data['interval']['collection_id'] = $row_collection->collection_id;
        
        $intervalModel = new CCExModelsInterval();
        $result = $intervalModel->store($data['interval']);
        if (!$result) {
            return null;
        }
        
        $return = array('collection_id' => $row_collection->collection_id);
        foreach ($result as $key => $value) {
            $return[$key] = $value;
        }
        
        return $return;
    }
    
    public function delete($id = null, $update = true) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('collection_id');
        
        $collectionModel = new CCExModelsCollection();
        $collection = $collectionModel->getItemUnrestrictedBy("_collection_id", $id);
        
        $collectionTable = JTable::getInstance('Collection', 'Table');
        $collectionTable->load($id);
        $collectionTable->deleted = 1;
        
        if ($collectionTable->store()) {
            $collection->deleteIntervals(false);
            
            if ($update) {
                $collection->updateFinalStatus();
            }
            
            return true;
        } else {
            return false;
        }
    }
    
    public function switchFinal($final) {
        $app = JFactory::getApplication();
        $id = $this->collection_id;
        
        $collectionModel = new CCExModelsCollection();
        $collection = $collectionModel->getItemBy("_collection_id", $id);
        
        $collectionTable = JTable::getInstance('Collection', 'Table');
        $collectionTable->load($id);
        $collectionTable->final = $final;
        
        if ($collectionTable->store()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteIntervals($update = true) {
        $intervalModel = new CCExModelsInterval();
        
        foreach ($this->intervals() as $interval) {
            $intervalModel->delete($interval->interval_id, $update);
        }
    }
    
    public function havePermissions($user_id) {
        if ($user_id && $this->organization() && $this->organization()->havePermissions($user_id)) {
            return true;
        }
        
        return false;
    }
    
    public function organization() {
        $organizationModel = new CCExModelsOrganization();
        return $organizationModel->getItemUnrestrictedBy('_organization_id', $this->organization_id);
    }
    
    public function intervals() {
        $intervalModel = new CCExModelsInterval();
        
        if (is_numeric($this->_collection_id)) {
            return $intervalModel->listItemsByCollection($this->_collection_id);
        } else if (isset($this->collection_id)) {
            return $intervalModel->listItemsByCollection($this->collection_id);
        }
        
        return array();
    }
    
    public function costs() {
        $costs = array();
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $costs = array_merge($costs, $interval->costs());
        }
        
        return $costs;
    }
    
    public function nonEmptyInvervals() {
        $intervals = array();
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            if ($interval->haveCosts()) {
                array_push($intervals, $interval);
            }
        }
        
        return $intervals;
    }
    
    public function haveCosts() {
        return count($this->nonEmptyInvervals());
    }
    
    public function updateFinalStatus() {
        if ($this->haveCosts()) {
            $this->switchFinal(1);
        } else {
            $this->switchFinal(0);
        }
    }
    
    public function numberIntervals() {
        return count($this->intervals());
    }
    
    public function intervalsWithoutLast() {
        return array_slice($this->intervals(), 0, -1);
    }
    
    public function lastInterval() {
        return CCExHelpersCast::cast('CCExModelsInterval', end($this->intervals()));
    }
    
    public function newInterval() {
        $newInterval = new CCExModelsInterval();
        $newInterval->set('collection_id', $this->_collection_id);
        
        if ($this->numberIntervals()) {
            $lastInterval = $this->lastInterval();
            $newYear = $lastInterval->begin_year + $lastInterval->duration;
        } else {
            $newYear = date("Y");
        }
        
        $newInterval->set('begin_year', $newYear);
        
        return $newInterval;
    }
    
    public function activeInterval($intervalID) {
        if ($intervalID) {
            $intervalModel = new CCExModelsInterval();
            return $intervalModel->getItemBy('_interval_id', $intervalID);
        } else {
            return $this->lastInterval();
        }
    }
    
    public function beginAndLastYear() {
        $intervals = $this->intervals();
        $firstInterval = array_shift($intervals);
        
        $beginYear = $firstInterval->begin_year;
        $lastYear = $beginYear + $firstInterval->duration - 1;
        
        foreach ($intervals as $interval) {
            if ($interval->begin_year < $beginYear) {
                $beginYear = $interval->begin_year;
            }
            
            if (($interval->begin_year + $interval->duration) > $lastYear) {
                $lastYear = $interval->begin_year + $interval->duration - 1;
            }
        }
        
        return array("begin_year" => $beginYear, "last_year" => $lastYear);
    }
    
    public function years() {
        $yearsHash = array();
        $intervals = $this->intervals();
        
        foreach ($intervals as $interval) {
            $beginYear = $interval->begin_year;
            $endYear = $beginYear + $interval->duration;
            
            for ($year = $beginYear; $year < $endYear; $year++) {
                if (!array_key_exists($year, $yearsHash)) {
                    $yearsHash[$year] = array();
                }
                array_push($yearsHash[$year], $interval);
            }
        }
        
        krsort($yearsHash, SORT_NUMERIC);
        return $yearsHash;
    }
    
    public function intervalsOfYear($year = "all") {
        $intervals = array();
        $allIntervals = $this->intervals();
        
        if ($year == "all" || !is_numeric($year)) {
            $intervals = $allIntervals;
        } else {
            foreach ($allIntervals as $interval) {
                $year = intval($year);
                
                $beginYear = $interval->begin_year;
                $endYear = $interval->begin_year + $interval->duration - 1;
                
                if ($year >= $beginYear && $year <= $endYear) {
                    array_push($intervals, $interval);
                }
            }
        }
        
        return $intervals;
    }
    
    public function dataVolumePonderedAverage() {
        $dividend = 0;
        $divisor = 0;
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $dividend+= $interval->data_volume * $interval->duration;
            $divisor+= $interval->duration;
        }
        
        return $dividend / $divisor;
    }
    
    public function staffPonderedAverage() {
        $dividend = 0;
        $divisor = 0;
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $dividend+= $interval->staff * $interval->duration;
            $divisor+= $interval->duration;
        }
        
        return $dividend / $divisor;
    }
    
    public function numberOfCopiesPonderedAverage() {
        $dividend = 0;
        $divisor = 0;
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $dividend+= $interval->number_copies * $interval->duration;
            $divisor+= $interval->duration;
        }
        
        return $dividend / $divisor;
    }
    
    public function mainAsset() {
        $assetTypes = array();
        $divisor = 0;
        $mainValue = 0;
        $main = null;
        
        foreach ($this->_assetTypes as $assetType) {
            $assetTypes[$assetType] = 0;
        }
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            
            foreach ($this->_assetTypes as $assetType) {
                $assetTypes[$assetType]+= $interval->get($assetType, 0) * $interval->duration;
            }
            
            $divisor+= $interval->duration;
        }
        
        foreach ($assetTypes as $assetType => $value) {
            $realValue = $value / $divisor;
            
            if ($realValue > $mainValue) {
                $mainValue = $realValue;
                $main = $assetType;
            }
        }
        
        return $main;
    }

    public function numberOfIntervals() {
        return count($this->intervals());
    }

    public function numberOfCosts() {
        return count($this->costs());
    }

    public function currency(){
        return $this->organization()->currency();
    }

    public function sumCosts() {
        $sum = 0;
        foreach ($this->costs() as $cost) {
            $sum+= $cost->cost;
        }
        
        return $sum;
    }

    public function formattedSumCosts() {
        return sprintf('%s', CCExHelpersTag::formatCurrencyWithSymbol($this->sumCosts(), $this->currency()->symbol));
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
}
