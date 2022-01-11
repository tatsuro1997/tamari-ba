<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Road;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RoadRequest;


class RoadController extends Controller
{
    public function index()
    {
        $roads = Road::orderBy('created_at', 'desc')->paginate(12);

        return view('user.roads.index', compact('roads'));
    }


    public function create()
    {
        // $user_id = User::findOrFail($id);

        return view('user.roads.create');
    }


    public function store(RoadRequest $request)
    {


        // dd($road);

        try {
            DB::transaction(function () use ($request) {
                Road::create([
                    'title' => $request->title,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'description' => $request->description,
                    'user_id' => 1, // TODO:authからuser_idを取得する
                    // 'image1' => $request->image1,
                    // 'image2' => $request->image2,
                    // 'image3' => $request->image3,
                    // 'image4' => $request->image4,
                ]);
            }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('user.roads.index')
            ->with(['message' => '道を登録しました。', 'status' => 'info']);
    }


    public function show()
    {
        return view('user.roads.show');
    }


    public function edit()
    {

        return view('user.roads.edit');
    }


    public function update()
    {
    }


    public function destroy()
    {
    }
}
