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
}
