<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExViewsUserHtml extends JViewHtml
{
    function render() {
        $app = JFactory::getApplication();
        $layout = $app->input->get('layout');
        
        $userModel = new CCExModelsUser();
        
        switch ($layout) {
            case "profile":
                $this->user = $userModel->user();
                $this->organization = $userModel->organization();
                break;
            default:
                break;
        }
        
        return parent::render();
    }
}
