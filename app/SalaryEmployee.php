<?php

namespace App;

abstract class SalaryEmployee implements Salary
{
    // Count salary of any user depending on what salary: 1 - Job wage, 2 - Time based
    public static function counter($salary)
    {
        switch ($salary) {
            // There are some fixed tariff rates
            case 1:
                $out = 40000;
                break;
            case 2:
                $out = 50000;
                break;
            default:
                $out = 35000;
        }
        return $out;
    }
}
