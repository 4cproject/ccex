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

    if($organization){
        $return['success'] = true;

        $return['categories'] = $organization->financialAccountingCategories();

        if($mode=="separated"){
            $return['series'] = $organization->financialAccountingSeries($collections);
        }else{
            $return['series'] = $organization->financialAccountingSeries();
        }
    }
    
    echo json_encode($return);
  }
}
