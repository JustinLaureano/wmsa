<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserDetailResource;
use App\Repositories\UserRepository;
use App\Models\User;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected UserRepository $userRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        return Inertia::render('Auth/UserProfile', [
            'user' => new UserDetailResource($user),
        ]);
    }
}
