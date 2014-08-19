<?php
defined('_JEXEC') or die('Restricted access');

class CCExControllersContact extends JControllerBase
{
    public function execute() {
        $app = JFactory::getApplication();
        
        $userModel = new CCExModelsUser();
        $contactModel = new CCExModelsContact();

        $organization = $userModel->organization();
        $data = JRequest::get('post');
        
        if (array_key_exists("recipient_organization_id", $data) &&
            array_key_exists("message", $data) &&
            $contactModel->contact($organization->organization_id, $data["recipient_organization_id"], $data["message"])) {

            $app->enqueueMessage(JText::_('COM_CCEX_CONTACT_SUCCESS'), "message");
        } else {
            $app->enqueueMessage(JText::_('COM_CCEX_CONTACT_FAILURE'), "error");
        }
        
        if(array_key_exists("recipient_organization_id", $data)){
            $app->redirect(JRoute::_('/compare-costs?view=analyse&layout=peer&organization=' . $data["recipient_organization_id"], false));
        }else{
            $app->redirect(JRoute::_('/compare-costs?view=analyse&layout=peer', false));
        }
    }
}
