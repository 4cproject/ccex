<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExControllersFinancialaccounting extends JControllerBase {
  public function execute() {
    $app      = JFactory::getApplication();
    $return   = array('success'=>false);

    $userModel = new CCExModelsUser();
    $organization = $userModel->organization();
    $data = JRequest::get('post');
    $mode = $data['collectionsMode'];

    if(array_key_exists('collectionsSelected', $data)){
        $collections = $data['collectionsSelected'];
    }else{
        $collections = array();
    }

    $beginOfFirstInterval = $organization->financialAccountingBeginOfFirstInterval($collections);

    if($organization){
        $return['success'] = true;

        if($mode=="separated"){
            $return['masterSeries'] = $organization->financialAccountingSeries($collections);
            $return['masterCategories'] = $organization->financialAccountingCategories($collections);
            $return['series'] = $organization->financialAccountingSeries($collections, $beginOfFirstInterval["begin_of_first_interval"], true);
            $return['categories'] = $organization->financialAccountingCategories($collections, $beginOfFirstInterval["begin_of_first_interval"]);
        }else{
            $return['masterSeries'] = $organization->financialAccountingSeries();
            $return['masterCategories'] = $organization->financialAccountingCategories();
            $return['series'] = $organization->financialAccountingSeries(array(), $beginOfFirstInterval["begin_of_first_interval"], true);
            $return['categories'] = $organization->financialAccountingCategories(array(), $beginOfFirstInterval["begin_of_first_interval"]);        }
    }
    
    echo json_encode($return);
  }
}
