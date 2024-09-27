<?php

use App\Jobs\GenerateMaterialRequests;
use App\Jobs\GenerateSkidItems;
use App\Jobs\PutSkidsAway;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new GenerateSkidItems)->everyMinute();
Schedule::job(new PutSkidsAway)->everyTwoMinutes();
Schedule::job(new GenerateMaterialRequests)->everyThreeMinutes();
