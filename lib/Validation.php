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
        //var_dump($empty);
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
        $pattern = '/[%s%s]/i';
        $pattern = sprintf($pattern, $this->currency->getMajorSign(), $this->currency->getMinorSign());
        $data = preg_replace($pattern, "", $digit);
        if (is_numeric($data)) {
            if ($data > 10000) {
                $this->addError("TOO BIG");    
            } else {
                return true;
            }
        } 
        $this->addError("Please enter a numerical amount of money!");
        return false;
    }
    
    /**
     * 
     * @deprecated since version 00001
     */
    public function inputMaxLength($length) {
        $a = strlen($length);
        var_dump($a);
        var_dump($length);
        if ($a > 11) {
            $this->addError("Please enter a shorter value!");
        }
    }
    
    public function cleanData($sign) {
        if (strpos($sign, $this->currency->getMajorSign()) !== false) {
            $sign = str_ireplace($this->currency->getMajorSign(), $this->currency->getMajorSign(), $sign);
        } 
        var_dump($sign);
        if (strpos($sign, $this->currency->getMinorSign()) !== false) {
            $sign = str_ireplace($this->currency->getMinorSign(), $this->currency->getMinorSign(), $sign);
        }
        return $sign;
    }
    
    protected function addError($message) {
        $this->validationErrors[] = $message;
    }
    
    public function getErrors() {
        return $this->validationErrors;
    }
}
