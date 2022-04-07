<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RoadResource;
use App\Models\Road;

class RoadController extends Controller
{
    public function getRoads()
    {
        return RoadResource::collection(Road::all());
    }
}
