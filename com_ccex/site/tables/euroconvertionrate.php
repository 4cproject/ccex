<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableEuroconvertionrate extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_euro_convertion_rates', 'euro_convertion_id', $db);
  }
}
