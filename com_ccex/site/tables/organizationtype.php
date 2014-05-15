<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableOrganizationtype extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_organization_types', 'org_type_id', $db);
  }
}
