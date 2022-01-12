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
        return view('user.roads.create');
    }


    public function store(RoadRequest $request)
    {
        try {
            Road::create([
                'title' => $request->title,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'description' => $request->description,
                'user_id' => 1, // TODO:authからuser_idを取得する
            ]);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('user.roads.index')
            ->with(['message' => '道を登録しました。', 'status' => 'info']);
    }


    public function show($id)
    {
        $road = Road::findOrFail($id);

        return view('user.roads.show', compact('road'));
    }


    public function edit()
    {

        return view('user.roads.edit');
    }


    public function update()
    {
    }


    public function destroy($id)
    {
        Road::findOrFail($id)->delete();

        return redirect()
            ->route('user.roads.index')
            ->with(['message' => '道の投稿を削除しました。', 'status' => 'alert']);
    }
}
