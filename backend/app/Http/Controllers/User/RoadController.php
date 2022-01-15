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
use Illuminate\Support\Facades\Storage;


class RoadController extends Controller
{
    public function index()
    {
        $roads = Road::orderBy('created_at', 'desc')->paginate(12);

        return view('user.roads.index', compact('roads'));
    }


    public function create()
    {
        $road = new Road;
        return view('user.roads.create', compact('road'));
    }


    public function store(RoadRequest $request)
    {
        try {
            $road = Road::create([
                'title' => $request->title,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'description' => $request->description,
                'user_id' => 1, // TODO:authからuser_idを取得する
            ]);

            $imageFiles = $request->file('files');
            if ($imageFiles) {
                foreach ($imageFiles as $imageFile) {
                    $fileNameToStore = ImageService::upload($imageFile, 'roads');
                    RoadImage::create([
                        'road_id' => $road->id,
                        'filename' => $fileNameToStore,
                    ]);
                }
            }
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


    public function edit($id)
    {
        $road = Road::findOrFail($id);

        return view('user.roads.edit', compact('road'));
    }


    public function update(RoadRequest $request, $id)
    {
        $road = Road::findOrFail($id);
        $road->title = $request->title;
        $road->latitude = $request->latitude;
        $road->longitude = $request->longitude;
        $road->description = $request->description;
        $road->user_id = 1; // TODO:authからuser_idを取得する
        $road->save();

        $imageFiles = $request->file('files');

        if ($imageFiles) {
            foreach ($road->roadImages as $image ) {
                Storage::delete('public/roads/' . $image->filename); //以前の画像を削除
            }
            foreach ($imageFiles as $imageFile) {
                $fileNameToStore = ImageService::upload($imageFile, 'roads');
                $roadImage = RoadImage::findOrFail($id);
                $roadImage->road_id = $road->id;
                $roadImage->filename = $fileNameToStore;
                $roadImage->save();
            }
        }

        return redirect()
            ->route('user.roads.index')
            ->with(['message' => '道の投稿を更新しました。', 'status' => 'info']);
    }


    public function destroy($id)
    {
        Road::findOrFail($id)->delete();

        return redirect()
            ->route('user.roads.index')
            ->with(['message' => '道の投稿を削除しました。', 'status' => 'alert']);
    }
}
