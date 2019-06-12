<?php

namespace Tests;

use \PHPUnit\Framework\TestCase;
use App\Library\Tranche;

class TrancheTest extends TestCase
{
    protected $tranche;

    protected function setUp()
    {
        $this->tranche = new Tranche('A', 3, 1000);
    }

    protected function tearDown()
    {
        $this->tranche = NULL;
    }

    public function addSetInvestData() {
        return array(
            array(1000, 'Investor 1', 1, '01/03/2015', 0, 1000, true),
            array(600, 'Investor 2', 2, '10/03/2015', 600, 1000, false),
        );
    }

    /**
     * @dataProvider addSetInvestData
     */
    public function testSetInvest($amount, $name, $id, $date, $start_amount, $max_amount, $expected)
    {
        $this->tranche->amount = $start_amount;
        $this->tranche->max_amount = $max_amount;
        $result = $this->tranche->setInvest($amount, $name, $id, $date);
        $this->assertEquals($expected, $result);
    }

    public function addSetInvestorData() {
        return array(
            array(1000, 'Investor 1', 1, '01/03/2015'),
            array(600, 'Investor 2', 2, '10/03/2015'),
        );
    }

    /**
     * @dataProvider addSetInvestorData
     */
    public function testSetInvestor($amount, $name, $id, $date)
    {
        $this->tranche->setInvestor($amount, $name, $id, $date);
        $this->assertNotEmpty($this->tranche->investors);
    }

    public function testSetAmount()
    {
        $this->tranche->setAmount(700);
        $this->assertEquals(700, $this->tranche->amount);
    }

    public function testSetMaxAmount()
    {
        $this->tranche->setMaxAmount(1000);
        $this->assertEquals(1000, $this->tranche->max_amount);
    }

    public function addIsAvailableData() {
        return array(
            array(500, 0, 1000, true),
            array(600, 500, 1000, false),
        );
    }
    /**
     * @dataProvider addIsAvailableData
     */
    public function testIsAvailableTranche($amount, $start_amount, $max_amount, $expected)
    {
        $this->tranche->amount = $start_amount;
        $this->tranche->max_amount = $max_amount;
        $result = $this->tranche->isAvailableTranche($amount);
        $this->assertEquals($expected, $result);
    }

    public function testSetName()
    {
        $this->tranche->setName('Test Name');
        $this->assertEquals('Test Name', $this->tranche->name);
    }

    public function testSetRate()
    {
        $this->tranche->setRate(6);
        $this->assertEquals(6, $this->tranche->rate);
    }
}
