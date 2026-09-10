<?php

namespace App\Http\Controllers\User\Link;

use App\Http\Controllers\Controller;
use App\Models\UserLink;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index()
    {
        $link = UserLink::where('user_id', Auth::id())->first();
        $isExpired = $link ? $link->isExpired() : false;

        return view('user.link.index', [
            'link' => $link,
            'isExpired' => $isExpired,
        ]);
    }

}
