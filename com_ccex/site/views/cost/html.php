<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExViewsCostHtml extends JViewHtml
{
    function render() {
        $app = JFactory::getApplication();
        $layout = $app->input->get('layout');
        
        $cost_id = $app->input->get('cost_id', null);
        $interval_id = $app->input->get('interval_id', null);
        
        $intervalModel = new CCExModelsInterval();
        $costModel = new CCExModelsCost();
        $userModel = new CCExModelsUser();
        $euc = new CCExModelsEuroconvertionrate();
        
        $organization = $userModel->organization();
        if (!$organization) {
            $app->enqueueMessage(JText::_('COM_CCEX_ORGANIZATION_REQUIRED_MSG'), "notice");
            $app->redirect(JRoute::_('index.php?view=organization&layout=add', false));
        }
        
        switch ($layout) {
            case "add":
                $interval = $intervalModel->getItemBy("_interval_id", $interval_id);
                
                if (!$interval) {
                    $app->enqueueMessage(JText::_('COM_CCEX_ERROR_NOT_FOUND'), "error");
                    $app->redirect(JRoute::_('index.php?view=comparecosts&layout=index', false));
                }
                
                $collection = $interval->collection();
                $currency = $organization->currency();
                
                $this->organization = $organization;
                $this->collection = $collection;
                $this->interval = $interval;
                
                $this->_formView = CCExHelpersView::load('Cost', '_form', 'phtml');
                $this->_formView->currency = $currency;
                $this->_formView->interval = $interval;
                $this->_formView->tax = $euc->taxOnInterval($interval->currency()->code, $interval->begin_year, $interval->duration);
                break;

            case "edit":
                $cost = $costModel->getItemBy("_cost_id", $cost_id);
                
                if (!$cost) {
                    $app->enqueueMessage(JText::_('COM_CCEX_ERROR_NOT_FOUND'), "error");
                    $app->redirect(JRoute::_('index.php?view=comparecosts&layout=index', false));
                }
                
                $interval = $cost->interval();
                $collection = $interval->collection();
                $currency = $organization->currency();
                
                $this->organization = $organization;
                $this->collection = $collection;
                $this->interval = $interval;
                $this->cost = $cost;
                
                $this->_formView = CCExHelpersView::load('Cost', '_form', 'phtml');
                $this->_formView->cost = $cost;
                $this->_formView->currency = $currency;
                $this->_formView->interval = $interval;
                $this->_formView->tax = $euc->taxOnInterval($interval->currency()->code, $interval->begin_year, $interval->duration);
                break;

            default:
                break;
        }
        
        return parent::render();
    }
}
