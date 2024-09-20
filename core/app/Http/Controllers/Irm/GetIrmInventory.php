<?php

namespace App\Http\Controllers\Irm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetIrmInventory extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Irm/Inventory/ShowInventory');
    }
}
