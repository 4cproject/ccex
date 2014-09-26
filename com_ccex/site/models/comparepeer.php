<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsComparepeer extends CCExModelsDefault
{
    protected $_organization = null;
    
    function __construct() {
        $configurationModel = new CCExModelsConfiguration();

        $this->_categories = array("financial_accounting" => array("cat_hardware", "cat_software", "cat_external", "cat_producer", "cat_it_developer", "cat_operations", "cat_specialist", "cat_manager", "cat_overhead", "cat_financial_accounting_other"), "activities" => array("cat_pre_ingest", "cat_ingest", "cat_storage", "cat_access", "cat_activities_other"));
        $this->_colors = array("#00b050", "#ff0000", "#8DFF1E", "#11FFF7", "#FFB271", "#e46c0a", "#5D07E8", "#E80796");

        $this->_typeScore = $configurationModel->configurationValue("score_type_match", 50);
        $this->_dataVolumeScore = $configurationModel->configurationValue("score_data_volume_similiarity", 40);
        $this->_mainAssetScore = $configurationModel->configurationValue("score_main_asset_equality", 20);
        $this->_numberOfCopiesScore = $configurationModel->configurationValue("score_number_of_copies_similiarity", 20);
        $this->_staffScore = $configurationModel->configurationValue("score_staff_similiarity", 20);
        $this->_scopeScore = $configurationModel->configurationValue("score_scopes_match", 10);

        $this->_maxScore = $this->_typeScore + $this->_dataVolumeScore + $this->_mainAssetScore + $this->_numberOfCopiesScore + $this->_staffScore + $this->_scopeScore;
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
                $series["financial_accounting"][$index]+= $costsPerGBPerYear[$category] * $tax * $interval->duration;
            }
            foreach ($this->_categories["activities"] as $index => $category) {
                $series["activities"][$index]+= $costsPerGBPerYear[$category] * $tax * $interval->duration;
            }
            
            $sumIntervals+= $interval->duration;
        }
        
        if ($sumIntervals > 0) {
            foreach ($series["financial_accounting"] as $key => $value) {
                $series["financial_accounting"][$key] = $value / $sumIntervals;
            }
            foreach ($series["activities"] as $key => $value) {
                $series["activities"][$key] = $value / $sumIntervals;
            }
        }
        
        return $series;
    }
    
    private function mySeries($collectionsIDs, $year, $intervals, $filter) {
        if($this->_organization){
            $collections = $this->_organization->collections();
        }else{
            $collections = array();
        }   

        $collectionsIdentifiers = array();
        
        foreach ($collections as $index => $collection) {
            $collectionsIdentifiers[$collection->collection_id] = $index + 1;
        }
        
        $series = array("financial_accounting" => array(), "activities" => array());
        
        if (count($collectionsIDs)) {
            foreach ($collectionsIDs as $index => $collectionID) {
                $color = $this->_colors[$index % count($this->_colors) ];
                $collectionModel = new CCExModelsCollection();
                $collection = $collectionModel->getItemBy("_collection_id", $collectionID);
                
                $id = "collection_" . $collection->collection_id;
                $label = "Collection #" . $collectionsIdentifiers[$collectionID] . " at ";
                if ($year[$collection->collection_id] == "all") {
                    $label.= "all years";
                } else {
                    $label.= $year[$collection->collection_id];
                }
                
                $data = $this->seriesData($collection->intervalsOfYear($year[$collection->collection_id]));
                
                array_push($series["financial_accounting"], $this->serie($label, $data["financial_accounting"], $color, $id, $label, false));
                array_push($series["activities"], $this->serie($label, $data["activities"], $color, $id, $label, false));
            }
        } else {
            $color = "#00b050";
            $id = "self_all";

            if($this->_organization){
                if($filter && $filter == "final"){
                  $label = "You :: Final data sets at ";  
                }else{
                  $label = "You :: All data sets at ";
                }
                
                if ($year == "all") {
                    $label.= "all years";
                } else {
                    $label.= $year;
                }
            }else{
                $label = "You :: No organization";
            }  
            
            $data = $this->seriesData($intervals);
            array_push($series["financial_accounting"], $this->serie($label, $data["financial_accounting"], $color, $id, $label, false));
            array_push($series["activities"], $this->serie($label, $data["activities"], $color, $id, $label, false));
        }
        
        return $series;
    }
    
    private function otherSeries($organization) {
        $data = $this->seriesData($organization->finalIntervals());
        $series = array();
        
        if ($organization->organization_linked) {
            $label = htmlspecialchars($organization->name);
        } else {
            $label = "Anonymous Organisation";
        }
        
        $color = "#006fc0";
        $id = "other";
        
        $series["financial_accounting"] = $this->serie($label, $data["financial_accounting"], $color, $id, $label, false);
        $series["activities"] = $this->serie($label, $data["activities"], $color, $id, $label, false);
        
        return $series;
    }
    
    private function calculateMySeries($collectionsIDs, $year, $filter) {
        $intervals = array();
        
        if ($this->_organization && !count($collectionsIDs)) {
            if ($filter && $filter == "final") {
                $intervals = $this->_organization->finalIntervalsOfYear($year);
            } else {
                $intervals = $this->_organization->intervalsOfYear($year);
            }
        }
        
        return $this->mySeries($collectionsIDs, $year, $intervals, $filter);
    }
    
    private function calculateOtherSeries($organization) {
        $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
        $series = $this->otherSeries($organization);
        return $series;
    }
    
    private function calculateSeries($myCollectionsIDs, $myYear, $organization, $filter) {
        $series = array("financial_accounting" => array(), "activities" => array());
        
        $mySeries = $this->calculateMySeries($myCollectionsIDs, $myYear, $filter);
        
        $series["financial_accounting"] = $mySeries["financial_accounting"];
        $series["activities"] = $mySeries["activities"];
        
        $otherSeries = $this->calculateOtherSeries($organization);
        
        array_push($series["financial_accounting"], $otherSeries["financial_accounting"]);
        array_push($series["activities"], $otherSeries["activities"]);
        
        return $series;
    }
    
    public function series($organization, $myCollectionsIDs = array(), $myYear = "all", $filter = null) {
        return $this->calculateSeries($myCollectionsIDs, $myYear, $organization, $filter);
    }
    
    public function peersLikeYou($currentOrganizationID = null) {
        $organizationsScore = array();
        $organizationsHash = array();
        
        $organizationModel = new CCExModelsOrganization();
        $organizations = $organizationModel->organizationsForPeerComparison();
        
        foreach ($organizations as $organization) {
            $organizationID = $organization->organization_id;
            
            if($this->_organization){
                $organizationsScore[$organizationID] = 0;

                $organizationsScore[$organizationID]+= $this->_typeScore * $organization->typeMatch($this->_organization->types());
                $organizationsScore[$organizationID]+= $this->_dataVolumeScore * max((1 - $this->percentageDifference($organization->dataVolumePonderedAverage(), $this->_organization->dataVolumePonderedAverage())), 0);
                $organizationsScore[$organizationID]+= $this->_numberOfCopiesScore * max((1 - $this->percentageDifference($organization->numberOfCopiesPonderedAverage(), $this->_organization->numberOfCopiesPonderedAverage())), 0);
                $organizationsScore[$organizationID]+= $this->_staffScore * max((1 - $this->percentageDifference($organization->staffPonderedAverage(), $this->_organization->staffPonderedAverage())), 0);
                $organizationsScore[$organizationID]+= $this->_mainAssetScore * $organization->mainAssetsMatch($this->_organization->mainAssets());
                $organizationsScore[$organizationID]+= $this->_scopeScore * $organization->scopesMatch($this->_organization->scopes());
            }else{
                $organizationsScore[$organizationID] = mt_rand(0, 10000);
            }

            $organizationsHash[$organizationID] = $organization;
        }
        
        arsort($organizationsScore);
        $result = array();
        $complete = array();
        $currentOrganizationExists = false;
        
        foreach ($organizationsScore as $organizationID => $score) {
            if (!$currentOrganizationID || $currentOrganizationID != $organizationID) {
                array_push($result, $organizationsHash[$organizationID]);
            }
            array_push($complete, $organizationsHash[$organizationID]);
        }
        
        if ($currentOrganizationID && array_key_exists($currentOrganizationID, $organizationsHash)) {
            $current = $organizationsHash[$currentOrganizationID];
        } else {
            $current = array_shift($result);
        }
        
        return array("current" => $current, "complete" => $complete, "scores" => $organizationsScore);
    }
    
    private function percentageDifference($first, $second) {
        $difference = abs($first - $second);
        $average = ($first + $second) / (float)2;
        
        if($average > 0){
            $result = $difference / $average;
        }else{
            $result = 0;
        }

        return $result;
    }

    public function similarity($score){
        $similarity = (float)$score/$this->_maxScore;
        $result = array(
            "level" => "",
            "class"  => "",
            "value"  => ""
        );
        
        $result["value"] = $similarity;

        if($similarity > 0.80){
            $result["level"] = "Super";
            $result["class"] = "label-success super-similarity";
        }else if($similarity > 0.70){
            $result["level"] = "Very high";
            $result["class"] = "label-primary very-high-similarity";
        }else if($similarity > 0.60){
            $result["level"] = "High";
            $result["class"] = "label-info high-similarity";
        }else if($similarity > 0.40){
            $result["level"] = "Medium";
            $result["class"] = "label-warning medium-similarity";
        }else{
            $result["level"] = "Lower";
            $result["class"] = "label-default lower-similarity";
        }

        return $result;
    }
}
