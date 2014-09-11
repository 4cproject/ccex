<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsCurrency extends CCExModelsDefault
{
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
    
    public function getItemUnrestricted() {
        return $this->getItem();
    }

    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('c.currency_id, c.name, c.symbol, c.code');
        $query->from('#__ccex_currencies as c');
        
        return $query;
    }
    
    protected function _buildWhere(&$query) {
        if (is_numeric($this->_currency_id)) {
            $query->where('c.currency_id = ' . (int)$this->_currency_id);
        }
        
        $query->where('c.deleted = ' . (int)$this->_deleted);
        return $query;
    }

    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $row_currency = JTable::getInstance('currency', 'Table');
        if (!$row_currency->bind($data["currency"])) {
            return null;
        }
        
        $row_currency->modified = $date;
        
        try {
            if (!$row_currency->check() || !$row_currency->store()) {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
        
        $return = array('currency_id' => $row_currency->currency_id);
        return $return;
    }
    
    public function delete($id = null) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('currency_id');
        
        if ($id) {
            $currency = JTable::getInstance('currency', 'Table');
            $currency->load($id);
            
            if ($currency->delete()) {
                return true;
            }
        }
        
        return false;
    }
}
