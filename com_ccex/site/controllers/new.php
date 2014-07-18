<?php
defined('_JEXEC') or die('Restricted access');

class CCExControllersNew extends JControllerBase
{
    public function execute() {
        $app = JFactory::getApplication();
        $return = array("success" => false);
        
        $_model = $app->input->get('model', 'Profile');
        $view = $app->input->get('view', 'Profile');
        $layout = $app->input->get('layout', 'edit');
        $item = $app->input->get('item', 'profile');
        
        $modelName = 'CCExModels' . ucwords($_model);
        
        $model = new $modelName();
        if ($row = $model->store()) {
            $return['success'] = true;
            $return['message'] = JText::_('COM_CCEX_' . strtoupper($_model) . '_CREATE_SUCCESS');
            $return['html'] = CCExHelpersView::getHtml($view, $layout, $item, $row);
        } else {
            $return['message'] = JText::_('COM_CCEX_' . strtoupper($_model) . '_CREATE_FAILURE');
        }
        
        echo json_encode($return);
    }
}
