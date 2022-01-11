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
use App\Services\ImageService;
use App\Models\RoadImage;



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
            DB::transaction(function () use ($request) {
                $road = Road::create([
                    'title' => $request->title,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'description' => $request->description,
                    'user_id' => 1, // TODO:authからuser_idを取得する
                ]);

                $imageFiles = $request->file('files');
                if (!is_null($imageFiles)) {
                    foreach ($imageFiles as $imageFile) {
                        $fileNameToStore = ImageService::upload($imageFile, 'roads');
                        RoadImage::create([
                            'road_id' => $road->id,
                            'filename' => $fileNameToStore,
                        ]);
                    }
                }
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
