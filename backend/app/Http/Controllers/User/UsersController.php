<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Road;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;


class UsersController extends Controller
{
    public function profile(){
        $user = User::with('roadComments')->findOrFail(Auth::id());
        $roads = Road::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('user.users.profile', compact('user', 'roads'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $prefectures = Prefecture::all();

        return view('user.users.edit', compact('user', 'prefectures'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $avatar = $request->file('avatar')->hashName();
        $request->file('avatar')->storeAs('public/images', $avatar);
        $user->avatar = $avatar;

        $imageFile = $request->file('image');
        if ($imageFile) {
            Storage::delete('public/users/' . $user->background_image); //Storageから以前の画像を削除
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
