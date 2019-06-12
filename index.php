<?php

use App\Seeds\InvestorFactory;
use App\Seeds\TrancheFactory;
use App\Library\Loan;

require __DIR__.'/vendor/autoload.php';

$loan = new Loan('01/10/2015', '15/11/2015');

$loan->setTranches(TrancheFactory::make(
    [
        ['name' => 'A', 'rate' => 3, 'max_amount' => 1000],
        ['name' => 'B', 'rate' => 6, 'max_amount' => 1000]
    ]
));

$investors = InvestorFactory::make(4);

foreach ($investors as $key => &$investor) {
    $tranche = $key % 2 ? 'A' : 'B';
    $amount = mt_rand(1, 1100);

    if($investor->isEnoughAmount($amount)) {
        $status = $loan->invest($investor->id, $investor->name, $tranche, $amount, '03/10/2015');

        if($status == $loan::SUCCESS) $investor->reduceWallet($amount);
    } else {
        $status = $investor::NOT_ENOUGH_MONEY;
    }

    echo "{$investor->name} I’d like to invest {$amount} pounds on the tranche {$tranche} : {$status}" . PHP_EOL;
}

/*
 * This method should be start in CRON
 */
$loan->getMonthlyInterestPayment();
