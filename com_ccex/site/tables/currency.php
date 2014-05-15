<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableCurrency extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_currencies', 'currency_id', $db);
  }
}
