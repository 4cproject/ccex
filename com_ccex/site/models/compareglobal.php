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
    
    function __construct() {
        $this->_categories = array("financial_accounting" => array("cat_hardware", "cat_software", "cat_external", "cat_producer", "cat_it_developer", "cat_support", "cat_analyst", "cat_manager", "cat_overhead", "cat_financial_accounting_other"), "activities" => array("cat_production", "cat_ingest", "cat_storage", "cat_access", "cat_activities_other"));
        
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

    private function mySeries($intervals, $label) {
        $data = $this->seriesData($intervals);
        $series = array();

        $label = "You :: " . $label;
        $id = "your_collections";
        $color = "#00b050";
        
        $series["financial_accounting"] = $this->serie($label, $data["financial_accounting"], $color, $id, $label, false);
        $series["activities"] = $this->serie($label, $data["activities"], $color, $id, $label, false);
        
        return $series;
    }
    
    private function globalSeries() {
        $organizationModel = new CCExModelsOrganization();
        $organizationModel->set("_global_comparison", true);
        $organizations = $organizationModel->listItems();

        if(count($organizations) < 5){
            $organizations = array();
        }
        
        $intervals = array();
        
        foreach ($organizations as $organization) {
            $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
            
            $intervals = array_merge($intervals, $organization->intervals());
        }
        
        $data = $this->seriesData($intervals);
        $series = array();
        
        $label = "Other :: All organizations (" . count($organizations) . ")";
        $color = "#006fc0";
        $id = "all_organizations";
        
        $series["financial_accounting"] = $this->serie($label, $data["financial_accounting"], $color, $id, $label, false);
        $series["activities"] = $this->serie($label, $data["activities"], $color, $id, $label, false);
        
        return $series;
    }
    
    private function calculateMySeries($intervals, $organizations, $collections, $label) {
        if (!count($intervals)) {
            $intervals = $this->_organization->intervals();
        } 
        
        return $this->mySeries($intervals, $label);
    }
    
    private function calculateOtherSeries($intervals, $organizations, $collections, $label) {
        if (count($organizations)) {
            
            // $series = $this->collectionsSeries($collections);
            
            
        } else if (count($collections)) {
            
            // $series = $this->organizationsSeries($organizations);
            
            
        } else {
            $series = $this->globalSeries();
        }
        
        return $series;
    }
    
    private function calculateSeries($intervals, $organizations, $collections, $label) {
        $series = array("financial_accounting" => array(), "activities" => array());
        
        $mySeries = $this->calculateMySeries($intervals, $organizations, $collections, $label);
        
        array_push($series["financial_accounting"], $mySeries["financial_accounting"]);
        array_push($series["activities"], $mySeries["activities"]);
        
        $otherSeries = $this->calculateOtherSeries($intervals, $organizations, $collections, $label);
        
        array_push($series["financial_accounting"], $otherSeries["financial_accounting"]);
        array_push($series["activities"], $otherSeries["activities"]);
        
        return $series;
    }
    
    public function series($intervals = array(), $organizations = array(), $collections = array(), $label = "All collections at all years") {
        return $this->calculateSeries($intervals, $organizations, $collections, $label);
    }

    public function otherOrganizationCostsOptions(){
        $options = array();
        $organizationModel = new CCExModelsOrganization();
        $organizationModel->set("_global_comparison", true);
        $organizations = $organizationModel->listItems();
        $organizations_nr = count($organizations);

        $option = array();
        $option["title"] = "List all organizations";
        $option["number"] = $organizations_nr;
        

        if($option["number"] < 5){
            $option["active"] = false;
        }

        array_push($options, $option);

        foreach ($this->_organization->types() as $type) {
            if($type->name != "Other"){
                $option["title"] = "Only organizations of type " . $type->name;
                $option["number"] = count($this->filterOrganizationsBy($organizations, "type", $type->name));

                if($option["number"] < 5){
                    $option["active"] = false;
                }

                array_push($options, $option);
            }
        }

        return $options;
    }

    public function filterOrganizationsBy($organizations, $filter, $value){
        $result = array();

        foreach ($organizations as $organization) {
            $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);

            if($filter == "type"){
                if($organization->haveType($value)){
                    array_push($result, $organization);
                }
            }
        }

        return $result;
    }
}
