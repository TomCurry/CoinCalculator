<?php
namespace Coin\tests;
/**
 * Description of ValidationTest
 *
 * @author tom
 */
class ValidationTest extends \PHPUnit_Framework_TestCase {
    protected function setUp() {
        parent::setUp();
        $currency = $this->getMockBuilder("Coin\lib\Currencies\GBP")
                ->setMethods(['getMajorSign', 'getMinorSign', 'getDivider'])
                ->getMock();
        $currency->method('getMajorSign')
                ->willReturn('£');
        $currency->method('getMinorSign')
                ->willReturn('p');
        $currency->method('getDivider')
                ->willReturn('.');
        
        $this->validation = new \Coin\lib\Validation($currency);
        
    }
    
    protected function tearDown() {
        parent::tearDown();
        unset($this->validation);
    }
    
    public function providerValidationInput() {
        return [
            ['4', true],
            ['85', true],
            ['197p', true],
            ['2p', true],
            ['1.87', true],
            ['£1.23', true],
            ['£2', true],
            ['£10', true],
            ['£1.87p', true],
            ['£1p', true],
            ['£1.p', true],
            ['001.41p', true],
            ['4.235p', true],
            ['£1.257422457p', true],
            ['', false],
            ['1x', false],
            ['£1x.0p', false],
            ['£p', false]
        ];
    }
    
    public function providerEmpty() {
        return [
            ['', false],
            ['£1.50p', true]
        ];
    }
    
    public function providerNoNumerics() {
                return [
            ['4', true],
            ['85', true],
            ['197p', true],
            ['2p', true],
            ['1.87', true],
            ['£1.23', true],
            ['£2', true],
            ['£10', true],
            ['£1.87p', true],
            ['£1p', true],
            ['£1.p', true],
            ['001.41p', true],
            ['4.235p', true],
            ['£1.257422457p', true],
            ['1x', false],
            ['£1x.0p', false],
        ];
    }
    
    public function providerNumerics() {
                return [
            ['4', true],
            ['85', true],
            ['197p', true],
            ['2p', true],
            ['1.87', true],
            ['£1.23', true],
            ['£2', true],
            ['£10', true],
            ['£1.87p', true],
            ['£1p', true],
            ['£1.p', true],
            ['10000', true],
            ['10001', false],
            ['0.0.0.0', false],
            ['£p', false],
            ['', false]
        ];
    }
    
    public function providerCleanData() {
        return[
            ['£1.89p', '£1.89p'],
            ['££1.23', '£1.23'],
            ['£5', '£5'],
            ['££4', '£4'],
            ['99p', '99p'],
            ['5', '5'],
            ['53ppp', '53p'],
            ['5PPP', '5p']
        ];
    }
    
    /**
     * @param string $value
     * @param boolean $expected
     * @dataProvider providerEmpty
     */
    public function testIfInputIsEmpty($value, $expected) {
        $result = $this->validation->isEmpty($value);
        $this->assertEquals($expected, $result);
    }
    
    /**
     * @param string $value
     * @param boolean $expected
     * @dataProvider providerNoNumerics
     */
    public function testToCheckIfNoNumerics($value, $expected) {
        $result = $this->validation->nonNumericCharacter($value);
        $this->assertEquals($expected, $result);
    }
    
    /**
     * @param string $value
     * @param boolean $expected
     * @dataProvider providerNumerics
     */
    public function testNumericData($value, $expected) {
        $result = $this->validation->numeric($value);
        $this->assertEquals($expected, $result);
    }
    
    /**
     * @param string $value
     * @param string $expected
     * @dataProvider providerCleanData
     */
    public function testCleaningData($value, $expected) {
        $result = $this->validation->cleanData($value);
        $this->assertEquals($expected, $result);
    }
    
    public function testGettingErrors() {
        $result = $this->validation->getErrors();
        $this->assertInternalType('array', $result);
        $count = count($result);
        $this->assert(0, $count);
    }
}
