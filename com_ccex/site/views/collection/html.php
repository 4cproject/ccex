<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsCollectionHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');
    $new_year = $app->input->get('new_year');
    $intervalID = $app->input->get('new_year');

    $collectionModel = new CCExModelsCollection();
    $userModel = new CCExModelsUser();

    $organization = $userModel->organization();

    if (!$organization) {
        $app->enqueueMessage(JText::_('COM_CCEX_ORGANIZATION_REQUIRED_MSG'), "notice");
        $app->redirect(JRoute::_('index.php?view=organization&layout=add', false));
    }

    switch($layout) {
      case "add":
          $collection =  $collectionModel;
          $this->_formView = CCExHelpersView::load('Collection','_form','phtml');

          $this->_formView->collection = $collection;
          $this->_formView->organization = $organization;
          $this->_formView->new_interval = $collection->newInterval();
          $this->_formView->intervals = $collection->intervals();

          $this->_formView->_intervalFormView = CCExHelpersView::load('Interval','_form','phtml');
          $this->_formView->_intervalFormView->interval = $this->_formView->new_interval;
        break;
      case "edit":
          $collection =  $collectionModel->getItem();
          $this->_formView = CCExHelpersView::load('Collection','_form','phtml');

          $this->_formView->collection = $collection;
          $this->_formView->organization = $organization;
          $this->_formView->_intervalFormView = CCExHelpersView::load('Interval','_form','phtml');

          if($new_year){
            $this->_formView->new_interval = $collection->newInterval();
            $this->_formView->intervals = $collection->intervals();
            $this->_formView->_intervalFormView->interval = $this->_formView->new_interval;
          }else{
            $this->_formView->active_interval = $collection->activeInterval($intervalID);    
            $this->_formView->intervals = $collection->intervals();            
            $this->_formView->_intervalFormView->interval = $this->_formView->active_interval;        
          }      
        break;

      default:
        break;
    }

    return parent::render();
  } 
}
