<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExControllersEdit extends JControllerBase {
  public function execute() {
    $app      = JFactory::getApplication();
    $return   = array("success"=>false);

    $_model      = $app->input->get('model', 'Profile');
    $view       = $app->input->get('view', 'Profile');
    $layout     = $app->input->get('layout', 'edit');
    $item       = $app->input->get('item', 'profile');

    $modelName  = 'CCExModels'.ucwords($_model);

    $model = new $modelName();
    $result = $model->store();

    if ( $result ) {
        foreach( $result as $key => $value ){
            $return[$key] = $value;
        }
        $return['success'] = true;
        $return['message'] = JText::_('COM_CCEX_' . strtoupper($_model) . '_UPDATE_SUCCESS');
    }else{
        $return['message'] = JText::_('COM_CCEX_' . strtoupper($_model) . '_UPDATE_FAILURE');
    }
    
    echo json_encode($return);
  }
}
