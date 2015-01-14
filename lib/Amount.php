<?php

namespace Coin\lib;
/**
 * Description of Amount
 *
 * @author tom
 */
class Amount {

    private $currency;
    private $coins;

    public function __construct($currency) {
        $this->currency = $currency;
    }

    public function findCoinAmount($total) {
        $totalInPence = $this->currency->getTotalinDecimal($total);
        $this->breakdown($totalInPence);
        return $this->coins;
    }
    
    protected function breakdown($totalInPence) {
        foreach ($this->currency->getCoins() as $coin) {
            if ($totalInPence >= $coin['amount']) {
                $this->coins[] = $coin['coin'];
            } else {
                
            }
        }
    } 
    
    
    

}
