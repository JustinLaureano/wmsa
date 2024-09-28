<?php

use App\Jobs\AllotRequestSkids;
use App\Jobs\GenerateMaterialRequests;
use App\Jobs\GenerateSkidItems;
use App\Jobs\PutSkidsAway;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new GenerateSkidItems)->everyMinute();

// TODO: run less frequently once finalized
Schedule::job(new PutSkidsAway)->everyMinute();
// Schedule::job(new PutSkidsAway)->everyTwoMinutes();


// TODO: run less frequently once finalized
Schedule::job(new GenerateMaterialRequests)->everyMinute();
// Schedule::job(new GenerateMaterialRequests)->everyThreeMinutes();



Schedule::job(new AllotRequestSkids)->everyMinute();
