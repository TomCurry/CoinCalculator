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
    
    private $coins = [
        [
            'coin' => '1p',
            'amount' => 1
        ],
        [
            'coin' => '2p',
            'amount' => 2
        ],
        [
            'coin' => '20p',
            'amount' => 20
        ],
        [
            'coin' => '50p',
            'amount' => 50
        ],
        [
            'coin' => '£1',
            'amount' => 100
        ],
        [
            'coin' => '£2',
            'amount' => 200
        ]
    ];
    
    public function __construct() {
        usort($this->coins, function($a, $b){
            if ($a['amount'] == $b['amount']) {
                return 0;
            } elseif ($a['amount'] < $b['amount']) {
                return 1;
            } else {
                return -1;
            }
        }); 
    }
    
    public function getTotalinDecimal($total) {
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
    
    public function getCoins() {
        return $this->coins;
    }    
}
