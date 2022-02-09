<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bike;
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
        $bikes = Bike::orderBy('created_at', 'desc')->paginate(12);

        return view('user.bikes.index', compact('bikes'));
    }

    public function create(Request $request)
    {
        $bike = new Bike;

        return view('user.bikes.create', compact('bike'));
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
            // $bike->tags()->attach($request->tags);

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


    public function edit(Bike $bike)
    {
        $this->authorize('edit', $bike);

        $bike = Bike::findOrFail($bike->id);
        // $tags = Tag::pluck('name', 'id')->toArray();

        return view('user.bikes.edit', compact('bike'));
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

        // $bike->tags()->sync($request->tags);

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
        // $bike->tags()->detach();

        return redirect()
            ->route('user.bikes.index')
            ->with(['message' => 'バイクの投稿を削除しました。', 'status' => 'alert']);
    }
}
