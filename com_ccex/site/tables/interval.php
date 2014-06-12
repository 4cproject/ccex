<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableInterval extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_interval', 'interval_id', $db);
  }
}
