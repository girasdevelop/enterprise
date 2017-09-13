<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Client extends Model
{
    protected $table = 'users'; // It is important to set the name of linked table, because the model has another name, then table
    protected $primaryKey = 'id';
    protected $hidden = [
        'password', 'remember_token', // It is protecting secret fields from viewing
    ];
}
