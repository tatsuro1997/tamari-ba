<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bike;

class BikeController extends Controller
{
    public function index(Request $request)
    {
        $bikes = Bike::orderBy('created_at', 'desc')->paginate(12);

        return view('user.bikes.index', compact('bikes'));
    }
}
