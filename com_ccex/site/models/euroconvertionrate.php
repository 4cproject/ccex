<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsEuroconvertionrate extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_euro_convertion_id = null;
    protected $_hash = null;
    protected $_pagination = null;
    protected $_total = null;
    
    function __construct() {
        parent::__construct();
    }
    
    public function getItem() {
        if (!is_numeric($this->_euro_convertion_id)) {
            return null;
        }
        
        $euroConvertionRate = parent::getItem();
        
        if ($euroConvertionRate) {
            return CCExHelpersCast::cast('CCExModelsEuroconvertionrate', $euroConvertionRate);
        }
    }
    
    /**
     * Builds the query to be used by the EuroConvertionRate model
     * @return   object  Query object
     */
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('t.euro_convertion_id, t.code, t.year', 't.tax');
        $query->from('#__ccex_euro_convertion_rates as t');
        $query->order('t.year');
        
        return $query;
    }
    
    /**
     * Builds the filter for the query
     * @param    object  Query object
     * @return   object  Query object
     */
    protected function _buildWhere(&$query) {
        
        if (is_numeric($this->_org_type_id)) {
            $query->where('t.euro_convertion_id = ' . (int)$this->_euro_convertion_id);
        }
        
        return $query;
    }
    
    /**
     * Override the default store
     *
     */
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $row_euro_convertion_rate = JTable::getInstance('euroconvertionrate', 'Table');
        if (!$row_euro_convertion_rate->bind($data)) {
            return null;
        }
        
        $row_euro_convertion_rate->modified = $date;
        if (!$row_euro_convertion_rate->check()) {
            return null;
        }
        if (!$row_euro_convertion_rate->store()) {
            return null;
        }
        
        return true;
    }
    
    /**
     * Delete a EuroConvertionRate
     * @param int      ID of the EuroConvertionRate to delete
     * @return boolean True if successfully deleted
     */
    public function delete($id = null) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('euro_convertion_id');
        
        if ($id) {
            $euroConvertionRate = JTable::getInstance('euroconvertionrate', 'Table');
            $euroConvertionRate->load($id);
            
            if ($euroConvertionRate->delete()) {
                return true;
            }
        }
        
        return false;
    }

    public function toHash() {
        $hash = array();
        $convertionRates = $this->listItems();

        foreach ($convertionRates as $rate) {
            $hash[$rate->code][$rate->year] = $rate->tax;
        }

        return $hash;
    }

    public function taxOnYear($code, $year){
        $this->generateHash();
        $tax = 1;

        if(array_key_exists($code, $this->_hash) && count($this->_hash[$code])){
            if(array_key_exists($year, $this->_hash[$code])){
                $tax = $this->_hash[$code][$year];
            }else{
                $firstYear = key(reset($this->_hash[$code]));
                $lastYear = key(end($this->_hash[$code]));

                if($year < $firstYear){
                    $tax = $this->_hash[$code][$firstYear];
                }else{
                    $tax = $this->_hash[$code][$lastYear];
                }
            }
        } 

        return $tax;
    }

    public function taxOnInterval($code, $year, $duration){
        $sum = 0;

        for ($i=0; $i < $duration; $i++) { 
            $sum += $this->taxOnYear($code, $year + $i);
        }

        return $sum/(float)$duration;
    }

    private function generateHash(){
        if(!$this->_hash){
            $euroConvertionRateModel = new CCExModelsEuroconvertionrate(); 
            $this->_hash = $euroConvertionRateModel->toHash();
        }
    }
}
