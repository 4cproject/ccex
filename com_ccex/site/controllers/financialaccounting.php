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
    $financialAccounting = new CCExModelsFinancialaccounting();
    $financialAccounting->set("_organization", $organization);

    if(array_key_exists('collectionsSelected', $data)){
        $collections = $data['collectionsSelected'];
    }else{
        $collections = array();
    }

    $beginOfFirstInterval = $financialAccounting->financialAccountingBeginOfFirstInterval($collections);

    if($organization){
        $return['success'] = true;

        if($mode=="separated"){
            $return['masterSeries'] = $financialAccounting->financialAccountingSeries($collections);
            $return['masterCategories'] = $financialAccounting->financialAccountingCategories($collections);
            $return['series'] = $financialAccounting->financialAccountingSeries($collections, $beginOfFirstInterval["begin_of_first_interval"], true);
            $return['categories'] = $financialAccounting->financialAccountingCategories($collections, $beginOfFirstInterval["begin_of_first_interval"]);
        }else{
            $return['masterSeries'] = $financialAccounting->financialAccountingSeries();
            $return['masterCategories'] = $financialAccounting->financialAccountingCategories();
            $return['series'] = $financialAccounting->financialAccountingSeries(array(), $beginOfFirstInterval["begin_of_first_interval"], true);
            $return['categories'] = $financialAccounting->financialAccountingCategories(array(), $beginOfFirstInterval["begin_of_first_interval"]);        }
    }
    
    echo json_encode($return);
  }
}
