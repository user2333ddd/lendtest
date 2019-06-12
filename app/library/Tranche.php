<?php

namespace App\Library;

use App\Traits\Date;

class Tranche
{
    use Date;

    /**
     * Tranche name
     *
     * @var string
     */
    public $name;

    /**
     * Month tranche rate
     *
     * @var float
     */
    public $rate;

    /**
     * Maximum tranche amount
     *
     * @var int
     */
    public $max_amount;

    /**
     * Current tranche amount
     *
     * @var int
     */
    public $amount = 0;

    /**
     * List of investors
     *
     * @var array
     */
    public $investors = [];

    /**
     * Tranche constructor.
     *
     * @param string $name
     * @param float $rate
     * @param int $max_amount
     */
    public function __construct(string $name, float $rate, int $max_amount) {
        $this->setName($name);
        $this->setRate($rate);
        $this->setMaxAmount($max_amount);
    }

    /**
     * Set tranche name
     *
     * @param string $name
     */
    public function setName(string $name) : void {
        $this->name = $name;
    }

    /**
     * Set month tranche rate
     *
     * @param float $rate
     */
    public function setRate(float $rate) : void {
        $this->rate = $rate;
    }

    /**
     * Set tranche maximum amount
     *
     * @param int $amount
     */
    public function setMaxAmount(int $amount) : void {
        $this->max_amount = $amount;
    }

    /**
     * Set tranche amount
     *
     * @param int $amount
     */
    public function setAmount(int $amount) : void {
        $this->amount = $amount;
    }

    /**
     * Checking tranche for made investments
     *
     * @param int $amount
     * @return bool
     */
    public function isAvailableTranche(int $amount) : bool {
        return ($this->amount + $amount) <= $this->max_amount;
    }

    /**
     * Make investments to tranche
     *
     * @param int $amount
     * @param string $name
     * @param int $id
     * @param string $date
     * @return bool
     */
    public function setInvest(int $amount, string $name, int $id, string $date) : bool {
        if($this->isAvailableTranche($amount)) {
            $this->setInvestor($amount, $name, $id, $date);
            $this->setAmount($this->amount + $amount);

            return TRUE;
        }

        return FALSE;
    }

    /**
     * Set investors history
     *
     * @param int $amount
     * @param string $name
     * @param int $id
     * @param string $date
     */
    public function setInvestor(int $amount, string $name, int $id, string $date) : void {
        $this->investors[$id] = [
            'amount' => $amount,
            'name' => $name,
            'date' => $date
        ];
    }

    /**
     * Calculation previous monthly interest payment for investors
     *
     * @param string $loan_date_start
     * @return array
     */
    public function calculateMonthlyPercent(string $loan_date_start) : array {
        $amounts = [];

        foreach ($this->investors as $investor) {
            if($this->checkPreviousMonth($investor['date'], $loan_date_start)) {
                $amounts[] = [
                    'name' => $investor['name'],
                    'amount' => $this->rate / 100 * $investor['amount'],
                ];
            }
        }

        return $amounts;
    }
}