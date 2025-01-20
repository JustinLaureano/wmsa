<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ViewNewMaterialRequestForm extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Production/Requests/NewMaterialRequestForm');
    }
}
