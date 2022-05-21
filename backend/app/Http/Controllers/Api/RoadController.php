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
        $prefecture_ids = $request->input('search');

        return RoadResource::collection(Road::all()->whereIn('prefecture_id', $prefecture_ids));
    }
}
