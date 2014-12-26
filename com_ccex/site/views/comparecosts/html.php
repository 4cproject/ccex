<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExViewsComparecostsHtml extends JViewHtml
{
    function render() {
        $app = JFactory::getApplication();
        $layout = $app->input->get('layout');
        
        $userModel = new CCExModelsUser();
        $organization = $userModel->organization();

        if(!$userModel->isGuest()) {
            if (!$organization) {
                $app->enqueueMessage(JText::_('COM_CCEX_ORGANIZATION_REQUIRED_MSG'), "notice");
                $app->redirect(JRoute::_('index.php?view=organization&layout=add', false));
            }

            if($layout == "start"){
                $app->redirect(JRoute::_('/compare-costs?view=analyse&layout=global'));
            }
        }
        
        switch ($layout) {
            case "datasets":
                $this->organization = $organization;

                $this->_utilitiesOrganization = CCExHelpersView::load('Organization', '_utilities', 'phtml');
                $this->_utilitiesOrganization->organization = $organization;
                
                $this->_showOrganization = CCExHelpersView::load('Organization', '_show', 'phtml');
                $this->_showOrganization->organization = $organization;
                
                $this->_indexCollection = CCExHelpersView::load('Collection', '_index', 'phtml');
                $this->_indexCollection->collections = $organization->collections();
                $this->_indexCollection->_showCollection = CCExHelpersView::load('Collection', '_show', 'phtml');
                $this->_indexCollection->_showCollection->_indexInterval = CCExHelpersView::load('Interval', '_index', 'phtml');
                $this->_indexCollection->_showCollection->_indexInterval->_showInterval = CCExHelpersView::load('Interval', '_show', 'phtml');
                $this->_indexCollection->_showCollection->_indexInterval->_showInterval->_indexCost = CCExHelpersView::load('Cost', '_index', 'phtml');
                break;

            case "start":
                break;

            default:
                break;
        }
        
        return parent::render();
    }
}
