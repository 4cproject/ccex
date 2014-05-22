<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableProfilescope extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_profile_scopes', 'profile_scope_id', $db);
  }
}
