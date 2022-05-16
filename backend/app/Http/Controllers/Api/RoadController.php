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

    public function getRoad($id)
    {
        return RoadResource::collection(Road::all()->where('id', $id));
    }

    public function searchRoads(Request $request)
    {
        foreach ($request->input('search') as $prefecture_id) {
            return RoadResource::collection(Road::all()->where('prefecture_id', $prefecture_id));
        }
    }
}
