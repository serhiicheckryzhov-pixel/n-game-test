<?php

namespace App\Http\Controllers\User\Lottery;

use App\Http\Controllers\Controller;
use App\Models\UserLink;
use App\Services\LotteryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LotteryResultsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LotteryService $lotteryService, string $token)
    {
        $userLink = UserLink::validForUser(Auth::id(), $token)->firstOrFail();
        $results = $lotteryService->getLastLotteryResults($userLink);
        return view('user.lottery.results', compact('token', 'results'));
    }
}
