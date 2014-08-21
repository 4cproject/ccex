<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsCountry extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
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
    
    /**
     * Builds the query to be used by the Country model
     * @return   object  Query object
     */
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('c.country_id, c.name');
        $query->from('#__ccex_countries as c');
        
        return $query;
    }
    
    /**
     * Builds the filter for the query
     * @param    object  Query object
     * @return   object  Query object
     */
    protected function _buildWhere(&$query) {
        
        if (is_numeric($this->_country_id)) {
            $query->where('c.country_id = ' . (int)$this->_country_id);
        }
        
        $query->where('c.deleted = ' . (int)$this->_deleted);
        
        return $query;
    }

    /**
     * Override the default store
     *
     */
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $row_country = JTable::getInstance('country', 'Table');
        if (!$row_country->bind($data["country"])) {
            return null;
        }
        
        $row_country->modified = $date;
        if (!$row_country->check()) {
            return null;
        }
        
        try {
            if (!$row_country->store()) {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
        
        $return = array('country_id' => $row_country->country_id);
        
        return $return;
    }
    
    /**
     * Delete a Country
     * @param int      ID of the Country to delete
     * @return boolean True if successfully deleted
     */
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
