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
    private $divider = ".";
    
    public function getTotalinDecimal($total) {
        var_dump(explode(".", $total));
        $stripped = str_replace([$this->majorSign, $this->minorSign], "", $total);
        
        if (strpos($total, $this->divider) !== false) {
            $exploded = explode(".", $stripped);
            $pounds = $exploded[0];
            $pence = $exploded[1];
        } else {
            $pounds = 0;
            $pence = $stripped;
        }
        
        return $pounds * 100 + $pence;
    }
    
    public function getMajorSign() {
        return $this->majorSign;
    }
    
    public function getMinorSign() {
        return $this->minorSign;
    }
    
    public function getDivider() {
        return $this->divider;
    }
    
}
