<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Road;

class RoadController extends Controller
{
    public function index()
    {
        $roads = Road::all();

        return view('user.roads.index', compact('roads'));
    }


    public function create()
    {
        return view('user.roads.create');
    }


    public function store($request)
    {
    }


    public function edit()
    {

        return view('user.roads.edit');

    }


    public function update()
    {

    }
}
