<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class CCExModelsCompareglobal extends CCExModelsDefault {

  /**
  * Protected fields
  **/
  protected $_organization                    = null;
  protected $_organizationSeriesAndCategories = null;

  function __construct() {
    parent::__construct();  
  }
}
