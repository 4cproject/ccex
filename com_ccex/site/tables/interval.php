<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableInterval extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_ìnterval', 'interval_id', $db);
  }
}
