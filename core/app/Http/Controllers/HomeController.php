<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Repositories\RequestRepository;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RequestRepository $repository)
    {
        return Inertia::render('Home', [
            'recentRequests' => $repository->getRecentRequests()
        ]);
    }
}
