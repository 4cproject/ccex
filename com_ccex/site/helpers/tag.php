<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExHelpersTag
{
    function formatCurrency($value) {
        // $currency = sprintf('%.2f', $value);
        // while (true) {
        //     $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $currency);
        //     if ($replaced != $currency) {
        //         $currency = $replaced;
        //     } else {
        //         break;
        //     }
        // }
        // return $currency;
        if($value < 0.01 || $value > 99999999){
            return sprintf('%.2e', $value);          
        }else if(is_float($value)){
            return number_format($value, 2);
        }else{
            return number_format($value);
        }
    }
    
    function formatCurrencyWithSymbol($value, $symbol) {
        return sprintf('%s%s',$symbol, CCExHelpersTag::formatCurrency($value));
    }
    
    function formatWithSymbol($value, $symbol) {
        return sprintf('%s%s',$symbol, $value);
    }
}
