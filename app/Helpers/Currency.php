<?php

namespace App\Helpers;
use NumberFormatter;

class Currency
{
    public static function formatCurrency(float $amount, bool $withTaxes = false)
    {
        if ($withTaxes) {
            return (new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY))->formatCurrency(
                $amount + ($amount * env('STRIPE_TAXES') / 100), env('CASHIER_CURRENCY')
            );
        }
        return (new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY))->formatCurrency(
            $amount, env('CASHIER_CURRENCY')
        );
    }
}
