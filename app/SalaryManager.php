<?php

namespace App;

abstract class SalaryManager implements Salary
{
    // Count salary of any user depending on what salary: 1 - Job wage, 2 - Time based
    public static function counter($salary)
    {
        switch ($salary) {
            // There are some fixed tariff rates
            case 1:
                $out = 10575*4;
                break;
            case 2:
                $out = 8*22*300;
                break;
            default:
                $out = 37500;
        }
        return $out;
    }
}
