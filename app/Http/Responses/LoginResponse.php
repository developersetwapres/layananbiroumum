<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        $user = Auth::user();

        // Contoh jika pakai Spatie Permission
        if ($user->hasAnyPermission('view_admin_dashboard')) {
            return redirect()->route('dashboard');
        }

        // Bisa tambahkan kondisi lain
        // if ($user->hasRole('operator')) {
        //     return redirect()->route('operator.dashboard');
        // }

        // if ($user->hasRole('evaluator')) {
        //     return redirect()->route('evaluator.dashboard');
        // }

        // Default fallback
        return redirect()->intended(config('fortify.home'));
    }
}
