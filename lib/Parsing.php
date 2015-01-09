<?php
namespace Coin\lib;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Amount
 *
 * @author tom
 */
class Parsing {
    
    public function currencyToNumb() {
        $fmt = new NumberFormatter('de_DE', NumberFormatter::CURRENCY);
        $num = "£1.23";
        
        echo "We have ".$fmt->parseCurrency($num, $currency)." in $currency\n";  
}

}