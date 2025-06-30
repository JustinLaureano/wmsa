<?php

use App\Domain\Requests\Jobs\GenerateRecurringRequest;
use App\Domain\Production\Jobs\Scheduled\AttemptRequestListAllocations;
use Illuminate\Support\Facades\Schedule;

Schedule::command('session:clear-expired')->daily();

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


/** Production */
Schedule::job(new AttemptRequestListAllocations)->everyMinute();


// TODO: remove test route when not needed
Schedule::job(new GenerateRecurringRequest)->everyThreeMinutes();