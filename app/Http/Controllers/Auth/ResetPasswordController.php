<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles password reset requests and uses
    | the ResetsPasswords trait to provide this functionality.
    | You may override methods if you want to customize behavior.
    |
    */

    use ResetsPasswords;

    /**
     * Redirect path after successful password reset.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
