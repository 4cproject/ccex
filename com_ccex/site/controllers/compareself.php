<?php
defined('_JEXEC') or die('Restricted access');

class CCExControllersCompareself extends JControllerBase
{
    public function execute() {
        $app = JFactory::getApplication();
        $return = array('success' => false);
        
        $userModel = new CCExModelsUser();
        $organization = $userModel->organization();
        $data = JRequest::get('post');
        $mode = $data['collectionsMode'];
        $compareSelf = new CCExModelsCompareself();
        $compareSelf->set("_organization", $organization);
        $filter = null;
        
        if (array_key_exists('collectionsSelected', $data) && array_key_exists('collectionsMode', $data) && $data["collectionsMode"] == "separated") {
            $collections = $data['collectionsSelected'];
        } else {
            $collections = array();
        }

        if(array_key_exists('collectionsMode', $data) && $data["collectionsMode"] == "combinedFinal") {
            $filter = "final";
        }
        
        $beginOfFirstInterval = $compareSelf->beginOfFirstInterval($collections, $filter);
        $begin = $beginOfFirstInterval["begin_of_first_interval"];
        
        $masterSeriesAndCategories = $compareSelf->seriesAndCategories($collections, null, $filter);
        $masterCategories = $masterSeriesAndCategories["categories"];
        $masterSeries = $masterSeriesAndCategories["series"];
        
        $seriesAndCategories = $compareSelf->seriesAndCategories($collections, $begin, $filter);
        $categories = $seriesAndCategories["categories"];
        $series = $seriesAndCategories["series"];
        
        if ($organization) {
            $return['success'] = true;
            
            $return['masterSeries'] = $masterSeries;
            $return['masterCategories'] = $masterCategories;
            $return['series'] = $series;
            $return['categories'] = $categories;
        }
        
        echo json_encode($return);
    }
}
