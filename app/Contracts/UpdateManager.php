<?php

namespace App\Contracts;

use App\Manager;

class UpdateManager extends Update
{
    protected $client;

    public function __construct(Manager $client) {
        $this->client = $client; // Object of user (client) on which data will be updated - Manager
    }

    // Update Manager data
    public function update($request, $id=NULL, $client=NULL)
    {
        return parent::update($request, $id, $this->client); // Inject $this->client object
    }
}
