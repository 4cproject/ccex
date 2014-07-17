<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExControllersCompareself extends JControllerBase {
  public function execute() {
    $app      = JFactory::getApplication();
    $return   = array('success'=>false);

    $userModel = new CCExModelsUser();
    $organization = $userModel->organization();
    $data = JRequest::get('post');
    $mode = $data['collectionsMode'];
    $compareSelf = new CCExModelsCompareself();
    $compareSelf->set("_organization", $organization);

    if(array_key_exists('collectionsSelected', $data)){
        $collections = $data['collectionsSelected'];
    }else{
        $collections = array();
    }

    $beginOfFirstInterval = $compareSelf->beginOfFirstInterval($collections);
    $begin = $beginOfFirstInterval["begin_of_first_interval"];

    $masterSeriesAndCategories = $compareSelf->seriesAndCategories($collections);
    $masterCategories = $masterSeriesAndCategories["categories"];
    $masterSeries = $masterSeriesAndCategories["series"];

    $seriesAndCategories = $compareSelf->seriesAndCategories($collections, $begin);
    $categories = $seriesAndCategories["categories"];
    $series = $seriesAndCategories["series"];

    if($organization){
        $return['success'] = true;

        $return['masterSeries'] = $masterSeries;
        $return['masterCategories'] = $masterCategories;
        $return['series'] = $series;
        $return['categories'] = $categories;
    }
    
    echo json_encode($return);
  }
}
