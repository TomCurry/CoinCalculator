<?php
namespace Coin\lib\Currencies;
use Coin\lib\Currencies\CurrencyInterface;

/**
 * Description of GBP
 *
 * @author tom
 */
class GBP implements CurrencyInterface {
    
    private $majorSign = "£";
    private $minorSign = "p";
    
    public function getTotalinDecimal($total) {
        return "biscuits";
//check for £ sign
            //multiply pounds by 100 and add to number of pence
        //if not £ sign work out number of pence
        //check if theres a dot
    }
    
}
