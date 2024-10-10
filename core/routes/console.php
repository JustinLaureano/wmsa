<?php

use App\Domain\Requests\Jobs\GenerateRecurringRequest;
use Illuminate\Support\Facades\Schedule;


// TODO: activate
// Schedule::command('ldap:import', [
//         '--no-interaction',
//         '--delete',
//         '--scopes "App\Domain\Auth\Ldap\OnlyUsersScope"',
//         '--chunk 50'
//     ])
//     ->hourly()
//     ->evenInMaintenanceMode()
//     ->onOneServer()
//     ->emailOutputOnFailure(env('ADMIN_EMAIL_ADDRESS'));


Schedule::job(new GenerateRecurringRequest)->everyThreeMinutes();
