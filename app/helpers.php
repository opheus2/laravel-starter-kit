<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('user')) {
    function user(?string $guard = null): ?User
    {
        return Auth::guard($guard)->user();
    }
}
