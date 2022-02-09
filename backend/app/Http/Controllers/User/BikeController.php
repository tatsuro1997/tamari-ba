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
}
