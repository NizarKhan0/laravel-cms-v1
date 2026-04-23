<?php

namespace App\Http\Controllers\frontendUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend-user.module.dashboard');
    }
}