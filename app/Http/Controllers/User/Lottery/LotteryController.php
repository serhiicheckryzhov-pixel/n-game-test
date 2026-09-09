<?php

namespace App\Http\Controllers\User\Lottery;

use App\Enums\LinkStatus;
use App\Http\Controllers\Controller;
use App\Models\UserLink;
use Illuminate\Support\Facades\Auth;

class LotteryController extends Controller
{

    public function show(string $token)
    {
        // Need to know is this link active and not expired and belongs to a current user
        $userLink = UserLink::validForUser(Auth::id(), $token)->firstOrFail();

        // Show lottery history here by get request
        return view('user.lottery.show', compact('token', 'userLink'));
    }

}
