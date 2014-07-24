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
        $this->_categories = array("financial_accounting" => array("cat_hardware", "cat_software", "cat_external", "cat_producer", "cat_it_developer", "cat_support", "cat_analyst", "cat_manager", "cat_overhead", "cat_financial_accounting_other"), "activities" => array("cat_production", "cat_ingest", "cat_storage", "cat_access", "cat_activities_other"));
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

        foreach ($intervals as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $costsPerGBPerYear = $interval->costsPerGBPerYearOfCategories();
            
            foreach ($this->_categories["financial_accounting"] as $index => $category) {
                $series["financial_accounting"][$index]+= round($costsPerGBPerYear[$category], 2);
            }
            foreach ($this->_categories["activities"] as $index => $category) {
                $series["activities"][$index]+= round($costsPerGBPerYear[$category], 2);
            }
        }
        
        return $series;
    }

    private function mySeries($collectionsIDs, $year, $intervals = array()) {
        $collections = $this->_organization->collections();
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
            $label = "You :: All collections at ";
            $id = "self_all";

            if($year == "all"){$label .= "all years";}else{$label .= $year;}

            $data = $this->seriesData($intervals);
            array_push($series["financial_accounting"], $this->serie($label, $data["financial_accounting"], $color, $id, $label, false));
            array_push($series["activities"], $this->serie($label, $data["activities"], $color, $id, $label, false));
        }

        return $series;
    }
    
    private function otherOrganizationSeries($organizations, $label) {
        // if(count($organizations) < 5){
        //     $organizations = array();
        // }
        
        $intervals = array();
        
        foreach ($organizations as $organization) {
            $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
            
            $intervals = array_merge($intervals, $organization->intervals());
        }
        
        $data = $this->seriesData($intervals);
        $series = array();
        
        $label = "Other :: " . $label .  " (" . count($organizations) . ")";
        $color = "#006fc0";
        $id = "other";
        
        $series["financial_accounting"] = $this->serie($label, $data["financial_accounting"], $color, $id, $label, false);
        $series["activities"] = $this->serie($label, $data["activities"], $color, $id, $label, false);
        
        return $series;
    }
    
    private function calculateMySeries($collectionsIDs, $year) {
        $intervals = array();

        if (!count($collectionsIDs)) {
            $intervals = $this->_organization->intervalsOfYear($year);
        }
        
        return $this->mySeries($collectionsIDs, $year, $intervals);
    }
    
    private function calculateOtherSeries($organizations, $collections, $label) {
        if (count($organizations)) {
            $series = $this->otherOrganizationSeries($organizations, $label);  
        } else if (count($collections)) {
            // $series = $this->organizationsSeries($organizations);
        } else {
            $organizationModel = new CCExModelsOrganization();
            $organizationModel->set("_global_comparison", true);
            $organizations = $organizationModel->listItems();

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
    
    public function series($myCollectionsIDs = array(), $myYear = "all" ,$organizations = array(), $collections = array(), $otherLabel = "List all organizations") {
        return $this->calculateSeries($myCollectionsIDs, $myYear, $organizations, $collections, $otherLabel);
    }

    public function otherOrganizationCostsOptions(){
        $options = array();
        $organizationModel = new CCExModelsOrganization();
        $organizationModel->set("_global_comparison", true);
        $organizations = $organizationModel->listItems();

        $options = $this->addOption($options, "List all organizations", "organization", "none", "", $organizations, true);

        $typesIDs = array(); 
        $typesNames = array(); 
        foreach ($this->_organization->types() as $type) {
            if($type->name != "Other"){
                $options = $this->addOption($options,"Organizations of type " . $type->name, "organization", "type", $type->org_type_id, $organizations);

                array_push($typesIDs, $type->org_type_id);
                array_push($typesNames, $type->name);
            }
        }

        if(count($typesIDs) > 1){
            $options = $this->addOption($options,"Organizations of types " . implode(", ", $typesNames), "organization", implode(",", $typesIDs), "types", $organizations);
        }

        $options = $this->addOption($options, "Organizations of country " . $this->_organization->country()->name, "organization", "country", $this->_organization->country_id, $organizations);
        $options = $this->addOption($options, "Organizations with around the same data volume", "organization", "dataVolume", $this->_organization->dataVolume(), $organizations);

        return $options;
    }

    private function addOption($options, $title, $type, $filter, $value, $organizations, $active=false){
        $filtered = $this->filterBy($type, $filter, $value, $organizations);

        $option = array();
        $option["title"]  = $title;
        $option["number"] = count($filtered);
        $option["type"]   = $type;
        $option["filter"] = $filter;
        $option["value"]  = $value;
        $option["active"] = $active;

        // if($option["number"] < 5){
        //     $option["enable"] = false;
        // }

        $option["enable"] = true;

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
            $organizationModel->set("_global_comparison", true);
            $organizations = $organizationModel->listItems();
        }

        $result = array();

        foreach ($organizations as $organization) {
            $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);

            if($filter == ""){

            }
        }

        return $result;
    }

    public function filterOrganizationsBy($filter, $value, $organizations = array()){
        if(!count($organizations)){
            $organizationModel = new CCExModelsOrganization();
            $organizationModel->set("_global_comparison", true);
            $organizations = $organizationModel->listItems();
        }

        $result = array();

        foreach ($organizations as $organization) {
            $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);

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
                if($this->percentageDifference($organization->dataVolume(), $value) <= 20){
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
        return $result*100;
    }
}
