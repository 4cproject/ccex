<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsConfiguration extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_configuration_id = null;
    protected $_identifier = null;
    protected $_pagination = null;
    protected $_total = null;
    
    function __construct() {
        parent::__construct();
    }
    
    public function getItem() {
        if (!is_numeric($this->_configuration_id) && !$this->_identifier) {
            return null;
        }
        
        $configuration = parent::getItem();
        
        if ($configuration) {
            return CCExHelpersCast::cast('CCExModelsConfiguration', $configuration);
        }
    }
    
    /**
     * Builds the query to be used by the Configuration model
     * @return   object  Query object
     */
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('t.configuration_id, t.name, t.identifier, t.value, t.data_type');
        $query->from('#__ccex_configurations as t');
        
        return $query;
    }
    
    /**
     * Builds the filter for the query
     * @param    object  Query object
     * @return   object  Query object
     */
    protected function _buildWhere(&$query) {
        if (is_numeric($this->_configuration_id)) {
            $query->where('t.configuration_id = ' . (int)$this->_configuration_id);
        }else{
            if($this->_identifier){
                $query->where('t.identifier = \'' . $this->_identifier . '\'');
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
        
        $row_configuration = JTable::getInstance('configuration', 'Table');
        if (!$row_configuration->bind($data["configuration"])) {
            return null;
        }
        
        $row_configuration->modified = $date;
        if (!$row_configuration->check()) {
            return null;
        }

        try {
            if (!$row_configuration->store()) {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }

        if (!$row_configuration->store()) {
            return null;
        }
        
        $return = array('configuration_id' => $row_configuration->configuration_id);
        
        return $return;
    }
    
    /**
     * Delete a Configuration
     * @param int      ID of the Configuration to delete
     * @return boolean True if successfully deleted
     */
    public function delete($id = null) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('configuration_id');
        
        if ($id) {
            $configuration = JTable::getInstance('configuration', 'Table');
            $configuration->load($id);
            
            if ($configuration->delete()) {
                return true;
            }
        }
        
        return false;
    }

    public function configurationValue($identifier, $default = null){
        $configurationModel = new CCExModelsConfiguration();
        $configuration = $configurationModel->getItemBy("_identifier", $identifier);

        if($configuration){
            return $configuration->value;
        }else{
            return $default;
        }
    }
}
