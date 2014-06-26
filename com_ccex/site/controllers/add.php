<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExControllersAdd extends JControllerBase {
  public function execute() {
    $app      = JFactory::getApplication();
    $return   = array("success"=>false);

    $_model  = $app->input->get('model', 'Cost');
    $view       = $app->input->get('view', 'Cost');
    $layout     = $app->input->get('layout', 'add');
    $item       = $app->input->get('item', 'cost');

    $modelName  = 'CCExModels'.ucwords($_model);

    $model = new $modelName();
    $result = $model->store();

    if ( $result ) {
        foreach( $result as $key => $value ){
            $return[$key] = $value;
        }
        $return['success'] = true;
        $return['message'] = JText::_('COM_CCEX_' . strtoupper($_model) . '_CREATE_SUCCESS');
    }else{
        $return['message'] = JText::_('COM_CCEX_' . strtoupper($_model) . '_CREATE_FAILURE');
    }
    
    echo json_encode($return);
  }

}
