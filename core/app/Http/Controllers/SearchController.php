<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search for a query.
     */
    public function search(Request $request): JsonResponse
    {
        $query = (string) $request->input('query');

        $results = (app(SearchService::class))->search($query);

        return response()
            ->json([
                'results' => $results
            ]);
    }
}
