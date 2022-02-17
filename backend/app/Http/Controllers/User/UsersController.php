<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bike;
use App\Models\Road;
use App\Models\Board;
use App\Models\RoadLike;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class UsersController extends Controller
{
    public function profile(){
        $user = User::with('bikeComments','roadComments', 'boardComments', 'bikeLikes', 'roadLikes')->findOrFail(Auth::id());
        $bikes = Bike::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        $roads = Road::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        $boards = Board::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        $like = new RoadLike;

        return view('user.users.profile', compact('user', 'bikes', 'roads', 'boards', 'like'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $prefectures = Prefecture::all();

        return view('user.users.edit', compact('user', 'prefectures'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar')->hashName();
            Storage::disk('s3')->delete('/users/' . $user->avatar); //画像も更新する場合S3から画像を削除
            Storage::disk('s3')->put('/users/', $request->file('avatar'), 'public');
            $user->avatar = $avatar;
        }

        $imageFile = $request->file('image');
        if ($imageFile) {
            Storage::disk('s3')->delete('/users/' . $user->background_image); //画像も更新する場合S3から画像を削除
            $fileNameToStore = ImageService::upload($imageFile, 'users');
            $user->background_image = $fileNameToStore;
        }

        $user->name = $request->name;
        $user->profile = $request->profile;
        $user->url = $request->url;
        $user->prefecture_id = $request->prefecture_id;
        $user->through = $request->through;
        $user->save();

        return redirect()
            ->route('user.profile')
            ->with(['message' => 'プロフィールを更新しました。', 'status' => 'info']);
    }

}
