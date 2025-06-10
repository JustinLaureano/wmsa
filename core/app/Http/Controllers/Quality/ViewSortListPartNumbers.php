<?php

namespace App\Http\Controllers\Quality;

use App\Http\Controllers\Controller;
use App\Repositories\SortListRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ViewSortListPartNumbers extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Quality/Sort/ViewSortListPartNumbers', [
            'partNumbers' => (new SortListRepository())->getPartNumbers(),
        ]);
    }
}
