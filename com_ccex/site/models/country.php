<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsCountry extends CCExModelsDefault
{
    protected $_country_id = null;
    protected $_name = null;
    protected $_pagination = null;
    protected $_total = null;
    protected $_deleted = 0;
    
    function __construct() {
        parent::__construct();
    }
    
    public function getItem() {
        if (!is_numeric($this->_country_id)) {
            return null;
        }
        
        $country = parent::getItem();
        
        if ($country) {
            return CCExHelpersCast::cast('CCExModelsCountry', $country);
        }
    }
    
    public function getItemUnrestricted() {
        return $this->getItem();
    }
    
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('c.country_id, c.name');
        $query->from('#__ccex_countries as c');
        
        return $query;
    }
    
    protected function _buildWhere(&$query) {
        if (is_numeric($this->_country_id)) {
            $query->where('c.country_id = ' . (int)$this->_country_id);
        }
        
        $query->where('c.deleted = ' . (int)$this->_deleted);
        
        return $query;
    }
    
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $row_country = JTable::getInstance('country', 'Table');
        if (!$row_country->bind($data["country"])) {
            return null;
        }
        
        $row_country->modified = $date;
        
        try {
            if (!$row_country->check() || !$row_country->store()) {
                return null;
            }
        }
        catch(Exception $e) {
            return null;
        }
        
        $return = array('country_id' => $row_country->country_id);
        return $return;
    }
    
    public function delete($id = null) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('country_id');
        
        if ($id) {
            $country = JTable::getInstance('country', 'Table');
            $country->load($id);
            
            if ($country->delete()) {
                return true;
            }
        }
        
        return false;
    }
}
