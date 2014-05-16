<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableOrganization extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_organizations', 'organization_id', $db);
  }
}
