<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsProfile extends CCExModelsDefault
{

  //Define class level variables
  var $_user_id     = null;

  function __construct()
  {

    $app = JFactory::getApplication();

    //If no User ID is set to current logged in user
    $this->_user_id = $app->input->get('profile_id', JFactory::getUser()->id);

    parent::__construct();       
  }

  function getItem()
  {
    $profile = JFactory::getUser($this->_user_id);

    return $profile;
  }
 
  protected function _buildQuery()
  {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    return $query;
  }

  protected function _buildWhere($query)
  {
    return $query;
  }

}
