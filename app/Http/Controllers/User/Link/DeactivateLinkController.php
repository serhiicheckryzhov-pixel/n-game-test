<?php

namespace App\Http\Controllers\User\Link;

use App\Http\Controllers\Controller;
use App\Services\UserLinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DeactivateLinkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserLinkService $userLinkService)
    {
        try {
            $userLinkService->deactivateUserLink();
        } catch (\Exception $e) {

            Log::error('User temporary link deactivation failed', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);

            return redirect()
                ->route('user.links')
                ->withErrors(['error' => 'An error occurred while deactivating the link. Please try again.']);
        }
        return redirect()->route('user.links');
    }
}
