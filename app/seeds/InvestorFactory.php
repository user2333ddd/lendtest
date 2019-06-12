<?php

namespace App\Seeds;

use App\Library\Investor;

/**
 * Class InvestorFactory to generate fake investors
 */
class InvestorFactory
{
    /**
     * Make investors with fake data
     *
     * @param int $count
     * @return array
     */
    public static function make(int $count) : array {
        $users = [];

        for($id = 1; $id <= $count; $id++) {
            $users[] = new Investor($id, 'Investor ' . $id, 1000);
        }

        return $users;
    }
}