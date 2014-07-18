<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsCurrency extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_currency_id = null;
    protected $_name = null;
    protected $_pagination = null;
    protected $_total = null;
    protected $_deleted = 0;
    
    function __construct() {
        parent::__construct();
    }
    
    public function getItem() {
        if (!is_numeric($this->_currency_id)) {
            return null;
        }
        
        $currency = parent::getItem();
        
        if ($currency) {
            return CCExHelpersCast::cast('CCExModelsCurrency', $currency);
        }
    }
    
    /**
     * Builds the query to be used by the Currency model
     * @return   object  Query object
     */
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('c.currency_id, c.name, c.symbol');
        $query->from('#__ccex_currencies as c');
        
        return $query;
    }
    
    /**
     * Builds the filter for the query
     * @param    object  Query object
     * @return   object  Query object
     */
    protected function _buildWhere(&$query) {
        
        if (is_numeric($this->_currency_id)) {
            $query->where('c.currency_id = ' . (int)$this->_currency_id);
        }
        
        $query->where('c.deleted = ' . (int)$this->_deleted);
        
        return $query;
    }
}
