<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExHelpersTag
{
    static function formatCurrency($value) {
        if ($value < 0.01 || $value > 99999999) {
            return sprintf('%.2e', $value);
        } else if (is_float($value)) {
            return number_format($value, 2);
        } else {
            return number_format($value);
        }
    }
    
    static function formatCurrencyWithSymbol($value, $symbol) {
        return sprintf('%s%s', $symbol, CCExHelpersTag::formatCurrency($value));
    }
    
    static function formatWithSymbol($value, $symbol) {
        return sprintf('%s%s', $symbol, $value);
    }
    
    static function formatBoolean($boolean) {
        if ($boolean) {
            return "Yes";
        } else {
            return "No";
        }
    }
}
