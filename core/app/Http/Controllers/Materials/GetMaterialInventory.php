<?php

namespace App\Http\Controllers\Materials;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetMaterialInventory extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Materials/Inventory/ShowInventory');
    }
}
