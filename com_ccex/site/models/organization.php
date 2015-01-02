<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsOrganization extends CCExModelsDefault
{
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
    
    public function getItemUnrestricted() {
        $organization = null;
        
        if (is_numeric($this->_organization_id) || is_numeric($this->_user_id)) {
            $organization = parent::getItem();
            
            if ($organization) {
                $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
            }
        }
        
        return $organization;
    }
    
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('o.organization_id, o.user_id , o.name, o.other_org_type, o.description, o.country_id, o.currency_id, o.global_comparison, o.organization_linked, o.peer_comparison, o.contact_and_sharing, o.snapshots');
        $query->from('#__ccex_organizations as o');
        
        return $query;
    }
    
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
        if (!$row_organization->check() || !$row_organization->store()) {
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
    
    public function delete($id = null, $update = true) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('organization_id');
        
        $organizationModel = new CCExModelsOrganization();
        $organization = $organizationModel->getItemUnrestrictedBy("_organization_id", $id);
        
        $organizationTable = JTable::getInstance('Organization', 'Table');
        $organizationTable->load($id);
        $organizationTable->deleted = 1;
        
        if ($organizationTable->store()) {
            $organization->deleteCollections();
            
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteCollections($update = true) {
        $collectionModel = new CCExModelsCollection();
        
        foreach ($this->collections() as $collection) {
            $collectionModel->delete($collection->collection_id, $update);
        }
    }
    
    public function havePermissions($user_id) {
        if ($user_id && $this->user_id == $user_id) {
            return true;
        }
        
        return false;
    }
    
    public function currency() {
        $currencyModel = new CCExModelsCurrency();
        return $currencyModel->getItemUnrestrictedBy('_currency_id', $this->currency_id);
    }
    
    public function collections() {
        $collectionModel = new CCExModelsCollection();
        $collections = $collectionModel->listItemsBy('_organization_id', $this->organization_id);
        return $collections;
    }
    
    public function finalCollections() {
        $collectionModel = new CCExModelsCollection();
        $collectionModel->set("_final", true);
        $collections = $collectionModel->listItemsBy('_organization_id', $this->organization_id);
        return $collections;
    }
    
    public function finalAndNonEmptyCollections() {
        $collections = array();
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            if ($collection->haveCosts()) {
                array_push($collections, $collection);
            }
        }
        
        return $collections;
    }
    
    public function numberCollections() {
        return count($this->collections());
    }
    
    public function intervals() {
        $intervals = array();
        
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $intervals = array_merge($intervals, $collection->intervals());
        }
        
        return $intervals;
    }

    public function totalCost(){
        $cost = 0;
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
            $cost += $collection->totalCost();
        }
        return $cost;
    }

    public function totalCostPerGB() {
        $cost = 0;
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
            $cost += $collection->totalCostPerGB();
        }
        return $cost;
    }

    public function totalCostPerYear() {
        $cost = 0;
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
            $cost += $collection->totalCostPerYear();
        }
        return $cost;
    }

    public function totalCostPerGBPerYear() {
        $cost = 0;
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
            $cost += $collection->totalCostPerGBPerYear();
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
    
    public function totalDuration(){
        $duration = 0;
        foreach ($this->collections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection);
            $duration += $collection->totalDuration();
        }
        return $duration;
    }
    
    public function costs() {
        $costs = array();
        
        foreach ($this->intervals() as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $costs = array_merge($costs, $interval->costs());
        }
        
        return $costs;
    }

    public function numberOfCosts(){
        return count($this->costs());
    }
    
    public function finalIntervals() {
        $intervals = array();
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $intervals = array_merge($intervals, $collection->intervals());
        }
        
        return $intervals;
    }
    
    public function finalAndNonEmptyIntervals() {
        $intervals = array();
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $intervals = array_merge($intervals, $collection->nonEmptyInvervals());
        }
        
        return $intervals;
    }
    
    public function readyForComparison() {
        return count($this->finalAndNonEmptyIntervals());
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
            if (!$this->haveType($type)) {
                $result = false;
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
    
    private function organizationBeginAndLastYear($filter) {
        if($filter && $filter == "final"){
            $intervals = $this->finalIntervals();
        }else{
            $intervals = $this->intervals();
        }

        $firstInterval = array_shift($intervals);
        
        if ($firstInterval) {
            $beginYear = $firstInterval->begin_year;
            $lastYear = $beginYear + $firstInterval->duration - 1;
            
            foreach ($intervals as $interval) {
                if ($interval->begin_year < $beginYear) {
                    $beginYear = $interval->begin_year;
                }
                
                if (($interval->begin_year + $interval->duration - 1) > $lastYear) {
                    $lastYear = $interval->begin_year + $interval->duration - 1;
                }
            }
        } else {
            $beginYear = date("Y");
            $lastYear = date("Y") + 1;
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
    
    public function beginAndLastYear($collections = array(), $filter = null) {
        if (count($collections)) {
            $beginAndLastYear = $this->collectionsBeginAndLastYear($collections);
        } else {
            if (!$this->_organizationBeginAndLastYear) {
                $this->_organizationBeginAndLastYear = $this->organizationBeginAndLastYear($filter);
            }
            $beginAndLastYear = $this->_organizationBeginAndLastYear;
        }
        
        return $beginAndLastYear;
    }
    
    public function years($filter = null) {
        $yearsHash = array();
        
        if ($filter && $filter == "final") {
            $intervals = $this->finalIntervals();
        } else {
            $intervals = $this->intervals();
        }
        
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
    
    public function finalIntervalsOfYear($year = "all") {
        $intervals = array();
        $allIntervals = $this->finalIntervals();
        
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
    
    public function dataVolumeToString() {
        $result = new stdClass();
        $result->format = "Gigabytes";
        $result->value = 0;
        
        $datav = $this->dataVolumePonderedAverage();
        
        if ($datav >= 1048576) {
            $result->format = "Petabytes";
            $result->value = round($datav / 1048576);
        } elseif ($datav >= 1024) {
            $result->format = "Terabytes";
            $result->value = round($datav / 1024);
        } else {
            $result->value = round($datav);
        }
        
        return $result->value . " " . $result->format;
    }
    
    public function dataVolumePonderedAverage() {
        $dividend = 0;
        $divisor = 0;
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $nrYears = count($collection->years());
            
            $dividend+= $collection->dataVolumePonderedAverage() * $nrYears;
            $divisor+= $nrYears;
        }
        
        if ($divisor > 0) {
            return $dividend / $divisor;
        } else {
            return 0;
        }
    }
    
    public function dataVolumePonderedStandardDeviation() {
        $data = array();
        $std_dev = 0;
        $n = 0;
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $nrYears = count($collection->years());
            
            $data[$collection->dataVolumePonderedAverage() ] = $nrYears;
            $n+= $nrYears;
        }
        
        foreach ($data as $value => $count) {
            $std_dev+= ($count * pow($value - $this->dataVolumePonderedAverage(), 2));
        }
        
        if ($n < 2) {
            $std_dev = 0;
        } else {
            $std_dev = sqrt($std_dev / ($n - 1));
        }
        
        return $std_dev;
    }
    
    public function validDataVolumePonderedAverage() {
        $configurationModel = new CCExModelsConfiguration();
        
        if ($this->dataVolumePonderedAverage()) {
            return ($this->dataVolumePonderedStandardDeviation() / $this->dataVolumePonderedAverage()) <= $configurationModel->configurationValue("maximum_ratio_valid_global_comparison", 0.3);
        } else {
            return true;
        }
    }
    
    public function staffPonderedAverage() {
        $dividend = 0;
        $divisor = 0;
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $nrYears = count($collection->years());
            
            $dividend+= $collection->staffPonderedAverage() * $nrYears;
            $divisor+= $nrYears;
        }
        
        if ($divisor > 0) {
            return $dividend / $divisor;
        } else {
            return 0;
        }
    }
    
    public function staffPonderedStandardDeviation() {
        $data = array();
        $std_dev = 0;
        $n = 0;
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $nrYears = count($collection->years());
            
            $data[$collection->staffPonderedAverage() ] = $nrYears;
            $n+= $nrYears;
        }
        
        foreach ($data as $value => $count) {
            $std_dev+= ($count * pow($value - $this->staffPonderedAverage(), 2));
        }
        
        if ($n < 2) {
            $std_dev = 0;
        } else {
            $std_dev = sqrt($std_dev / ($n - 1));
        }
        
        return $std_dev;
    }
    
    public function validStaffPonderedAverage() {
        $configurationModel = new CCExModelsConfiguration();
        
        if ($this->staffPonderedAverage()) {
            return ($this->staffPonderedStandardDeviation() / $this->staffPonderedAverage()) <= $configurationModel->configurationValue("maximum_ratio_valid_global_comparison", 0.3);
        } else {
            return true;
        }
    }
    
    public function numberOfCopiesPonderedAverage() {
        $dividend = 0;
        $divisor = 0;
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $nrYears = count($collection->years());
            
            $dividend+= $collection->numberOfCopiesPonderedAverage() * $nrYears;
            $divisor+= $nrYears;
        }
        
        if ($divisor > 0) {
            return $dividend / $divisor;
        } else {
            return 0;
        }
    }
    
    public function numberOfCopiesPonderedStandardDeviation() {
        $data = array();
        $std_dev = 0;
        $n = 0;
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $nrYears = count($collection->years());
            
            $data[$collection->numberOfCopiesPonderedAverage() ] = $nrYears;
            $n+= $nrYears;
        }
        
        foreach ($data as $value => $count) {
            $std_dev+= ($count * pow($value - $this->numberOfCopiesPonderedAverage(), 2));
        }
        
        if ($n < 2) {
            $std_dev = 0;
        } else {
            $std_dev = sqrt($std_dev / ($n - 1));
        }
        
        return $std_dev;
    }
    
    public function validNumberOfCopiesPonderedAverage() {
        $configurationModel = new CCExModelsConfiguration();
        
        if ($this->numberOfCopiesPonderedAverage()) {
            return ($this->numberOfCopiesPonderedStandardDeviation() / $this->numberOfCopiesPonderedAverage()) <= $configurationModel->configurationValue("maximum_ratio_valid_global_comparison", 0.3);
        } else {
            return true;
        }
    }
    
    public function typeMatch($types) {
        $match = 0;
        $total = 0;
        
        foreach ($types as $type) {
            if ($type->name != "Other") {
                if ($this->haveType($type->org_type_id)) {
                    $match++;
                }
                $total++;
            }
        }

        if ($total == 0) {
            return 0;
        } else {
            return $match / (float)$total;
        }
    }
    
    public function scopesMatch($scopes) {
        $match = 0;
        $total = 0;
        $myScopes = $this->scopes();
        
        foreach ($scopes as $scope) {
            if (in_array($scope, $myScopes)) {
                $match++;
            }
            $total++;
        }
        
        if ($total == 0) {
            return 0;
        } else {
            return $match / (float)$total;
        }
    }
    
    public function mainAssetsMatch($mainAssets) {
        $match = 0;
        $total = 0;
        $myMainAssets = $this->mainAssets();
        
        foreach ($mainAssets as $mainAsset) {
            if (in_array($mainAsset, $myMainAssets)) {
                $match++;
            }
            $total++;
        }
        
        if ($total == 0) {
            return 0;
        } else {
            return $match / (float)$total;
        }
    }
    
    public function scopes() {
        $scopes = array();
        
        foreach ($this->finalCollections() as $collection) {
            $scopes[$collection->scope] = true;
        }
        
        return array_keys($scopes);
    }
    
    public function mainAssets() {
        $mainAssets = array();
        
        foreach ($this->finalCollections() as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            $mainAssets[$collection->mainAsset() ] = true;
        }
        
        return array_keys($mainAssets);
    }
    
    public function organizationsForGlobalComparison() {
        $organizationModel = new CCExModelsOrganization();
        $organizationModel->set("_global_comparison", true);
        $organizations = $organizationModel->listItems();
        $userModel = new CCExModelsUser();
        $userOrganization = $userModel->organization();
        $result = array();
        
        foreach ($organizations as $organization) {
            if (!$userOrganization || $userOrganization->organization_id != $organization->organization_id) {
                $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
                
                if ($organization->readyForComparison()) {
                    array_push($result, $organization);
                }
            }
        }
        
        return $result;
    }
    
    public function organizationsForPeerComparison() {
        $organizationModel = new CCExModelsOrganization();
        $organizationModel->set("_peer_comparison", true);
        $organizations = $organizationModel->listItems();
        $userModel = new CCExModelsUser();
        $userOrganization = $userModel->organization();
        $result = array();
        
        foreach ($organizations as $organization) {
            if (!$userOrganization || $userOrganization->organization_id != $organization->organization_id) {
                $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
                
                if ($organization->readyForComparison()) {
                    array_push($result, $organization);
                }
            }
        }
        
        return $result;
    }
    
    public function user() {
        $table = JUser::getTable();
        
        if ($table->load($this->user_id)) {
            return JFactory::getUser($this->user_id);
        } else {
            return null;
        }
    }
    
    public function existsOrganizationsOfType($org_type_id) {
        $result = false;
        $organizationModel = new CCExModelsOrganization();
        
        foreach ($organizationModel->listItems() as $organization) {
            $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
            
            if ($organization->haveType($org_type_id)) {
                $result = true;
                break;
            }
        }
        
        return $result;
    }
    
    public function existsOrganizationsOfCountry($country_id) {
        $result = false;
        $organizationModel = new CCExModelsOrganization();
        
        foreach ($organizationModel->listItems() as $organization) {
            if ($organization->country_id == $country_id) {
                $result = true;
                break;
            }
        }
        
        return $result;
    }
    
    public function existsOrganizationsWithCurrency($currency_id) {
        $result = false;
        $organizationModel = new CCExModelsOrganization();
        
        foreach ($organizationModel->listItems() as $organization) {
            if ($organization->currency_id == $currency_id) {
                $result = true;
                break;
            }
        }
        
        return $result;
    }
}
