<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PutAwayScanPage extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {

        return Inertia::render('Production/PutAway/ScanContainer');
    }
}
