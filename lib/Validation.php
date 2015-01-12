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
    private $validationErrors = [];
    /**
     *
     * @var Coin\lib\Currencies\GBP $currency
     */
    private $currency;
    
    public function __construct($currency) {
        $this->currency = $currency;
    }

    public function isEmpty($empty) {
        //check if input is an empty string
        if (!empty($empty)) {
            return true;
        }
        $this->addError("Please enter something!");
        return false;
    }
    
    public function nonNumericCharacter($subject) {
        $pattern = '/[^%s0-9%s%s]+/i';
        $pattern = sprintf($pattern, $this->currency->getMajorSign(), $this->currency->getMinorSign(), $this->currency->getDivider());
        $data = preg_match($pattern, $subject);
        
        if (!$data) {
            return true;
        }
        $this->addError("Please enter a valid amount!");
        return false;
    }
    
    public function numeric($digit) {
        //check if a number has been entered
        $data = preg_replace('/[£p]/i', "", $digit);
        if (is_numeric($data)) {
            return true;
        } 
        $this->addError("Please enter money!");
        return false;
    }
    
    protected function addError($message) {
        $this->validationErrors[] = $message;
    }
    
    public function getErrors() {
        return $this->validationErrors;
    }
}
