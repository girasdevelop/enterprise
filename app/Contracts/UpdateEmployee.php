<?php

namespace App\Contracts;

use App\Employee;

class UpdateEmployee extends Update
{
    protected $client;

    public function __construct(Employee $client) {
        $this->client = $client; // Object of user (client) on which data will be updated - Employee
    }

    // Update Employee data
    public function update($request, $id=NULL, $client=NULL)
    {
        return parent::update($request, $id, $this->client); // Inject $this->client object
    }
}
