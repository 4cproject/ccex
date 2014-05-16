<?php 
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExControllersEditprofile extends CCExControllersDefault {
  public function execute() {
    $app      = JFactory::getApplication();

    $profileModel = new CCExModelsProfile();
    
    if($row = $profileModel->edit()){
    	$app->enqueueMessage(JText::_('COM_CCEX_SUCCESS_UPDATING_USER'), 'message');
    }else{
    	$app->enqueueMessage(JText::_('COM_CCEX_ERROR_UPDATING_USER'), 'error');
    }

    return parent::execute();
  }

}
