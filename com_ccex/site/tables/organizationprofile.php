<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableOrganizationprofile extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_organization_profiles', 'org_profile_id', $db);
  }
}
