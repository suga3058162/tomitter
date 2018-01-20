<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Socialite;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index (Request $request)
    {
        return view('registration.index');
    }

}
