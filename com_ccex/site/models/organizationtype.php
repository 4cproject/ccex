<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsOrganizationtype extends CCExModelsDefault
{
    protected $_org_type_id = null;
    protected $_name = null;
    protected $_pagination = null;
    protected $_total = null;
    protected $_deleted = 0;
    
    function __construct() {
        $app = JFactory::getApplication();
        parent::__construct();
    }
    
    public function getItem() {
        if (!is_numeric($this->_org_type_id)) {
            return null;
        }
        
        $organizationType = parent::getItem();
        
        if ($organizationType) {
            return CCExHelpersCast::cast('CCExModelsOrganizationtype', $organizationType);
        }
    }
    
    public function getItemUnrestricted() {
        return $this->getItem();
    }

    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('t.org_type_id, t.name');
        $query->from('#__ccex_organization_types as t');
        
        return $query;
    }
    
    protected function _buildWhere(&$query) {
        if (is_numeric($this->_org_type_id)) {
            $query->where('t.org_type_id = ' . (int)$this->_org_type_id);
        } else {
            if ($this->_name) {
                $query->where("t.name = '" . $this->_name . "'");
            }
        }
        
        $query->where('t.deleted = ' . (int)$this->_deleted);
        return $query;
    }
    
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $row_organization_type = JTable::getInstance('organizationtype', 'Table');
        if (!$row_organization_type->bind($data["organizationType"])) {
            return null;
        }
        
        $row_organization_type->modified = $date;
        
        try {
            if (!$row_organization_type->check() || !$row_organization_type->store()) {
                return null;
            }
        }
        catch(Exception $e) {
            return null;
        }
        
        $return = array('org_type_id' => $row_organization_type->org_type_id);      
        return $return;
    }
    
    public function delete($id = null) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('organizationtype_id');
        
        if ($id) {
            $organizationtype = JTable::getInstance('organizationtype', 'Table');
            $organizationtype->load($id);
            
            if ($organizationtype->delete()) {
                return true;
            }
        }
        
        return false;
    }
}
