<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExViewsAnalyseHtml extends JViewHtml
{
    function render() {
        $app = JFactory::getApplication();
        $layout = $app->input->get('layout');
        
        $userModel = new CCExModelsUser();
        $organization = $userModel->organization();
        
        if (!$organization) {
            $app->enqueueMessage(JText::_('COM_CCEX_ORGANIZATION_REQUIRED_MSG'), "notice");
            $app->redirect(JRoute::_('index.php?view=organization&layout=add', false));
        }
        
        switch ($layout) {
            case "self":
                $compareSelf = new CCExModelsCompareself();
                $compareSelf->set("_organization", $organization);

                $this->collections = $organization->collections();
                
                $beginOfFirstInterval = $compareSelf->beginOfFirstInterval();
                $begin = $beginOfFirstInterval["begin_of_first_interval"];
                
                $masterSeriesAndCategories = $compareSelf->seriesAndCategories();
                $masterCategories = $masterSeriesAndCategories["categories"];
                $masterSeries = $masterSeriesAndCategories["series"];
                
                $seriesAndCategories = $compareSelf->seriesAndCategories(array(), $begin);
                $categories = $seriesAndCategories["categories"];
                $series = $seriesAndCategories["series"];
                
                $this->_financialAccounting = CCExHelpersView::load('Analyse', '_self_financialaccounting', 'phtml');
                $this->_financialAccounting->beginOfFirstInterval = $beginOfFirstInterval;
                $this->_financialAccounting->masterCategories = json_encode($masterCategories);
                $this->_financialAccounting->masterSeries = json_encode($masterSeries["financial_accounting"]);
                $this->_financialAccounting->series = json_encode($series["financial_accounting"]);
                $this->_financialAccounting->categories = json_encode($categories);
                
                $this->_activities = CCExHelpersView::load('Analyse', '_self_activities', 'phtml');
                $this->_activities->beginOfFirstInterval = $beginOfFirstInterval;
                $this->_activities->masterCategories = json_encode($masterCategories);
                $this->_activities->masterSeries = json_encode($masterSeries["activities"]);
                $this->_activities->series = json_encode($series["activities"]);
                $this->_activities->categories = json_encode($categories);       

                if(count($masterCategories) > 5 ){ 
                    $this->_financialAccounting->master = true;
                    $this->_activities->master = true;
                }else{
                    $this->_financialAccounting->master = false;
                    $this->_activities->master = false;
                }

                break;

            case "global":
                $compareGlobal = new CCExModelsCompareglobal();
                $compareGlobal->set("_organization", $organization);

                $series = $compareGlobal->series();

                $this->_financialAccounting = CCExHelpersView::load('Analyse', '_global_financialaccounting', 'phtml');
                $this->_financialAccounting->series = json_encode($series["financial_accounting"]);

                $this->_activities = CCExHelpersView::load('Analyse', '_global_activities', 'phtml');
                $this->_activities->series = json_encode($series["activities"]);

                $this->options = $compareGlobal->otherOrganizationCostsOptions();
                $this->collections = $organization->collections();
                $this->organization = $organization;
                break;

            default:
                break;
        }
        
        return parent::render();
    }
}
