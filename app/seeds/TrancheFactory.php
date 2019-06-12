<?php

namespace App\Seeds;

use App\Library\Tranche;

/**
 * Class TrancheFactory to generate fake tranches
 */
class TrancheFactory
{
    /**
     * Make tranches with fake data
     *
     * @param array $params
     * @return array
     */
    public static function make($params) : array {
        $tranche = [];

        foreach ($params as $data) {
            $tranche[] = new Tranche($data['name'], $data['rate'], $data['max_amount']);
        }

        return $tranche;
    }
}