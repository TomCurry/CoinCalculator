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
    
    public function isEmpty($empty) {
        //check if input is an empty string
        if (!empty($empty)) {
            return true;
        }
        $this->addError("Please enter something!");
        return false;
    }
    
    public function nonNumericCharacter($subject) {
        $data = preg_match('/[^£0-9p.]+/i', $subject);
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
