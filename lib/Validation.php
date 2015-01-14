<?php
namespace Coin\lib;
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
        $this->addError("Please enter an amount of money!");
        return false;
    }
    
    public function nonNumericCharacter($subject) {
        $pattern = '/[^%s0-9%s%s]+/i';
        $pattern = sprintf($pattern, $this->currency->getMajorSign(), $this->currency->getMinorSign(), $this->currency->getDivider());
        $data = preg_match($pattern, $subject);
        
        if (!$data) {
            return true;
        }
        $this->addError("Please don't enter letters!");
        return false;
    }
    
    public function numeric($digit) {
        //check if a number has been entered
        $pattern = '/[%s%s]/i';
        $pattern = sprintf($pattern, $this->currency->getMajorSign(), $this->currency->getMinorSign());
        $data = preg_replace($pattern, "", $digit);
        if (is_numeric($data)) {
            return true;
        } 
        $this->addError("Please enter a numerical amount of money!");
        return false;
    }
    
    protected function addError($message) {
        $this->validationErrors[] = $message;
    }
    
    public function getErrors() {
        return $this->validationErrors;
    }
}
