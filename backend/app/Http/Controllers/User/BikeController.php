<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BikeRequest;
use App\Services\ImageService;
use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Maker;
use App\Models\Type;
use App\Models\BikeLike;
use App\Models\BikeImage;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class BikeController extends Controller
{
    public function index(Request $request)
    {
        $bikes = Bike::with('tags', 'maker', 'type', 'bikeLikes', 'bikeImages', 'user')->withCount('bikeLikes')->orderBy('created_at', 'desc')->paginate(12);

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

        $makers = Maker::all();

        $types = Type::all();

        return view('user.bikes.create', compact('bike', 'tags', 'makers', 'types'));
    }


    public function store(BikeRequest $request)
    {
        try {
            $bike = Bike::create([
                'title' => $request->title,
                'maker_id' => $request->maker_id,
                'type_id' => $request->type_id,
                'name' => $request->name,
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
            ->with(['message' => '?????????????????????????????????', 'status' => 'info']);
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

        $makers = Maker::all();

        $types = Type::all();

        return view('user.bikes.edit', compact('bike', 'tags', 'makers', 'types'));
    }


    public function update(BikeRequest $request, Bike $bike)
    {
        $this->authorize('update', $bike);

        $bike = Bike::findOrFail($bike->id);
        $bike->title = $request->title;
        $bike->maker_id = $request->maker_id;
        $bike->type_id = $request->type_id;
        $bike->name = $request->name;
        $bike->engine_size = $request->engine_size;
        $bike->description = $request->description;
        $bike->save();

        $bike->tags()->sync($request->tags);

        $imageFiles = $request->file('files');

        if ($imageFiles) {
            foreach ($bike->bikeImages as $image) {
                Storage::disk('s3')->delete('/bikes/' . $image->filename); //???????????????????????????S3?????????????????????
            }
            BikeImage::where('bike_id', $bike->id)->delete(); //DB??????????????????????????????
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
            ->with(['message' => '??????????????????????????????????????????', 'status' => 'info']);
    }


    public function destroy(Bike $bike)
    {
        $this->authorize('delete', $bike);

        foreach ($bike->bikeImages as $image) {
            if ($image) {
                Storage::disk('s3')->delete('/bikes/' . $image->filename);
            }
        }

        Bike::findOrFail($bike->id)->delete();
        $bike->tags()->detach();

        return redirect()
            ->route('user.bikes.index')
            ->with(['message' => '??????????????????????????????????????????', 'status' => 'alert']);
    }

    public function like(Request $request)
    {
        $id = Auth::user()->id;
        $bike_id = $request->bike_id;
        $like = new BikeLike;
        $bike = Bike::findOrFail($bike_id);

        // ???????????????????????????????????????????????????
        if ($like->like_exist($id, $bike_id)) {
            //likes????????????????????????????????????
            $like = bikeLike::where('bike_id', $bike_id)->where('user_id', $id)->delete();
        } else {
            //???????????????????????????????????????????????????likes???????????????????????????????????????????????????
            $like = new BikeLike;
            $like->bike_id = $request->bike_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCount?????????????????????????????????????????????_count????????????????????????????????????????????????????????????????????????
        $bikeLikesCount = $bike->bikeLikes->count();

        //??????????????????ajax???????????????????????????
        $json = [
            'likesCount' => $bikeLikesCount,
        ];
        //??????????????????ajax????????????????????????
        return response()->json($json);
    }
}
