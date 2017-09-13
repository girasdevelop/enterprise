<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

class Employee extends Client
{
    // Build restrictions for choosing data from table. There data in "user" table will be taken, which has just "employee" value in "status" field
    protected static function boot() // Using boot tool
    {
        parent::boot();

        static::addGlobalScope('stat_emp', function(Builder $builder) {
            $builder->where('status', '=', 'employee'); // Build the condition by addGlobalScope
        });
    }

    // Selecting parent managers from "user" table which have "manager" status by using Manager model across the "parent_id" local key
    public function managers()
    {
        return $this->belongsTo('App\Manager', 'parent_id'); // Local key parent_id
    }

    // Local salary counter using base function counter from SalaryEmployee model
    public function countSalary($input=1)
    {
        return SalaryEmployee::counter($input);
    }
}
