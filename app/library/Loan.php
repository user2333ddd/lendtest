<?php

namespace App\Library;

use App\Traits\Date;

class Loan
{
    use Date;

    /**
     * Success message
     */
    public const SUCCESS = 'Ok';

    /**
     * Error message
     */
    public const ERROR = 'Exception';

    /**
     * Error message
     */
    public const NOT_FOUND = 'Tranche is not found';

    /**
     * Loan start date
     *
     * @var string
     */
    public $date_start;

    /**
     * Loan end date
     *
     * @var string
     */
    public $date_end;

    /**
     * List of tranches objects
     *
     * @var array
     */
    public $tranches = [];

    /**
     * Loan constructor.
     *
     * @param string $date_start
     * @param string $date_end
     */
    public function __construct(string $date_start, string $date_end)
    {
        $this->setDateStart($date_start);
        $this->setDateEnd($date_end);
    }

    /**
     * Set loan date start
     *
     * @param string $date
     * @return void
     */
    public function setDateStart(string $date) : void {
        $this->date_start = $date;
    }

    /**
     * Set loan date end
     *
     * @param string $date
     * @return void
     */
    public function setDateEnd(string $date) : void {
        $this->date_end = $date;
    }

    /**
     * Check the availability of loan on the date
     *
     * @param string $date
     * @return bool
     */
    public function isLoanOpenOnDate(string $date) : bool {
        return $this->checkDateRange($date, $this->date_start, $this->date_end);
    }

    /**
     * Set list of tranches
     *
     * @param array $tranches
     */
    public function setTranches(array $tranches) : void {
        $this->tranches = $tranches;
    }

    /**
     * Invest in tranche
     *
     * @param int $user_id
     * @param string $user_name
     * @param string $tranche
     * @param int $amount
     * @param string $date
     * @return string
     */
    public function invest(int $user_id, string $user_name, string $tranche, int $amount, string $date) : string {
        $tranche_key = $this->findTranche($tranche);

        if($tranche_key === FALSE) {
            return self::NOT_FOUND;
        }

        if($this->isLoanOpenOnDate($date)) {
            $result = $this->tranches[$tranche_key]->setInvest($amount, $user_name, $user_id, $date);

            return $result ? self::SUCCESS : self::ERROR;
        }

        return self::ERROR;
    }

    /**
     * Finding and return the tranche index
     *
     * @param string $name
     * @return bool|int
     */
    public function findTranche(string $name) {
        foreach ($this->tranches as $key => $tranche) {
            if($name == $tranche->name) {
                return $key;
            }
        }

        return FALSE;
    }

    /**
     * Get monthly interest payment from each tranche
     */
    public function getMonthlyInterestPayment() : void {
        foreach ($this->tranches as $tranche) {
            $percent = $tranche->calculateMonthlyPercent($this->date_start);

            foreach ($percent as $item) {
                echo '- '. $item['name'] . ' earns ' . $item['amount'] . ' pounds.' . PHP_EOL;
            }
        }
    }
}