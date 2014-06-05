<?php  // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExViewsComparecostsHtml extends JViewHtml {
  function render() {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');

    switch($layout) {
      case "index":
        break;

      default:
        break;
    }

    return parent::render();
  } 
}
