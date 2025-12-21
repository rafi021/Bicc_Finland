<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::fallback(function () {
    return response()->json([
        'message' => 'This demo build only exposes the admin panel. Public APIs are disabled.',
        'docs' => url('/'),
    ], 410);
});

