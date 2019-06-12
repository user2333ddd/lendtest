<?php

namespace Tests;

use \PHPUnit\Framework\TestCase;
use App\Library\Loan;

class LoanTest extends TestCase
{
    protected $loan;

    protected function setUp()
    {
        $this->loan = new Loan('01/10/2015', '15/11/2015');
    }

    protected function tearDown()
    {
        $this->loan = NULL;
    }


    public function addIsLoanOpenOnDateData() {
        return array(
            array('03/10/2015', '01/10/2015', '30/10/2015', true),
            array('01/11/2015', '01/10/2015', '30/10/2015', false),
        );
    }
    /**
     * @dataProvider addIsLoanOpenOnDateData
     */
    public function testIsLoanOpenOnDate($date, $date_start, $date_end, $expected)
    {
        $this->loan->date_start = $date_start;
        $this->loan->date_end = $date_end;
        $result = $this->loan->isLoanOpenOnDate($date);
        $this->assertEquals($expected, $result);
    }

    public function testSetDateEnd()
    {
        $this->loan->setDateEnd('10/10/2016');
        $this->assertEquals('10/10/2016', $this->loan->date_end);
    }

    public function testSetDateStart()
    {
        $this->loan->setDateStart('10/09/2016');
        $this->assertEquals('10/09/2016', $this->loan->date_start);
    }
}
