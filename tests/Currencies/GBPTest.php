<?php
namespace Coin\tests\Currencies;
/**
 * Description of GBPTest
 *
 * @author tom
 */
class GBPTest extends \PHPUnit_Framework_TestCase {
    protected function setUp() {
        parent::setUp();
    }

    protected function tearDown() {
        parent::tearDown();
    }
    
    public function providerCurrency() {
        return [
            ["£10.99", 1099],
            ["85p", 85],
            ["101", 101],
            ["£1.23p", 123],
            ["£10", 1000]
        ];
    }
    
    /**
     * 
     * @param string $value
     * @param int $expected
     * @dataProvider providerCurrency
     */
    public function testConvertingToPence($value, $expected) {
        $currency = new \Coin\lib\Currencies\GBP;
        $result = $currency->getTotalinDecimal($value);
        $this->assertEquals($expected, $result);
    }
    
    public function testGettingMajorSign() {
        $currency = new \Coin\lib\Currencies\GBP;
        $result = $currency->getMajorSign();
        $expected = "£";
        $this->assertEquals($result, $expected);
    }
    
    public function testGettingMinorSign() {
        $currency = new \Coin\lib\Currencies\GBP;
        $result = $currency->getMinorSign();
        $expected = "p";
        $this->assertEquals($result, $expected);
    }
    
    public function testGettingDividerSign() {
        $currency = new \Coin\lib\Currencies\GBP;
        $result = $currency->getDivider();
        $expected = ".";
        $this->assertEquals($result, $expected);
    }
    
    public function testGettingCoins() {
        $currency = new \Coin\lib\Currencies\GBP;
        $result = $currency->getCoins();
        $this->assertInternalType('array', $result);
        $count = count($result);
        $this->assertGreaterThan(1, $count);
    }
}
