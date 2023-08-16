<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

if (!function_exists('profile')) {
    function profile()
    {
        $results = Settings::first();
        return $results;
    }
}


if (!function_exists('login')) {
    function login()
    {
        $results = Auth::user();
        return $results;
    }
}