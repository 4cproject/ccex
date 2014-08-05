<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExViewsAdministrationHtml extends JViewHtml
{
    function render() {
        $app = JFactory::getApplication();
        $layout = $app->input->get('layout');

        $userModel = new CCExModelsUser();
        
        if (!$userModel->isAdmin()) {
            $app->enqueueMessage(JText::_('COM_CCEX_ERROR_PERMITIONS_MSG'), "error");
            $app->redirect(JRoute::_('index.php?view=comparecosts&layout=index'));
        }
        
        switch ($layout) {
            case "costs":
                $costModel = new CCExModelsCost();

                $this->costs = $costModel->listItems();
                break;
            default:
                break;
        }
        
        return parent::render();
    }
}
