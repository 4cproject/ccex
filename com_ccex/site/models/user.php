<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsUser extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_user_id = null;
    protected $_pagination = null;
    protected $_total = null;
    protected $user = null;
    
    function __construct() {
        $app = JFactory::getApplication();
        
        $this->user = JFactory::getUser();

        $this->_user_id = $this->user->id;
        $this->user_id = $this->_user_id;

        parent::__construct();
    }
    
    public function getItem() {
        
        // $user = parent::getItem();
        
        // if($user){
        //   return CCExHelpersCast::cast('CCExModelsUser', $user);
        // }
        
        return null;
    }
    
    /**
     * Builds the query to be used by the User model
     * @return   object  Query object
     */
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        return $query;
    }
    
    /**
     * Builds the filter for the query
     * @param    object  Query object
     * @return   object  Query object
     */
    protected function _buildWhere(&$query) {
        return $query;
    }
    
    public function organization() {
        $organizationModel = new CCExModelsOrganization();
        $organization = $organizationModel->getItemBy('_user_id', $this->user_id);
        
        return $organization;
    }
    
    public function haveOrganizationPermissions($organization) {
        if ($organization && $organization->organization_id == $this->organization()->organization_id) {
            return true;
        }
        return false;
    }

    public function isAdmin(){
        return $this->user->get('isRoot');
    }

    public function user(){
        return $this->user;
    }
}
