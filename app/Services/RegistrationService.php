<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegistrationService
{

    public function __construct(protected UserLinkService $userLinkService)
    {
    }

    /**
     * Register a new user
     *
     * @param array $data
     * @return User
     */
    public function register(array $data) : User
    {
        return DB::transaction(function () use ($data) {

            // Create user
            $user = User::create($data);

            // Create temporary lottery link for user
            $this->userLinkService->createUserLink($user);

            return $user;
        });

    }
}
