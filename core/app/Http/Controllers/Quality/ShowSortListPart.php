<?php

namespace App\Http\Controllers\Quality;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quality\SortListResource;
use App\Models\SortList;
use Inertia\Inertia;

class ShowSortListPart extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SortList $sortList)
    {
        return Inertia::render('Quality/Sort/ShowSortListPart', [
            'sortList' => new SortListResource($sortList),
        ]);
    }
}
