<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsProfileHtml extends JViewHtml
{
  function render()
  {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    //retrieve task list from model
    $profileModel = new CCExModelsProfile();

    switch($layout) {

      case "edit":
      break;

      default:
      break;

    }

    //display
    return parent::render();
  } 
}
