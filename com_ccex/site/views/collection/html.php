<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExViewsCollectionHtml extends JViewHtml
{
    function render() {
        $app = JFactory::getApplication();
        $layout = $app->input->get('layout');
        $new_year = $app->input->get('new_year');
        $active_interval = $app->input->get('active_interval');
        
        $collection_id = $app->input->get('collection_id', null);
        
        $userModel = new CCExModelsUser();
        $collectionModel = new CCExModelsCollection();
        
        $organization = $userModel->organization();
        if (!$organization) {
            /*$app->enqueueMessage(JText::_('COM_CCEX_ORGANIZATION_REQUIRED_MSG'), "notice");*/
            $app->redirect(JRoute::_('index.php?view=organization&layout=add', false));
        }
        
        switch ($layout) {
            case "add":
                $collection = $collectionModel;
                $this->organization = $organization;
                
                $this->_formView = CCExHelpersView::load('Collection', '_form', 'phtml');
                $this->_formView->collection = $collection;
                $this->_formView->organization = $organization;
                $this->_formView->new_interval = $collection->newInterval();
                $this->_formView->intervals = $collection->intervals();
                $this->_formView->interval = $this->_formView->new_interval;
                
                $this->_formView->_intervalFormView = CCExHelpersView::load('Interval', '_form', 'phtml');
                $this->_formView->_intervalFormView->interval = $this->_formView->new_interval;
                
                $this->_formView->_intervalFormView->_indexCost = CCExHelpersView::load('Cost', '_index', 'phtml');
                break;

            case "edit":
                $collection = $collectionModel->getItemBy("_collection_id", $collection_id);
                
                if (!$collection) {
                    $app->enqueueMessage(JText::_('COM_CCEX_ERROR_NOT_FOUND'), "error");
                    $app->redirect(JRoute::_('index.php?view=analyse&layout=global', false));
                }
                
                $this->collection = $collection;
                $this->organization = $organization;
                
                $this->_formView = CCExHelpersView::load('Collection', '_form', 'phtml');
                $this->_formView->collection = $collection;
                $this->_formView->organization = $organization;
                $this->_formView->_intervalFormView = CCExHelpersView::load('Interval', '_form', 'phtml');
                $this->_formView->_intervalFormView->_indexCost = CCExHelpersView::load('Cost', '_index', 'phtml');
                
                if ($new_year) {
                    $this->_formView->new_interval = $collection->newInterval();
                    $this->_formView->intervals = $collection->intervals();
                    $this->_formView->interval = $collection->newInterval();
                    $this->_formView->_intervalFormView->interval = $this->_formView->new_interval;
                } else {
                    $this->_formView->active_interval = $collection->activeInterval($active_interval);
                    $this->_formView->intervals = $collection->intervals();
                    $this->_formView->interval = $collection->activeInterval($active_interval);
                    $this->_formView->_intervalFormView->interval = $this->_formView->active_interval;
                }
                break;

            default:
                break;
        }
        
        return parent::render();
    }
}
