<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsComparepeer extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_organization = null;
    
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
        $sumIntervals = 0;

        foreach ($intervals as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $costsPerGBPerYear = $interval->costsPerGBPerYearOfCategories();
            
            foreach ($this->_categories["financial_accounting"] as $index => $category) {
                $series["financial_accounting"][$index] += $costsPerGBPerYear[$category] * $interval->duration;
            }
            foreach ($this->_categories["activities"] as $index => $category) {
                $series["activities"][$index] += $costsPerGBPerYear[$category] * $interval->duration;
            }

            $sumIntervals += $interval->duration;
        }

        foreach ($series["financial_accounting"] as $key => $value) {
           $series["financial_accounting"][$key] = round($value/$sumIntervals, 2);
        }
        
        foreach ($series["activities"] as $key => $value) {
           $series["activities"][$key] = round($value/$sumIntervals, 2);
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
    
    private function otherSeries($organization) {
        $data = $this->seriesData($organization->intervals());
        $series = array();
        
        $label = $organization->name;
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
    
    private function calculateOtherSeries($organizationID) {
        $organizationModel = new CCExModelsOrganization();
        $organization = $organizationModel->getItemBy('_organization_id', $organizationID);

        $series = $this->otherSeries($organization);
        return $series;
    }
    
    private function calculateSeries($myCollectionsIDs, $myYear, $organizationID) {
        $series = array("financial_accounting" => array(), "activities" => array());
        
        $mySeries = $this->calculateMySeries($myCollectionsIDs, $myYear);
        
        $series["financial_accounting"] = $mySeries["financial_accounting"];
        $series["activities"]           = $mySeries["activities"];
        
        $otherSeries = $this->calculateOtherSeries($organizationID);
        
        array_push($series["financial_accounting"], $otherSeries["financial_accounting"]);
        array_push($series["activities"], $otherSeries["activities"]);
        
        return $series;
    }
    
    public function series($organizationID, $myCollectionsIDs = array(), $myYear = "all") {
        return $this->calculateSeries($myCollectionsIDs, $myYear, $organizationID);
    }
}
