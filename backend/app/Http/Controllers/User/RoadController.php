<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Road;
use App\Models\RoadLike;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RoadRequest;
use App\Services\ImageService;
use App\Models\RoadImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class RoadController extends Controller
{
    public function index()
    {
        $roads = Road::withCount('roadLikes')->orderBy('created_at', 'desc')->paginate(12);
        $data = [];
        $like = new RoadLike;
        $data = [
            'roads' => $roads,
            'like_model' => $like,
        ];

        return view('user.roads.index', compact('roads', 'like'));
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
                'user_id' => Auth::id(),
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
        $road = Road::with('roadComments')->findOrFail($id);

        return view('user.roads.show', compact('road'));
    }


    public function edit(Road $road)
    {
        $this->authorize('edit', $road);

        $road = Road::findOrFail($road->id);

        return view('user.roads.edit', compact('road'));
    }


    public function update(RoadRequest $request, Road $road)
    {
        $this->authorize('update', $road);

        $road = Road::findOrFail($road->id);
        $road->title = $request->title;
        $road->latitude = $request->latitude;
        $road->longitude = $request->longitude;
        $road->description = $request->description;
        $road->save();

        $imageFiles = $request->file('files');

        if ($imageFiles) {
            foreach ($road->roadImages as $image ) {
                Storage::delete('public/roads/' . $image->filename); //Storageから以前の画像を削除
            }
            RoadImage::where('road_id', $road->id)->delete(); //DBから以前の画像を削除
            foreach ($imageFiles as $imageFile) {
                $fileNameToStore = ImageService::upload($imageFile, 'roads');
                RoadImage::create([
                    'road_id' => $road->id,
                    'filename' => $fileNameToStore,
                ]);
            }
        }

        return redirect()
            ->route('user.roads.index')
            ->with(['message' => '道の投稿を更新しました。', 'status' => 'info']);
    }


    public function destroy(Road $road)
    {
        $this->authorize('delete', $road);

        Road::findOrFail($road->id)->delete();

        return redirect()
            ->route('user.roads.index')
            ->with(['message' => '道の投稿を削除しました。', 'status' => 'alert']);
    }


        public function like(Request $request)
    {
        $id = Auth::user()->id;
        $road_id = $request->road_id;
        $like = new RoadLike;
        $road = Road::findOrFail($road_id);

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $road_id)) {
            //likesテーブルのレコードを削除
            $like = RoadLike::where('road_id', $road_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new RoadLike;
            $like->road_id = $request->road_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $roadLikesCount = $road->roadLikes->count();

        //一つの変数にajaxに渡す値をまとめる
        $json = [
            'roadLikesCount' => $roadLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }
}
