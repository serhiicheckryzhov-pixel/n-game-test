<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Models\User;
use App\Services\RegistrationService;
use App\Services\UserLinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisteredUserRequest $request, RegistrationService $registrationService)
    {
        try {
            $user = $registrationService->register($request->validated());

            // Auth new registered user
             Auth::login($user);

             return redirect()->route('user.links');

        } catch (\Exception $e) {

            Log::error('User registration failed', [
                'error' => $e->getMessage(),
                'phone' => $request->input('phone'),
            ]);

            return back()->withErrors(['phone' => 'An error occurred during registration. Please try again.']);
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/register');
    }
}
