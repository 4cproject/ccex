<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableCollection extends JTable {                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
  function __construct( &$db ) {
    parent::__construct('#__ccex_collections', 'collection_id', $db);
  }
}
