<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Road;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $roads = Road::with('tags')->orderBy('created_at', 'desc')->take(3)->get();

        return view('user.welcome', compact('roads'));
    }
}
