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

    public function toggleRoadLike(Request $request)
    {
        $exist = RoadLike::where('user_id', 1)->where('road_id', $request->id)->get();

        $uid = 1;
        $road_id = $request->id;

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
}
