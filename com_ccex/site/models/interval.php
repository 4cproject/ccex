<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsInterval extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_collection_id = null;
    protected $_interval_id = null;
    protected $_pagination = null;
    protected $_total = null;
    protected $_deleted = 0;
    
    function __construct() {
        parent::__construct();
    }
    
    public function getItem() {
        $interval = null;
        
        if (is_numeric($this->_interval_id)) {
            $interval = parent::getItem();
            
            if ($interval) {
                $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            }
        }
        
        if ($interval && $interval->havePermissions($this->_session_user_id)) {
            return $interval;
        }
        
        return null;
    }
    
    /**
     * Builds the query to be used by the Interval model
     * @return   object  Query object
     */
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('i.interval_id, i.collection_id, i.begin_year, i.duration, i.data_volume, i.number_copies, i.asset_unformatted_text, i.asset_word_processing, i.asset_spreadsheet, i.asset_graphics, i.asset_audio, i.asset_video, i.asset_hypertext, i.asset_geodata, i.asset_email, i.asset_database, i.staff');
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
        if (is_numeric($this->_interval_id)) {
            $query->where('i.interval_id = ' . (int)$this->_interval_id);
        } else {
            if (is_numeric($this->_collection_id)) {
                $query->where('i.collection_id = ' . (int)$this->_collection_id);
            }
        }
        
        $query->where('i.deleted = ' . (int)$this->_deleted);
        
        return $query;
    }
    
    /**
     * Override the default store
     *
     */
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        if (isset($data['data_volume_number'])) {
            if (isset($data['data_volume_unit'])) {
                $data['data_volume'] = $data['data_volume_number'] * $data['data_volume_unit'];
            } else {
                $data['data_volume'] = $data['data_volume_number'];
            }
        }
        
        $collectionModel = new CCExModelsCollection();
        
        if (!$data['begin_year'] || !$data['data_volume'] || !$data['duration'] || !$data['staff'] || !$data['collection_id'] || !$collectionModel->getItemBy("_collection_id", $data['collection_id'])) {
            return null;
        }
        
        $row_interval = JTable::getInstance('interval', 'Table');
        if (!$row_interval->bind($data)) {
            return null;
        }
        
        $row_interval->modified = $date;
        if (!$row_interval->check()) {
            return null;
        }
        if (!$row_interval->store()) {
            return null;
        }
        
        $return = array('interval_id' => $row_interval->interval_id);
        
        return $return;
    }
    
    /**
     * Delete a interval
     * @param int      ID of the interval to delete
     * @return boolean True if successfully deleted
     */
    public function delete($id = null) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('interval_id');
        
        $interval = JTable::getInstance('Interval', 'Table');
        $interval->load($id);
        
        $interval->deleted = 1;
        
        if ($interval->store()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function havePermissions($user_id) {
        if ($user_id && $this->collection() && $this->collection()->havePermissions($user_id)) {
            return true;
        }
        
        return false;
    }
    
    public function listItemsByCollection($collection_id) {
        $this->set('_collection_id', $collection_id);
        return $this->listItems();
    }
    
    public function collection() {
        $collectionModel = new CCExModelsCollection();
        $collectionModel->set('_collection_id', $this->collection_id);
        $collection = $collectionModel->getItem();
        
        return $collection;
    }
    
    public function dataVolume() {
        $result = new stdClass();
        $result->format = "Gigabytes";
        $result->value = 0;
        
        if (isset($this->data_volume)) {
            $datav = $this->data_volume;
            
            if ($datav >= 1048576) {
                $result->format = "Petabytes";
                $result->value = round($datav / 1048576);
            } elseif ($datav >= 1024) {
                $result->format = "Terabytes";
                $result->value = round($datav / 1024);
            } else {
                $result->value = round($datav);
            }
        }
        
        return $result;
    }
    
    public function formattedDataVolume() {
        $result = $this->dataVolume();
        
        return sprintf('%s %s', $result->value, $result->format);
    }
    
    public function formattedNumberOfCopies() {
        $nrCopies = "";
        
        if (is_numeric($this->number_copies)) {
            if ($this->number_copies == 1) {
                $nrCopies.= "One replica";
            } else {
                if ($this->number_copies == 0) {
                    $nrCopies.= "No";
                } else if ($this->number_copies == 2) {
                    $nrCopies.= "Two";
                } else if ($this->number_copies == 3) {
                    $nrCopies.= "Three";
                } else {
                    $nrCopies.= "More than three";
                }
                
                $nrCopies.= " replicas";
            }
        }
        
        return $nrCopies;
    }
    
    public function formattedStaff() {
        return $this->staff . " people";
    }
    
    public function costs() {
        $costModel = new CCExModelsCost();
        
        if (is_numeric($this->_interval_id)) {
            return $costModel->listItemsByInterval($this->_interval_id);
        } else if (is_numeric($this->interval_id)) {
            return $costModel->listItemsByInterval($this->interval_id);
        } else {
            return array();
        }
    }
    
    public function sumCosts() {
        $sum = 0;
        foreach ($this->costs() as $cost) {
            $sum+= $cost->cost;
        }
        
        return $sum;
    }
    
    public function formattedSumCosts() {
        return CCExHelpersTag::formatCurrencyWithSymbol($this->sumCosts(), $this->collection()->organization()->currency()->symbol);
    }
    
    public function sumCostsPerGB() {
        return $this->sumCosts() / $this->data_volume;
    }
    
    public function sumCostsPerYear() {
        return $this->sumCosts() / $this->duration;
    }
    
    public function sumCostsPerGBPerYear() {
        return $this->sumCostsPerGB() / $this->duration;
    }
    
    public function formattedSumCostsPerGB() {
        return sprintf('%s/GB', CCExHelpersTag::formatCurrencyWithSymbol($this->sumCostsPerGB(), $this->collection()->organization()->currency()->symbol));
    }
    
    public function formattedSumCostsPerYear() {
        return sprintf('%s/Y', CCExHelpersTag::formatCurrencyWithSymbol($this->sumCostsPerYear(), $this->collection()->organization()->currency()->symbol));
    }
    
    public function formattedSumCostsPerGBPerYear() {
        return sprintf('%s/GB·Y', CCExHelpersTag::formatCurrencyWithSymbol($this->sumCostsPerGBPerYear(), $this->collection()->organization()->currency()->symbol));
    }
    
    public function percentageActivityMapping() {
        $sum = 0;
        $size = 0;
        foreach ($this->costs() as $cost) {
            $cost = CCExHelpersCast::cast('CCExModelsCost', $cost);
            $sum+= $cost->percentageActivityMapping();
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
        foreach ($this->costs() as $cost) {
            $cost = CCExHelpersCast::cast('CCExModelsCost', $cost);
            $sum+= $cost->percentageFinancialAccountingMapping();
            $size++;
        }
        
        if ($size) {
            return intval($sum / $size);
        } else {
            return 0;
        }
    }
    
    public function toString() {
        $string = $this->begin_year;
        
        if (isset($this->duration) && $this->duration > 1) {
            $string.= "-" . ($this->begin_year + $this->duration - 1);
        }
        
        return $string;
    }
    
    public function duration() {
        return $this->duration;
    }
    
    public function costsPerGBPerYearOfCategories() {
        $categories = array("cat_hardware", "cat_software", "cat_external", "cat_producer", "cat_it_developer", "cat_support", "cat_analyst", "cat_manager", "cat_overhead", "cat_financial_accounting_other", "cat_production", "cat_ingest", "cat_storage", "cat_access", "cat_activities_other");
        $data = array();
        
        foreach ($categories as $category) {
            $data[$category] = 0;
        }
        
        foreach ($this->costs() as $cost) {
            $cost = CCExHelpersCast::cast('CCExModelsCost', $cost);
            
            foreach ($data as $key => $value) {
                $data[$key]+= ($cost->costOfCategory($key) / $this->data_volume) / $this->duration;
            }
        }
        
        return $data;
    }
}
