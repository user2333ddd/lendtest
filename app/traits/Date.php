<?php

namespace App\Traits;

trait Date {

    /**
     * Checking date range
     *
     * @param string $date
     * @param string $start
     * @param string $end
     * @return bool
     */
    public function checkDateRange(string $date, string $start, string $end) : bool {
        $date_start = \DateTime::createFromFormat('d/m/Y', $start);
        $date_end = \DateTime::createFromFormat('d/m/Y', $end);
        $date_current = \DateTime::createFromFormat('d/m/Y', $date);

        return ($date_current >= $date_start && $date_current <= $date_end);
    }

    /**
     * Checking previous month
     *
     * @param string $date
     * @param $date_start
     * @return bool
     */
    public function checkPreviousMonth(string $date, $date_start) : bool {
        $month = \DateTime::createFromFormat('d/m/Y', $date)->format('m');
        $month_start = \DateTime::createFromFormat('d/m/Y', $date_start)->modify('first day of previous month')->format('m');

        return $month == $month_start;
    }

}