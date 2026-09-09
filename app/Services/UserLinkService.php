<?php

namespace App\Services;

use App\Enums\LinkStatus;
use App\Models\User;
use App\Models\UserLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserLinkService
{
    /**
     * Creates a temporary link for the given user with an expiration date.
     *
     * @param User $user The user for whom the temporary link is being generated.
     * @return UserLink Returns the generated temporary link instance associated with the user.
     */
    public function createUserLink(User $user) : UserLink
    {

        return UserLink::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $user->id . time()),
            'expires_at' => now()->addDays(config('app.token_expiration_days')),
        ]);
    }

    /**
     * Regenerates the temporary link for the authenticated user.
     *
     * @return void
     */
    public function regenerateUserLink() : ?UserLink
    {
        $userLink = UserLink::forUser(Auth::id())->first();

        if ($userLink) {
            $userLink->token = Str::random(64);
            $userLink->status = LinkStatus::Active;
            $userLink->expires_at = now()->addDays(config('app.token_expiration_days'));
            $userLink->save();
            return $userLink;
        }

        return null;
    }

    public function deactivateUserLink() : ?UserLink
    {
        $userLink = UserLink::forUser(Auth::id())->first();

        if ($userLink) {
            $userLink->status = LinkStatus::Inactive;
            $userLink->save();
            return $userLink;
        }

        return null;
    }

}
