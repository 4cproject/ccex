<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableContact extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_contacts', 'contact_id', $db);
  }
}
