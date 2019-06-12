<?php

namespace Tests;

use \PHPUnit\Framework\TestCase;
use App\Library\Investor;

class InvestorTest extends TestCase
{

    protected $investor;

    protected function setUp()
    {
        $this->investor = new Investor(1 , 'Investor 1', 1000);
    }

    protected function tearDown()
    {
        $this->investor = NULL;
    }

    public function testSetWalletAmount()
    {
        $this->investor->setWalletAmount(500);
        $this->assertEquals(500, $this->investor->wallet);
    }

    public function testReduceWallet()
    {
        $this->investor->setWalletAmount(500);
        $this->investor->setWalletAmount($this->investor->wallet - 300);
        $this->assertEquals(200, $this->investor->wallet);
    }

    public function addIsEnoughAmountData() {
        return array(
            array(1000, 500, true),
            array(600, 700, false),
        );
    }

    /**
     * @dataProvider addIsEnoughAmountData
     */
    public function testIsEnoughAmount($walet, $amount, $expected)
    {
        $this->investor->setWalletAmount($walet);
        $result = $this->investor->isEnoughAmount($amount);
        $this->assertEquals($expected, $result);
    }
}
