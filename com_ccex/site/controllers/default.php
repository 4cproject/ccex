<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExControllersDefault extends JControllerBase
{
    public function execute() {
        
        // Get the application
        $app = $this->getApplication();
        
        // Get the document object.
        $document = JFactory::getDocument();
        
        $viewName = $app->input->getWord('view', 'analyse');
        $viewFormat = $document->getType();
        $layoutName = $app->input->getWord('layout', 'global');
        
        $user = JFactory::getUser();
        if ($user->get('guest') && ($viewName != "comparecosts" || ($layoutName != "start" && $layoutName != "tour"))) {
            $app->enqueueMessage(JText::_('COM_CCEX_ACCOUNT_REQUIRED_MSG'), "warning");
            $app->redirect(JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseglobal'));
        }

        $app->input->set('view', $viewName);
        
        // Register the layout paths for the view
        $paths = new SplPriorityQueue;
        $paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');
        
        $viewClass = 'CCExViews' . ucfirst($viewName) . ucfirst($viewFormat);
        $modelClass = 'CCExModels' . ucfirst($viewName);
        
        if (false === class_exists($modelClass)) {
            $modelClass = 'CCExModelsDefault';
        }
        
        $view = new $viewClass(new $modelClass, $paths);
        
        $view->setLayout($layoutName);
        
        // Render our view.
        echo $view->render();
        
        return true;
    }
}
