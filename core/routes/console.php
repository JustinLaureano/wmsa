<?php

use App\Domain\Requests\Jobs\GenerateRecurringRequest;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new GenerateRecurringRequest)->everyThreeMinutes();
