<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsCompareglobal extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_organization = null;
    protected $_organizationSeries = null;
    protected $_categories = null;
    protected $_colors = null;
    
    function __construct() {
        $this->_categories = array("financial_accounting" => array("cat_hardware", "cat_software", "cat_external", "cat_producer", "cat_it_developer", "cat_operations", "cat_specialist", "cat_manager", "cat_overhead", "cat_financial_accounting_other"), "activities" => array("cat_pre_ingest", "cat_ingest", "cat_storage", "cat_access", "cat_activities_other"));
        $this->_colors = array("#00b050", "#ff0000", "#8DFF1E", "#11FFF7", "#FFB271", "#e46c0a", "#5D07E8", "#E80796");

        parent::__construct();
    }
    
    private function serie($name, $data, $color, $id, $stack, $linked) {
        $serie = array("name" => $name, "data" => $data, "color" => $color, "stack" => $stack);
        
        if ($linked) {
            $serie["linkedTo"] = $id;
        } else {
            $serie["id"] = $id;
        }
        
        return $serie;
    }
    
    private function seriesData($intervals) {
        $series = array("financial_accounting" => array_fill(0, 10, 0), "activities" => array_fill(0, 5, 0));
        $sumIntervals = 0;
        $euc = new CCExModelsEuroconvertionrate();

        foreach ($intervals as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $costsPerGBPerYear = $interval->costsPerGBPerYearOfCategories();

            $currencyCode = $interval->currency()->code;
            $beginYear = $interval->begin_year;
            $duration = $interval->duration;

            $tax = $euc->taxOnInterval($currencyCode, $beginYear, $duration);

            foreach ($this->_categories["financial_accounting"] as $index => $category) {
                $series["financial_accounting"][$index] += $costsPerGBPerYear[$category] * $tax * $interval->duration;
            }
            foreach ($this->_categories["activities"] as $index => $category) {
                $series["activities"][$index] += $costsPerGBPerYear[$category] * $tax * $interval->duration;
            }

            $sumIntervals += $interval->duration;
        }

        foreach ($series["financial_accounting"] as $key => $value) {
            if($sumIntervals>0){
                $series["financial_accounting"][$key] = $value/$sumIntervals;
            }else{
                $series["financial_accounting"][$key] = 0;
            }
        }
        
        foreach ($series["activities"] as $key => $value) {
            if($sumIntervals>0){
                $series["activities"][$key] = $value/$sumIntervals;
            }else{
                $series["activities"][$key] = 0;
            }
        }

        return $series;
    }

    private function mySeries($collectionsIDs, $year, $intervals = array()) {
        $collections = $this->_organization->finalCollections();
        $collectionsIdentifiers = array();

        foreach ($collections as $index => $collection) {
            $collectionsIdentifiers[$collection->collection_id] = $index+1;
        }

        $series = array(
            "financial_accounting" => array(),
            "activities"           => array()
        );

        if(count($collectionsIDs)){
            foreach ($collectionsIDs as $index => $collectionID) {
                $color = $this->_colors[$index % count($this->_colors)];
                $collectionModel = new CCExModelsCollection();
                $collection = $collectionModel->getItemBy("_collection_id", $collectionID);
            
                $id = "collection_" . $collection->collection_id;
                $label = "Collection #" . $collectionsIdentifiers[$collectionID] . " at ";
                if($year[$collection->collection_id] == "all"){$label .= "all years";}else{$label .= $year[$collection->collection_id];}

                $data = $this->seriesData($collection->intervalsOfYear($year[$collection->collection_id]));
                
                array_push($series["financial_accounting"], $this->serie($label, $data["financial_accounting"], $color, $id, $label, false));
                array_push($series["activities"], $this->serie($label, $data["activities"], $color, $id, $label, false));
            }
        }else{
            $color = "#00b050";
            $label = "You :: All data sets at ";
            $id = "self_all";

            if($year == "all"){$label .= "all years";}else{$label .= $year;}

            $data = $this->seriesData($intervals);
            array_push($series["financial_accounting"], $this->serie($label, $data["financial_accounting"], $color, $id, $label, false));
            array_push($series["activities"], $this->serie($label, $data["activities"], $color, $id, $label, false));
        }

        return $series;
    }
    
    private function otherOrganizationSeries($organizations, $label) {
        if(count($organizations) < 5){
            $organizations = array();
        }
        
        $intervals = array();
        
        foreach ($organizations as $organization) {
            $intervals = array_merge($intervals, $organization->finalIntervals());
        }
        
        $data = $this->seriesData($intervals);
        $series = array();
        
        $label = "Other :: " . $label;
        $color = "#006fc0";
        $id = "other";
        
        $series["financial_accounting"] = $this->serie($label, $data["financial_accounting"], $color, $id, $label, false);
        $series["activities"] = $this->serie($label, $data["activities"], $color, $id, $label, false);
        
        return $series;
    }

    
    private function otherCollectionsSeries($collections, $label) {
        if(count($collections) < 5){
            $organizations = array();
        }
        
        $intervals = array();
        
        foreach ($collections as $collection) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
            
            $intervals = array_merge($intervals, $collection->intervals());
        }
        
        $data = $this->seriesData($intervals);
        $series = array();
        
        $label = "Other :: " . $label;
        $color = "#006fc0";
        $id = "other";
        
        $series["financial_accounting"] = $this->serie($label, $data["financial_accounting"], $color, $id, $label, false);
        $series["activities"] = $this->serie($label, $data["activities"], $color, $id, $label, false);
        
        return $series;
    }

    private function calculateMySeries($collectionsIDs, $year) {
        $intervals = array();

        if (!count($collectionsIDs)) {
            $intervals = $this->_organization->finalIntervalsOfYear($year);
        }
        
        return $this->mySeries($collectionsIDs, $year, $intervals);
    }
    
    private function calculateOtherSeries($organizations, $collections, $label) {
        if (count($organizations)) {
            $series = $this->otherOrganizationSeries($organizations, $label);  
        } else if (count($collections)) {
            $series = $this->otherCollectionsSeries($collections, $label);
        } else {
            $organizationModel = new CCExModelsOrganization();
            $organizations = $organizationModel->organizationsForGlobalComparison();

            $series = $this->otherOrganizationSeries($organizations, $label);
        }
        
        return $series;
    }
    
    private function calculateSeries($myCollectionsIDs, $myYear, $organizations, $collections, $otherLabel) {
        $series = array("financial_accounting" => array(), "activities" => array());
        
        $mySeries = $this->calculateMySeries($myCollectionsIDs, $myYear);
        
        $series["financial_accounting"] = $mySeries["financial_accounting"];
        $series["activities"]           = $mySeries["activities"];
        
        $otherSeries = $this->calculateOtherSeries($organizations, $collections, $otherLabel);
        
        array_push($series["financial_accounting"], $otherSeries["financial_accounting"]);
        array_push($series["activities"], $otherSeries["activities"]);
        
        return $series;
    }
    
    public function series($myCollectionsIDs = array(), $myYear = "all" ,$organizations = array(), $collections = array(), $otherLabel = "List all organisations") {
        return $this->calculateSeries($myCollectionsIDs, $myYear, $organizations, $collections, $otherLabel);
    }

    public function otherOrganizationCostsOptions(){
        $options = array();
        $listall = array();
        $organizationModel = new CCExModelsOrganization();
        $organizations = $organizationModel->organizationsForGlobalComparison();

        $listall = $this->addOption($listall, "List all organisations", "organization", "none", "", $organizations, true);

        $typesIDs = array();
        $typesNames = array(); 
        foreach ($this->_organization->types() as $type) {
            if($type->name != "Other"){
                $options = $this->addOption($options,"Organisations of type " . $type->name, "organization", "type", $type->org_type_id, $organizations);

                array_push($typesIDs, $type->org_type_id);
                array_push($typesNames, $type->name);
            }
        }

        if(count($typesIDs) > 1){
            $options = $this->addOption($options,"Organisations of types " . implode(", ", $typesNames), "organization",  "types", implode(",", $typesIDs), $organizations);
        }

        $options = $this->addOption($options, "Organisations of country " . $this->_organization->country()->name, "organization", "country", $this->_organization->country_id, $organizations);
        $options = $this->addOption($options, "Organisations with around the same data volume", "organization", "dataVolume", $this->_organization->dataVolumePonderedAverage(), $organizations);
        $options = $this->addOption($options, "Collections with around the same data volume", "collection", "dataVolume", $this->_organization->dataVolumePonderedAverage(), $organizations, false, $this->_organization->validDataVolumePonderedAverage());
        $options = $this->addOption($options, "Collections with around the same staff", "collection", "staff", $this->_organization->staffPonderedAverage(), $organizations, false, $this->_organization->validStaffPonderedAverage());
        $options = $this->addOption($options, "Collections with the same number of copies", "collection", "numberOfCopies", $this->_organization->numberOfCopiesPonderedAverage(), $organizations, false, $this->_organization->validNumberOfCopiesPonderedAverage());

        foreach ($this->_organization->scopes() as $scope) {
            $options = $this->addOption($options, "Collections of scope: " . $scope, "collection", "scope", $scope, $organizations);
        }

        foreach ($this->_organization->mainAssets() as $mainAsset) {
            $assetWords = explode("_", $mainAsset);
            array_shift($assetWords);

            $options = $this->addOption($options, "Collections with mainly " . implode(" ", $assetWords) . " asset", "collection", "asset", $mainAsset, $organizations);
        }

        function compareOption($a, $b){
            return $b["number"] - $a["number"];
        }

        usort($options, "compareOption");

        return array_merge($listall, $options);
    }

    private function addOption($options, $title, $type, $filter, $value, $organizations, $active=false, $enable=true, $tooltip="This filter cannot be used, because your cost data sets are very different in this field."){
        $filtered = $this->filterBy($type, $filter, $value, $organizations);

        $option = array();
        $option["title"]  = $title;
        $option["number"] = count($filtered);
        $option["type"]   = $type;
        $option["filter"] = $filter;
        $option["value"]  = $value;
        $option["active"] = $active;

        if($option["number"] < 5){
            $option["enable"] = false;
            $option["tooltip"] = "A filter cannot be displayed with size less than 5, to preserve anonimity for the participants.";
        }else{
            $option["tooltip"] = $tooltip;
            $option["enable"] = $enable;
        }

        // if($option["enable"]){
        //     array_push($options, $option);
        // }
        array_push($options, $option);

        return $options;
    }

    public function filterBy($type, $filter, $value, $organizations = array(), $collections = array()){
        if($type == "organization"){
            $filtered = $this->filterOrganizationsBy($filter, $value, $organizations);
        }elseif($type == "collection") {
            $filtered = $this->filterCollectionsBy($filter, $value, $organizations);
        }

        return $filtered;
    }

    public function filterCollectionsBy($filter, $value, $organizations = array(), $collections = array()){
        if(!count($organizations)){
            $organizationModel = new CCExModelsOrganization();
            $organizations = $organizationModel->organizationsForGlobalComparison();
        }

        $result = array();

        foreach ($organizations as $organization) {
            $collections = $organization->finalCollections();

            foreach ($collections as $collection) {
                $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);

                if($filter == "dataVolume"){
                    if($this->percentageDifference($value, $collection->dataVolumePonderedAverage()) <= 0.3){
                        array_push($result, $collection);
                    }
                }elseif($filter == "staff"){
                    if($this->percentageDifference($value, $collection->staffPonderedAverage()) <= 0.3){
                        array_push($result, $collection);
                    }
                }elseif($filter == "numberOfCopies"){
                    if($this->percentageDifference($value, $collection->numberOfCopiesPonderedAverage()) <= 0.3){
                        array_push($result, $collection);
                    }
                }elseif($filter == "scope"){
                    if($collection->scope == $value){
                        array_push($result, $collection);
                    }
                }elseif($filter == "asset"){
                    if($collection->mainAsset() == $value){
                        array_push($result, $collection);
                    }
                }
            }
        }

        return $result;
    }

    public function filterOrganizationsBy($filter, $value, $organizations = array()){
        if(!count($organizations)){
            $organizationModel = new CCExModelsOrganization();
            $organizations = $organizationModel->organizationsForGlobalComparison();
        }
        $result = array();

        foreach ($organizations as $organization) {
            if($filter == "type"){
                if($organization->haveType($value)){
                    array_push($result, $organization);
                }
            }elseif ($filter == "types") {
                $list = explode(',', $value);

                if($organization->haveTypes($list)){
                    array_push($result, $organization);
                }
            }elseif($filter == "country"){
                if($organization->country_id == $value){
                    array_push($result, $organization);
                }
            }elseif($filter == "dataVolume") {
                if($this->percentageDifference($organization->dataVolumePonderedAverage(), $value) <= 0.3){
                    array_push($result, $organization);
                }
            }elseif($filter == "none") {
                array_push($result, $organization);
            }
        }

        return $result;
    }

    private function percentageDifference($first, $second){
        $difference = abs($first - $second);
        if($difference == 0){
            $result = 0;
        }else{
            $average = ($first+$second)/$difference;
            $result = $difference/$average;
        }
        return $result;
    }
}
