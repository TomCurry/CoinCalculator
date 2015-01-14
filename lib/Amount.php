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
        do {
            foreach ($this->currency->getCoins() as $coin) {
                if ($totalInPence >= $coin['amount']) {
                    $totalInPence -= $coin['amount'];
                    $this->coins[$coin['coin']][] = $coin;
                    break;
                }
            }
        } while ($totalInPence > 0);
    } 
}
