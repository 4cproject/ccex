<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableCountry extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_countries', 'country_id', $db);
  }
}
