<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableOrganizationorgtype extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_organization_org_types', 'organization_org_type_id', $db);
  }
}
