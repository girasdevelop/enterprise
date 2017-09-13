<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

class Manager extends Client
{
    // Build restrictions for choosing data from table. There data "user" table will be taken, which has just "manager" value in "status" field
    protected static function boot() // Using boot tool
    {
        parent::boot();

        static::addGlobalScope('stat_man', function(Builder $builder) {
            $builder->where('status', '=', 'manager'); // Build the condition by addGlobalScope
        });
    }

    // Selecting depended employees from "user" table which have "employee" status by using Employee model across the "parent_id" foreign key
    public function employees()
    {
        return $this->hasMany('App\Employee', 'parent_id', 'id'); // foreign key - parent_id, local key - id
    }

    // Selecting depended submanagers from "user" table which have "manager" status by using the same Manager model across the "parent_id" foreign key
    public function submanagers()
    {
        return $this->hasMany('App\Manager', 'parent_id', 'id'); // foreign key - parent_id, local key - id
    }

    // Local salary counter using base function counter from SalaryManager model
    public function countSalary($input=1)
    {
        return SalaryManager::counter($input);
    }
}
