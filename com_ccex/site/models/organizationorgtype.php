<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsOrganizationorgtype extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_org_type_id = null;
    protected $_organization_org_type_id = null;
    protected $_organization_id = null;
    protected $_pagination = null;
    protected $_total = null;
    
    function __construct() {
        parent::__construct();
    }
    
    public function getItem() {
        if (!is_numeric($this->_organization_org_type_id)) {
            return null;
        }
        
        $organizationOrgType = parent::getItem();
        
        if ($organizationOrgType) {
            return CCExHelpersCast::cast('CCExModelsOrganizationorgtype', $organizationOrgType);
        }
    }
    
    /**
     * Builds the query to be used by the OrganizationOrgType model
     * @return   object  Query object
     */
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('t.organization_org_type_id, t.org_type_id, t.organization_id');
        $query->from('#__ccex_organization_org_types as t');
        
        return $query;
    }
    
    /**
     * Builds the filter for the query
     * @param    object  Query object
     * @return   object  Query object
     */
    protected function _buildWhere(&$query) {
        
        if (is_numeric($this->_org_type_id)) {
            $query->where('t.organization_org_type_id = ' . (int)$this->_organization_org_type_id);
        } else {
            if ($this->_org_type_id) {
                $query->where("t.org_type_id = '" . (int)$this->_org_type_id . "'");
            }
            if ($this->_organization_id) {
                $query->where("t.organization_id = '" . (int)$this->_organization_id . "'");
            }
        }
        
        return $query;
    }
    
    /**
     * Override the default store
     *
     */
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $row_organization_org_type = JTable::getInstance('organizationorgtype', 'Table');
        if (!$row_organization_org_type->bind($data)) {
            return null;
        }
        
        $row_organization_org_type->modified = $date;
        if (!$row_organization_org_type->check()) {
            return null;
        }
        if (!$row_organization_org_type->store()) {
            return null;
        }
        
        return true;
    }
    
    /**
     * Delete a OrganizationOrgType
     * @param int      ID of the OrganizationOrgType to delete
     * @return boolean True if successfully deleted
     */
    public function delete($id = null) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('organization_org_type_id');
        
        if ($id) {
            $organizationOrgType = JTable::getInstance('Organizationorgtype', 'Table');
            $organizationOrgType->load($id);
            
            if ($organizationOrgType->delete()) {
                return true;
            }
        }
        
        return false;
    }
}
