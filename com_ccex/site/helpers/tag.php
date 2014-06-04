<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExHelpersTag {
	function formatCurrency($value) {
	    $currency = sprintf('%.2f', $value);  
	    while (true) { 
	        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $currency); 
	        if ($replaced != $currency) { 
	            $currency = $replaced; 
	        } else { 
	            break; 
	        } 
	    } 
	    return $currency; 
	}

	function formatCurrencyWithSymbol($value, $symbol) {
	    return sprintf('%s %s', CCExHelpersTag::formatCurrency($value), $symbol);
	}	
}
