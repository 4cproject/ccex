<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExControllersDelete extends JControllerBase{
  public function execute(){
    $app = JFactory::getApplication();

    $return = array('success'=>false);

    $type = $app->input->get('type',null);
   
    $modelName = 'CCExModels'.ucfirst($type);    
    $model = new $modelName();

    if ( $row = $model->delete() ) {
        $return['success'] = true;
        $return['msg'] = JText::_('COM_CCEX_' . strtoupper($type) . '_DELETE_SUCCESS');
    }else{
        $return['msg'] = JText::_('COM_CCEX_' . strtoupper($type) . '_DELETE_FAILURE');
    }
    echo json_encode($return);
  }
}
