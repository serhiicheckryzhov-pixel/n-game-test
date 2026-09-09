<?php

namespace App\Http\Controllers\User\Lottery;

use App\Http\Controllers\Controller;
use App\Models\UserLink;
use App\Services\LotteryService;

use Illuminate\Support\Facades\Auth;

class PlayLotteryGameController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LotteryService $lotteryService, $token)
    {
        $userLink = UserLink::validForUser(Auth::id(), $token)->firstOrFail();;
        $result = $lotteryService->playLotteryGame($userLink);

        return back()->with('lottery_result', [
            'income' => $result,
        ]);
    }
}
