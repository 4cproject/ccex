<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsCollection extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_collection_id = null;
    protected $_organization_id = null;
    protected $_pagination = null;
    protected $_total = null;
    protected $_deleted = 0;
    
    function __construct() {
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
        
        if (is_numeric($this->_collection_id)) {
            $query->where('p.collection_id = ' . (int)$this->_collection_id);
        } else {
            if ($this->_organization_id) {
                $query->where("p.organization_id = '" . $this->_organization_id . "'");
            }
        }
        
        $query->where('p.deleted = ' . (int)$this->_deleted);
        
        return $query;
    }
    
    /**
     * Override the default store
     *
     */
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $organizationModel = new CCExModelsOrganization();
        
        if (!$data['collection']['name'] || !$data['collection']['scope'] || !$data['collection']['organization_id'] || !$organizationModel->getItemBy("_organization_id", $data['collection']['organization_id'])) {
            return null;
        }
        
        $row_collection = JTable::getInstance('collection', 'Table');
        if (!$row_collection->bind($data['collection'])) {
            return null;
        }
        
        $row_collection->modified = $date;
        if (!$row_collection->check()) {
            return null;
        }
        if (!$row_collection->store()) {
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
    
    /**
     * Delete a collection
     * @param int      ID of the collection to delete
     * @return boolean True if successfully deleted
     */
    public function delete($id = null) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('collection_id');
        
        $collection = JTable::getInstance('Collection', 'Table');
        $collection->load($id);
        
        $collection->deleted = 1;
        
        if ($collection->store()) {
            return true;
        } else {
            return false;
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
        $organization = $organizationModel->getItemBy('_organization_id', $this->organization_id);
        
        return $organization;
    }
    
    public function intervals() {
        $intervalModel = new CCExModelsInterval();
        
        if (is_numeric($this->_collection_id)) {
            return $intervalModel->listItemsByCollection($this->_collection_id);
        } else if (isset($this->collection_id)) {
            return $intervalModel->listItemsByCollection($this->collection_id);
        } else {
            return array();
        }
    }
    
    public function numberIntervals() {
        return count($this->intervals());
    }
    
    public function totalDuration() {
        $duration = 0;
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $duration+= $interval->duration();
        }
        
        return $duration;
    }
    
    public function totalCost() {
        $cost = 0;
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $cost+= $interval->sumCosts();
        }
        
        return $cost;
    }
    
    public function totalCostPerGB() {
        $cost = 0;
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $cost+= $interval->sumCostsPerGB();
        }
        
        return $cost;
    }
    
    public function totalCostPerYear() {
        $cost = 0;
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $cost+= $interval->sumCostsPerYear();
        }
        
        return $cost;
    }
    
    public function totalCostPerGBPerYear() {
        $cost = 0;
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $cost+= $interval->sumCostsPerGBPerYear();
        }
        
        return $cost;
    }
    
    public function percentageActivityMapping() {
        $sum = 0;
        $size = 0;
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $sum+= $interval->percentageActivityMapping();
            $size++;
        }
        
        if ($size) {
            return intval($sum / $size);
        } else {
            return 0;
        }
    }
    
    public function percentageFinancialAccountingMapping() {
        $sum = 0;
        $size = 0;
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $sum+= $interval->percentageFinancialAccountingMapping();
            $size++;
        }
        
        if ($size) {
            return intval($sum / $size);
        } else {
            return 0;
        }
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
        
        if ($this->numberIntervals() > 1) {
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
        $lastYear = $beginYear + $firstInterval->duration;
        
        foreach ($intervals as $interval) {
            if ($interval->begin_year < $beginYear) {
                $beginYear = $interval->begin_year;
            }
            
            if (($interval->begin_year + $interval->duration) > $lastYear) {
                $lastYear = $interval->begin_year + $interval->duration;
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

    public function intervalsOfYear($year="all") {
        $intervals = array();
        $allIntervals = $this->intervals();

        if($year=="all" || !is_numeric($year)){
            $intervals = $allIntervals;
        }else{
            foreach ($allIntervals as $interval) {
                $year = intval($year);

                $beginYear = $interval->begin_year;
                $endYear = $interval->begin_year + $interval->duration - 1; 

                if($year >= $beginYear && $year <= $endYear){
                    array_push($intervals, $interval);
                }
            }
        }

        return $intervals;
    }

    public function dataVolume(){
        $dataVolume = 0;

        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $dataVolume += $interval->data_volume;
        }

        return $dataVolume;
    }
}
