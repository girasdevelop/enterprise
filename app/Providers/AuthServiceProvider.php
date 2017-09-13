<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Task' => 'App\Policies\TaskPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('edit', function ($user){ // Just user with "manager" value in "status" field can use functions of "edit" purpose
        return $user->status=='manager';});

        $gate->define('show',function ($user){ // Just user with "manager" value in "status" field can use functions of "show" purpose
        return $user->status=='manager';});

        $gate->define('self_manager',function ($user){ // Just user with "manager" value in "status" field can use functions of "self_manager" purpose
        return $user->status=='manager';});

        $gate->define('self_employee',function ($user){ // Just user with "employee" value in "status" field can use functions of "self_employee" purpose
        return $user->status=='employee';});

        $gate->define('attachment',function ($user){ // Just user with "manager" value in "status" field can use functions of "attachment" purpose
        return $user->status=='manager';});
    }
}
