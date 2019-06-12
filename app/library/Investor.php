<?php

namespace App\Library;

use App\Library\BaseUser as User;

class Investor extends User
{

    /**
     * Money error message
     */
    public const NOT_ENOUGH_MONEY = 'Not enough money';

    /**
     * User virtual wallet
     *
     * @var int
     */
    public $wallet;

    /**
     * Investor constructor.
     *
     * @param int $id
     * @param string $name
     * @param int $amount
     */
    public function __construct(int $id, string $name, int $amount) {
        $this->setId($id);
        $this->setName($name);
        $this->setWalletAmount($amount);
    }

    /**
     * Check amount for invests
     *
     * @param int $amount
     * @return bool
     */
    public function isEnoughAmount(int $amount) : bool {
        return $amount <= $this->wallet ? TRUE : FALSE;
    }

    /**
     * Set virtual wallet amount
     *
     * @param int $int
     * @return void
     */
    public function setWalletAmount(int $int) : void {
        $this->wallet = $int;
    }

    /**
     * Reduce investor wallet after success invests
     *
     * @param int $amount
     */
    public function reduceWallet(int $amount) : void {
        $this->setWalletAmount($this->wallet - $amount);
    }
}