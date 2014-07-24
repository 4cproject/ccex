<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsOrganization extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_organization_id = null;
    protected $_user_id = null;
    protected $_name = null;
    protected $_pagination = null;
    protected $_total = null;
    protected $_deleted = 0;
    protected $_organizationBeginAndLastYear = null;
    protected $_global_comparison = null;
    
    function __construct() {
        parent::__construct();
    }
    
    public function getItem() {
        $organization = null;
        
        if (is_numeric($this->_organization_id) || is_numeric($this->_user_id)) {
            $organization = parent::getItem();
            
            if ($organization) {
                $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
            }
        }
        
        if ($organization && $organization->havePermissions($this->_session_user_id)) {
            return $organization;
        }
        
        return null;
    }
    
    /**
     * Builds the query to be used by the Organization model
     * @return   object  Query object
     */
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('o.organization_id, o.user_id , o.name, o.other_org_type, o.description, o.country_id, o.currency_id, o.global_comparison, o.peer_comparison, o.contact_and_sharing, o.snapshots');
        $query->from('#__ccex_organizations as o');
        
        return $query;
    }
    
    /**
     * Builds the filter for the query
     * @param    object  Query object
     * @return   object  Query object
     */
    protected function _buildWhere(&$query) {
        
        if (is_numeric($this->_organization_id)) {
            $query->where('o.organization_id = ' . (int)$this->_organization_id);
        } elseif (is_numeric($this->_user_id)) {
            $query->where('o.user_id = ' . (int)$this->_user_id);
        }
        
        if ($this->_global_comparison) {
            $query->where('o.global_comparison = 1');
        }
        
        $query->where('o.deleted = ' . (int)$this->_deleted);
        
        return $query;
    }
    
    /**
     * Override the default store
     *
     */
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $userModel = new CCExModelsUser();
        $data['organization']['user_id'] = $userModel->user_id;
        
        if (!$data['organization']['user_id'] || !$data['organization']['country_id'] || !$data['organization']['currency_id'] || !$data['organization']['name']) {
            return null;
        }
        
        $row_organization = JTable::getInstance('organization', 'Table');
        if (!$row_organization->bind($data['organization'])) {
            return null;
        }
        
        $row_organization->modified = $date;
        if (!$row_organization->check()) {
            return null;
        }
        if (!$row_organization->store()) {
            return null;
        }
        
        $organizationModel = new CCExModelsOrganization();
        $organization = $organizationModel->getItemBy('_organization_id', $row_organization->organization_id);
        
        $organization->removeAllTypes();
        if (array_key_exists('org_type', $data)) {
            $organization->addTypes($data['org_type']);
        }
        
        $return = array('organization_id' => $row_organization->organization_id);
        
        return $return;
    }
    
    public function havePermissions($user_id) {
        if ($user_id && $this->user_id == $user_id) {
            return true;
        }
        
        return false;
    }
    
    public function currency() {
        $currencyModel = new CCExModelsCurrency();
        $currency = $currencyModel->getItemBy('_currency_id', $this->currency_id);
        
        return $currency;
    }
    
    public function collections() {
        $collectionModel = new CCExModelsCollection();
        $collections = $collectionModel->listItemsBy('_organization_id', $this->organization_id);
        
        return $collections;
    }
    
    public function numberCollections() {
        return count($this->collections());
    }
    
    public function totalCost() {
        $cost = 0;
        
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $cost+= $collection->totalCost();
        }
        
        return $cost;
    }
    
    public function totalCostPerGB() {
        $cost = 0;
        
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $cost+= $collection->totalCostPerGB();
        }
        
        return $cost;
    }
    
    public function totalCostPerYear() {
        $cost = 0;
        
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $cost+= $collection->totalCostPerYear();
        }
        
        return $cost;
    }
    
    public function totalCostPerGBPerYear() {
        $cost = 0;
        
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $cost+= $collection->totalCostPerGBPerYear();
        }
        
        return $cost;
    }
    
    public function formattedSumCostPerGB() {
        return sprintf('%s/GB', CCExHelpersTag::formatCurrencyWithSymbol($this->totalCostPerGB(), $this->currency()->symbol));
    }
    
    public function formattedTotalCostPerYear() {
        return sprintf('%s/Y', CCExHelpersTag::formatCurrencyWithSymbol($this->totalCostPerYear(), $this->currency()->symbol));
    }
    
    public function formattedTotalCostPerGBPerYear() {
        return sprintf('%s/GB·Y', CCExHelpersTag::formatCurrencyWithSymbol($this->totalCostPerGBPerYear(), $this->currency()->symbol));
    }
    
    public function formattedTotalCost() {
        return CCExHelpersTag::formatCurrencyWithSymbol($this->totalCost(), $this->currency()->symbol);
    }
    
    public function totalDuration() {
        $duration = 0;
        
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $duration+= $collection->totalDuration();
        }
        
        return $duration;
    }
    
    public function intervals() {
        $intervals = array();
        
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $intervals = array_merge($intervals, $collection->intervals());
        }
        
        return $intervals;
    }
    
    public function numberIntervals() {
        $numberIntervals = 0;
        
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $numberIntervals+= $collection->numberIntervals();
        }
        
        return $numberIntervals;
    }
    
    public function percentageActivityMapping() {
        $sum = 0;
        $size = 0;
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $sum+= $collection->percentageActivityMapping();
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
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $sum+= $collection->percentageFinancialAccountingMapping();
            $size++;
        }
        
        if ($size) {
            return intval($sum / $size);
        } else {
            return 0;
        }
    }
    
    public function country() {
        $countryModel = new CCExModelsCountry();
        $country = $countryModel->getItemBy('_country_id', $this->country_id);
        
        return $country;
    }
    
    public function organizationOrgTypes() {
        $organizationOrgTypeModel = new CCExModelsOrganizationorgtype();
        $organizationOrgTypes = $organizationOrgTypeModel->listItemsBy('_organization_id', $this->organization_id);
        
        return $organizationOrgTypes;
    }
    
    public function types() {
        $organizationTypeModel = new CCExModelsOrganizationtype();
        $organizationTypes = array();
        
        foreach ($this->organizationOrgTypes() as $organizationOrgType) {
            array_push($organizationTypes, $organizationTypeModel->getItemBy('_org_type_id', $organizationOrgType->org_type_id));
        }
        
        return $organizationTypes;
    }
    
    public function isOfType($org_type_id) {
        foreach ($this->types() as $type) {
            if ($type->org_type_id == $org_type_id) {
                return true;
            }
        }
        
        return false;
    }
    
    public function removeAllTypes() {
        $organizationOrgTypeModel = new CCExModelsOrganizationorgtype();
        
        foreach ($this->organizationOrgTypes() as $type) {
            $organizationOrgTypeModel->delete($type->organization_org_type_id);
        }
    }
    
    public function addTypes($typeIds) {
        $organizationOrgTypeModel = new CCExModelsOrganizationorgtype();
        
        foreach ($typeIds as $typeId) {
            $data = array();
            $data['org_type_id'] = $typeId;
            $data['organization_id'] = $this->organization_id;
            
            $organizationOrgTypeModel->store($data);
        }
    }
    
    public function haveOtherType() {
        foreach ($this->types() as $type) {
            if ($type->name == "Other") {
                return true;
            }
        }
        
        return false;
    }

    public function haveType($type) {
        foreach ($this->types() as $orgType) {
            if ($orgType->org_type_id == $type) {
                return true;
            }
        }
        
        return false;
    }

    public function haveTypes($types) {
        $result = true;

        foreach ($types as $type) {
            if(!$this->haveType($type)){
                $push = false;
            }
        }

        return $result;
    }

    public function typesToString() {
        $string = "";
        $other = false;
        $types = $this->types();
        
        if ($types) {
            $string.= array_shift($types)->name;
            
            foreach ($types as $type) {
                if ($type->name == "Other") {
                    $other = true;
                } else {
                    $string.= ", " . $type->name;
                }
            }
            
            if ($other) {
                $string.= ", " . $this->other_org_type;
            }
        }
        
        return $string;
    }
    
    // B FIX THIS
    public function globalComparison() {
        if ($this->global_comparison) {
            return "Yes";
        } else {
            return "No";
        }
    }
    
    public function peerComparison() {
        if ($this->peer_comparison) {
            return "Yes";
        } else {
            return "No";
        }
    }
    
    public function contactAndSharing() {
        if ($this->contact_and_sharing) {
            return "Yes";
        } else {
            return "No";
        }
    }
    
    public function snapshots() {
        if ($this->snapshots) {
            return "Yes";
        } else {
            return "No";
        }
    }
    
    // E
    
    private function organizationBeginAndLastYear() {
        $intervals = $this->intervals();
        $firstInterval = array_shift($intervals);
        
        $beginYear = $firstInterval->begin_year;
        $lastYear = $beginYear + $firstInterval->duration;
        
        foreach ($intervals as $interval) {
            if ($interval->begin_year < $beginYear) {
                $beginYear = $interval->begin_year;
            }
            
            if (($interval->begin_year + $interval->duration - 1) > $lastYear) {
                $lastYear = $interval->begin_year + $interval->duration;
            }
        }
        
        return array("begin_year" => $beginYear, "last_year" => $lastYear);
    }
    
    private function collectionsBeginAndLastYear($collections) {
        $firstCollectionID = array_shift($collections);
        $collectionModel = new CCExModelsCollection();
        $collection = $collectionModel->getItemBy("_collection_id", $firstCollectionID);
        
        $beginAndLastYear = $collection->beginAndLastYear($collections);
        
        $beginYear = $beginAndLastYear["begin_year"];
        $lastYear = $beginAndLastYear["last_year"];
        
        foreach ($collections as $collectionID) {
            $collectionModel = new CCExModelsCollection();
            $collection = $collectionModel->getItemBy("_collection_id", $collectionID);
            
            if ($collection) {
                
                $beginAndLastYear = $collection->beginAndLastYear();
                
                if ($beginAndLastYear["begin_year"] < $beginYear) {
                    $beginYear = $beginAndLastYear["begin_year"];
                }
                
                if ($beginAndLastYear["last_year"] > $lastYear) {
                    $lastYear = $beginAndLastYear["last_year"];
                }
            }
        }
        
        return array("begin_year" => $beginYear, "last_year" => $lastYear);
    }
    
    public function beginAndLastYear($collections = array()) {
        if (count($collections)) {
            $beginAndLastYear = $this->collectionsBeginAndLastYear($collections);
        } else {
            if (!$this->_organizationBeginAndLastYear) {
                $this->_organizationBeginAndLastYear = $this->organizationBeginAndLastYear();
            }
            $beginAndLastYear = $this->_organizationBeginAndLastYear;
        }
        
        return $beginAndLastYear;
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

        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $dataVolume += $collection->dataVolume();
        }

        return $dataVolume;
    }
}
