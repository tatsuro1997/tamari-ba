<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RoadResource;
use App\Models\Road;
use App\Models\RoadLike;

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

    public function toggleRoadLike(Request $request)
    {
        $uid = $request->uid;
        $road_id = $request->id;

        $exist = RoadLike::where('user_id', $uid)->where('road_id', $request->id)->get();

        if (!$exist->isEmpty()) {
            RoadLike::where('road_id', $road_id)->where('user_id', $uid)->delete();
            return 'false';
        } else {
            RoadLike::create([
                'road_id' => $road_id,
                'user_id' => $uid,
            ]);
            return 'true';
        }
    }

    public function getRoadLikes(Request $request)
    {
        $uid = $request->uid;

        $roadLikes = RoadLike::all()->where('user_id', $uid);

        $roadLikes = $roadLikes->map(function ($roadLike) {
            return RoadResource::collection(Road::all()->where('id', $roadLike->road_id))->first();
        });

        return $roadLikes;
    }

    public function searchRoads(Request $request)
    {
        $prefecture_ids = $request->input('search');

        return RoadResource::collection(Road::all()->whereIn('prefecture_id', $prefecture_ids));
    }
}
