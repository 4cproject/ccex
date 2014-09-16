<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Yahoo currency rate import class
 *
 * @author     Felix Geenen (http://www.geenen-it-systeme.de)
 * @version    1.0.3
 */
class CCExHelpersYahoofinance
{
    public static $_url = 'http://download.finance.yahoo.com/d/quotes.csv?s={{CURRENCY_FROM}}{{CURRENCY_TO}}=X&f=l1&e=.csv';
    public static $_messages = array();
    
    /*
     * converts currency rates
     *
     * use ISO-4217 currency-codes like EUR and USD (http://en.wikipedia.org/wiki/ISO_4217)
     *
     * @param currencyFrom String base-currency
     * @param currencyTo String currency that currencyFrom should be converted to
     * @param retry int change it to 1 if you dont want the method to retry receiving data on errors
    */
    public static function _convert($currencyFrom, $currencyTo, $retry = 0) {
        $url = str_replace('{{CURRENCY_FROM}}', $currencyFrom, self::$_url);
        $url = str_replace('{{CURRENCY_TO}}', $currencyTo, $url);
        
        try {
            $handle = fopen($url, "r");
            
            if ($handle !== false) {
                $exchange_rate = fread($handle, 2000);
                
                // there may be spaces or breaks
                $exchange_rate = trim($exchange_rate);
                $exchange_rate = (float)$exchange_rate;
                
                fclose($handle);
                
                if (!$exchange_rate) {
                    echo 'Cannot retrieve rate from Yahoofinance';
                    return false;
                }
                return (float)$exchange_rate * 1.0;
                
                // change 1.0 to influence rate;
                
                
            }
        }
        catch(Exception $e) {
            if ($retry == 0) {
                
                // retry receiving data
                self::_convert($currencyFrom, $currencyTo, 1);
            } else {
                echo 'Cannot retrieve rate from Yahoofinance';
                return false;
            }
        }
    }
}
