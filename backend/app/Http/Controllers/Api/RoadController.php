<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RoadResource;
use App\Models\Road;
use App\Models\RoadLike;
use Illuminate\Support\Facades\Auth;

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

    public function createRoadLike(Request $request)
    {
        $road = Road::findOrFail($request->id);
        $user = Auth::user();
        RoadLike::create([
            'road_id' => $road->id,
            'user_id' => 1,
        ]);
        return redirect("/");
    }
}
