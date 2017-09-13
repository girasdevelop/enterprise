<?php

namespace App\Contracts;

Interface UpdateContract
{
    public function update($request, $id, $client); // Required function in interface
    public function attachment($dependent, $self_id, $attach); // Required function in interface
}
