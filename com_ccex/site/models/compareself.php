<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsCompareself extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_organization = null;
    protected $_organizationSeriesAndCategories = null;
    protected $_categories = null;
    
    function __construct() {
        $this->_categories = array("cat_hardware", "cat_software", "cat_external", "cat_producer", "cat_it_developer", "cat_operations", "cat_specialist", "cat_manager", "cat_overhead", "cat_financial_accounting_other", "cat_pre_ingest", "cat_ingest", "cat_storage", "cat_access", "cat_activities_other");
        
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
    
    private function seriesData($intervals, $beginYear, $number) {
        $data = array();
        $sumDataVolumes = 0;
        
        foreach ($this->_categories as $category) {
            $data[$category] = array_fill(0, $number, 0);
        }
        
        foreach ($intervals as $interval) {
            $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);
            $costsPerGBPerYear = $interval->costsPerGBPerYearOfCategories();
            $dataVolume = $interval->data_volume;
            
            $start = $interval->begin_year - $beginYear;
            $stop = ($interval->begin_year + $interval->duration) - $beginYear;
            
            if ($start < 0) {
                $start = 0;
            }
            
            for ($position = $start; $position < $stop; $position++) {
                foreach ($data as $key => $value) {
                    $data[$key][$position]+= $costsPerGBPerYear[$key] * $dataVolume;
                }
            }

            $sumDataVolumes += $dataVolume;
        }

        if($sumDataVolumes){
            foreach ($data as $dataKey => $dataValue) {
                foreach ($data[$dataKey] as $key => $value) {
                    $data[$dataKey][$key]= $value / $sumDataVolumes;
                }
            }
        }
        
        return $data;
    }
    
    private function pushSeries($series, $data, $collection = "All data sets", $linked = false) {
        array_push($series["financial_accounting"], $this->serie("Hardware", $data["cat_hardware"], "#00b050", "cat_hardware", $collection, $linked));
        array_push($series["financial_accounting"], $this->serie("Software", $data["cat_software"], "#006fc0", "cat_software", $collection, $linked));
        array_push($series["financial_accounting"], $this->serie("External", $data["cat_external"], "#ff0000", "cat_external", $collection, $linked));
        array_push($series["financial_accounting"], $this->serie("Producer", $data["cat_producer"], "#e46c0a", "cat_producer", $collection, $linked));
        array_push($series["financial_accounting"], $this->serie("IT-developer", $data["cat_it_developer"], "#E80796", "cat_it_developer", $collection, $linked));
        array_push($series["financial_accounting"], $this->serie("Operations", $data["cat_operations"], "#5D07E8", "cat_operations", $collection, $linked));
        array_push($series["financial_accounting"], $this->serie("Preservation specialist", $data["cat_specialist"], "#11FFF7", "cat_specialist", $collection, $linked));
        array_push($series["financial_accounting"], $this->serie("Manager", $data["cat_manager"], "#8DFF1E", "cat_manager", $collection, $linked));
        array_push($series["financial_accounting"], $this->serie("Overhead", $data["cat_overhead"], "#FFB271", "cat_overhead", $collection, $linked));
        array_push($series["financial_accounting"], $this->serie("Other", $data["cat_financial_accounting_other"], "#aaaaaa", "cat_financial_accounting_other", $collection, $linked));
        
        array_push($series["activities"], $this->serie("Pre-Ingest", $data["cat_pre_ingest"], "#00b050", "cat_pre_ingest", $collection, $linked));
        array_push($series["activities"], $this->serie("Ingest", $data["cat_ingest"], "#006fc0", "cat_ingest", $collection, $linked));
        array_push($series["activities"], $this->serie("Archival storage", $data["cat_storage"], "#ff0000", "cat_storage", $collection, $linked));
        array_push($series["activities"], $this->serie("Access", $data["cat_access"], "#e46c0a", "cat_access", $collection, $linked));
        array_push($series["activities"], $this->serie("Other", $data["cat_activities_other"], "#aaaaaa", "cat_activities_other", $collection, $linked));
        
        return $series;
    }
    
    private function collectionsSeries($collections, $beginYear, $number) {
        $series = array("financial_accounting" => array(), "activities" => array());
        $linked = false;
        
        foreach ($collections as $collectionID) {
            $collectionModel = new CCExModelsCollection();
            $collection = $collectionModel->getItemBy("_collection_id", $collectionID);
            
            if ($collection) {
                $data = $this->seriesData($collection->intervals(), $beginYear, $number);
                $series = $this->pushSeries($series, $data, htmlspecialchars($collection->name), $linked);
                $linked = true;
            }
        }
        
        return $series;
    }
    
    private function organizationSeries($beginYear, $number) {
        $series = array("financial_accounting" => array(), "activities" => array());
        
        $data = $this->seriesData($this->_organization->finalIntervals(), $beginYear, $number);
        $series = $this->pushSeries($series, $data);
        
        return $series;
    }
    
    private function series($collections, $beginYear, $number) {
        if (count($collections)) {
            $series = $this->collectionsSeries($collections, $beginYear, $number);
        } else {
            $series = $this->organizationSeries($beginYear, $number);
        }
        
        return $series;
    }
    
    private function categories($beginYear, $number) {
        $categories = array();
        
        $currentYear = $beginYear;
        
        for ($i = 0; $i < $number; $i++) {
            array_push($categories, strval($currentYear));
            $currentYear++;
        }
        
        return $categories;
    }
    
    private function calculateSeriesAndCategories($collections, $startYear) {
        $beginAndLastYear = $this->_organization->beginAndLastYear($collections);
        $beginYear = $beginAndLastYear["begin_year"];
        $lastYear = $beginAndLastYear["last_year"];
        
        if ($startYear && $startYear > $beginYear) {
            $beginYear = $startYear;
        }
        
        $number = $lastYear - $beginYear + 1;
        
        $result = array("categories" => $this->categories($beginYear, $number), "series" => $this->series($collections, $beginYear, $number));
        
        return $result;
    }
    
    public function seriesAndCategories($collections = array(), $startYear = null) {
        if (count($collections) || $startYear) {
            return $this->calculateSeriesAndCategories($collections, $startYear);
        } else {
            if (!$this->_organizationSeriesAndCategories) {
                $this->_organizationSeriesAndCategories = $this->calculateSeriesAndCategories($collections, $startYear);
            }
            return $this->_organizationSeriesAndCategories;
        }
    }
    
    public function beginOfFirstInterval($collections = array()) {
        $configurationModel = new CCExModelsConfiguration();

        $beginAndLastYear = $this->_organization->beginAndLastYear($collections);
        $beginYear = $beginAndLastYear["begin_year"];
        $lastYear = $beginAndLastYear["last_year"];
        $beginOfFirstInterval = $beginYear;

        if ($lastYear - $beginYear > $configurationModel->configurationValue("maximum_years_my_costs_charts", 5) - 1 ) {
            $beginOfFirstInterval = $lastYear - ($configurationModel->configurationValue("maximum_years_my_costs_charts", 5) - 1) ;
        }
        
        return array("begin_of_first_interval" => $beginOfFirstInterval, "begin_year" => $beginYear);
    }
}
