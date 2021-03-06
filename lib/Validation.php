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
                $this->addError("Please enter a smaller amount.");    
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
        $pattern = '/[%s]+/i';
        $pattern = sprintf($pattern, $this->currency->getMajorSign());
        
        if (strpos($sign, $this->currency->getMajorSign()) !== false) {
            $sign = preg_replace($pattern, $this->currency->getMajorSign(), $sign);
        } 
        
        $pattern = '/[%s]+/i';
        $pattern = sprintf($pattern, $this->currency->getMinorSign());
        
        if (stripos($sign, $this->currency->getMinorSign()) !== false) {
            $sign = preg_replace($pattern, $this->currency->getMinorSign(), $sign);
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
