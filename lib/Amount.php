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
class Amount 
{
    private $coins = [
                [   
                    'coin' => '1p',
                    'amount'=> 1
                ],
                [   
                    'coin' =>  '2p',
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
        
            private $currency;
           
            public function __construct($currency) {
                $this->currency = $currency;
            }
            
            public function findCoinAmount($total, $coin) {
                return $this->currency->getTotalinDecimal($total);
            }
}
