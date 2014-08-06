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
            case "index":
                break;
            case "costs":
                $costModel = new CCExModelsCost();

                $this->costs = $costModel->listItems();
                break;
            case "organization":
                $organization_id = $app->input->get('organization_id', null);
                $organizationModel = new CCExModelsOrganization();

                $organizations = $organizationModel->listItemsBy("_organization_id", $organization_id);
                $organization = array_shift($organizations);
                $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);

                $this->organization = $organization;
                break;
            case "collection":
                $collection_id = $app->input->get('collection_id', null);
                $collectionModel = new CCExModelsCollection();

                $collections = $collectionModel->listItemsBy("_collection_id", $collection_id);
                $collection = array_shift($collections);
                $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);

                $this->collection = $collection;
                break;
            case "interval":
                $interval_id = $app->input->get('interval_id', null);
                $intervalModel = new CCExModelsInterval();

                $intervals = $intervalModel->listItemsBy("_interval_id", $interval_id);
                $interval = array_shift($intervals);
                $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval);

                $this->interval = $interval;
                break;
            case "cost":
                $cost_id = $app->input->get('cost_id', null);
                $costModel = new CCExModelsCost();

                $costs = $costModel->listItemsBy("_cost_id", $cost_id);
                $cost = array_shift($costs);
                $cost = CCExHelpersCast::cast('CCExModelsCost', $cost);

                $this->currency = $cost->interval()->collection()->organization()->currency();
                $this->cost = $cost;
                break;
            default:
                break;
        }
        
        return parent::render();
    }
}
