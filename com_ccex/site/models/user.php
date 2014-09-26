<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsUser extends CCExModelsDefault
{
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
    
    public function isAdmin() {
        return $this->user->get('isRoot') || in_array(7, $this->user->getAuthorisedGroups() );
    }

    public function isGuest() {
        return $this->user->get('guest');
    }
    
    public function user() {
        return $this->user;
    }
    
    public function getUserByID($id) {
        $table = JUser::getTable();
        
        if ($table->load($id)) {
            return JFactory::getUser($id);
        } else {
            return null;
        }
    }
}
