<?php
defined('_JEXEC') or die('Restricted access');

class CCExControllersDraft extends JControllerBase
{
    public function execute() {
        $app = JFactory::getApplication();
        $return = array('success' => false);
        
        $data = JRequest::get('post');
        $collectionModel = new CCExModelsCollection();
        $collection_id = $data['collection_id'];
        $final = 0;

        if(isset($data['final']) && $data['final']){
            $final = 1;
        }

        $collection = $collectionModel->getItemBy("_collection_id", $collection_id);

        if(is_numeric($collection_id) &&
           $collection && 
           $collection->switchFinal($final)){
            $return['success'] = true;  
        }else{
            $return['success'] = false;  
        }

        $return['readyForComparison'] = $collection->organization()->readyForComparison();
        
        echo json_encode($return);
    }
}
