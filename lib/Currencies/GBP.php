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
        $stripped = str_replace($this->divider, "", $total);
        return $stripped;
        
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
