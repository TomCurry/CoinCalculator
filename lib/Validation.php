<?php
namespace Coin\lib;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validation
 *
 * @author tom
 */
class Validation
{

    public function emptyString($empty) {
        //check if input is an empty string
        if (!isset($empty)) {
            echo "Please enter a valid amount!";
        }
        return $empty;
    }
    
    public function nonNumericCharacter() {
        //
    }
    
    public function missingDigits($digit) {
        //check if a number has been entered
        if (!is_numeric($digit)) {
            echo "Please enter a valid amount!";
        }
        return $digit;
    }
}
