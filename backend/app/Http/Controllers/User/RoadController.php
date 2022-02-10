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
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class RoadController extends Controller
{
    public function index(Request $request)
    {
        $roads = Road::with('tags')->withCount('roadLikes')->orderBy('created_at', 'desc')->paginate(12);

        // Like
        $like = new RoadLike;

        // 検索フォームで入力された値を取得する
        $search = $request->input('search');

        // フォームに値が入力されたら、検索した結果を返す
        if ($search !== null) {
            $roads = Road::Search($search);
        }

        return view('user.roads.index', compact('roads', 'like', 'search'));
    }


    public function create(Request $request)
    {
        $road = new Road;

        # Mapでデフォルトを東京タワーに指定
        $lat = '35.6585769';
        $lng = '139.7454506';

        $tags = Tag::pluck('name', 'id')->toArray();

        return view('user.roads.create', compact('road', 'lat', 'lng', 'tags'));
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
            $road->tags()->attach($request->tags);

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
        $like = new RoadLike;

        return view('user.roads.show', compact('road', 'like'));
    }


    public function edit(Road $road)
    {
        $this->authorize('edit', $road);

        $road = Road::findOrFail($road->id);
        $tags = Tag::pluck('name', 'id')->toArray();

        return view('user.roads.edit', compact('road', 'tags'));
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

        $road->tags()->sync($request->tags);

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
        $road->tags()->detach();

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
            'likesCount' => $roadLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }
}
