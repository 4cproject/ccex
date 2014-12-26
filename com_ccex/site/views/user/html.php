<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExViewsUserHtml extends JViewHtml
{
    function render() {
        $app = JFactory::getApplication();
        $layout = $app->input->get('layout');
        $wizard = $app->input->get('wizard', null);
        
        $userModel = new CCExModelsUser();
        
        switch ($layout) {
            case "profile":
                $this->user = $userModel->user();
                $this->organization = $userModel->organization();

                if($this->organization){
                    $this->collections = $this->organization->collections();
                }

                $this->wizard = $wizard;
                break;
            default:
                break;
        }
        
        return parent::render();
    }
}
