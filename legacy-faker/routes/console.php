<?php

use App\Jobs\GenerateMaterialRequests;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new GenerateMaterialRequests)->everyTwoMinutes();
