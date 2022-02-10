<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\BikeLike;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Http\Requests\BikeRequest;
use App\Services\ImageService;
use App\Models\BikeImage;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BikeController extends Controller
{
    public function index(Request $request)
    {
        $bikes = Bike::with('tags', 'bikeComments')->withCount('bikeLikes')->orderBy('created_at', 'desc')->paginate(12);

        $like = new BikeLike;

        $search = $request->input('search');
        if ($search !== null) {
            $bikes = Bike::Search($search);
        }

        return view('user.bikes.index', compact('bikes', 'like', 'search'));
    }

    public function create(Request $request)
    {
        $bike = new Bike;

        $tags = Tag::pluck('name', 'id')->toArray();

        return view('user.bikes.create', compact('bike', 'tags'));
    }


    public function store(BikeRequest $request)
    {
        try {
            $bike = Bike::create([
                'title' => $request->title,
                'bike_brand' => $request->bike_brand,
                'bike_type' => $request->bike_type,
                'bike_name' => $request->bike_name,
                'engine_size' => $request->engine_size,
                'description' => $request->description,
                'user_id' => Auth::id(),
            ]);
            $bike->tags()->attach($request->tags);

            $imageFiles = $request->file('files');
            if ($imageFiles) {
                foreach ($imageFiles as $imageFile) {
                    $fileNameToStore = ImageService::upload($imageFile, 'bikes');
                    BikeImage::create([
                        'bike_id' => $bike->id,
                        'filename' => $fileNameToStore,
                    ]);
                }
            }
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('user.bikes.index')
            ->with(['message' => 'バイクを登録しました。', 'status' => 'info']);
    }


    public function show($id)
    {
        $bike = Bike::with('bikeComments')->findOrFail($id);
        $like = new BikeLike;

        return view('user.bikes.show', compact('bike', 'like'));
    }


    public function edit(Bike $bike)
    {
        $this->authorize('edit', $bike);

        $bike = Bike::findOrFail($bike->id);
        $tags = Tag::pluck('name', 'id')->toArray();

        return view('user.bikes.edit', compact('bike', 'tags'));
    }


    public function update(BikeRequest $request, Bike $bike)
    {
        $this->authorize('update', $bike);

        $bike = Bike::findOrFail($bike->id);
        $bike->title = $request->title;
        $bike->bike_brand = $request->bike_brand;
        $bike->bike_type = $request->bike_type;
        $bike->bike_name = $request->bike_name;
        $bike->engine_size = $request->engine_size;
        $bike->description = $request->description;
        $bike->save();

        $bike->tags()->sync($request->tags);

        $imageFiles = $request->file('files');

        if ($imageFiles) {
            foreach ($bike->bikeImages as $image) {
                Storage::delete('public/bikes/' . $image->filename); //Storageから以前の画像を削除
            }
            BikeImage::where('bike_id', $bike->id)->delete(); //DBから以前の画像を削除
            foreach ($imageFiles as $imageFile) {
                $fileNameToStore = ImageService::upload($imageFile, 'bikes');
                BikeImage::create([
                    'bike_id' => $bike->id,
                    'filename' => $fileNameToStore,
                ]);
            }
        }

        return redirect()
            ->route('user.bikes.index')
            ->with(['message' => 'バイクの投稿を更新しました。', 'status' => 'info']);
    }


    public function destroy(Bike $bike)
    {
        $this->authorize('delete', $bike);

        Bike::findOrFail($bike->id)->delete();
        $bike->tags()->detach();

        return redirect()
            ->route('user.bikes.index')
            ->with(['message' => 'バイクの投稿を削除しました。', 'status' => 'alert']);
    }

    public function like(Request $request)
    {
        $id = Auth::user()->id;
        $bike_id = $request->bike_id;
        $like = new BikeLike;
        $bike = Bike::findOrFail($bike_id);

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $bike_id)) {
            //likesテーブルのレコードを削除
            $like = bikeLike::where('bike_id', $bike_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new BikeLike;
            $like->bike_id = $request->bike_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $bikeLikesCount = $bike->bikeLikes->count();

        //一つの変数にajaxに渡す値をまとめる
        $json = [
            'likesCount' => $bikeLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }
}
