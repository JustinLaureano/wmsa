<?php

use App\Jobs\GenerateMaterialRequests;
use App\Jobs\GenerateSkidItems;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new GenerateSkidItems)->everyMinute();
Schedule::job(new GenerateMaterialRequests)->everyThreeMinutes();
