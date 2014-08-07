<?php
defined('_JEXEC') or die('Restricted access');

class CCExControllersClearalldata extends JControllerBase
{
    public function execute() {
        $app = JFactory::getApplication();

        $return = array('success' => false);
        $userModel = new CCExModelsUser();
        $organizationModel = new CCExModelsOrganization();
        $organization = $userModel->organization();
        
        if ($organizationModel->delete($organization->organization_id)) {
            $return['success'] = true;   
        }
        
        echo json_encode($return);
    }
}
