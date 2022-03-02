<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use App\Models\Prefecture;
use Intervention\Image\Facades\Image;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $prefectures = Prefecture::all();

        return view('user.auth.register', compact('prefectures'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['required', 'image|mimes:jpg, jpeg, png|max:2048'],
            'uid' => ['required', 'unique:users', 'regex:/\A([a-zA-Z0-9])+\z/u', 'max:20' ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar'=>['required', 'image'],
            'birthday' => ['required', 'date', 'before:today'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $avatarName = $request->file('avatar')->hashName();

        $file = $request->file('avatar');
        $resizedImage = Image::make($file)->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->encode();
        Storage::disk('s3')->put('/users/' . $avatarName, (string)$resizedImage, 'public');

        $user = User::create([
            'name' => $request->name,
            'avatar' => $avatarName,
            'uid' => $request->uid,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'prefecture_id' => $request->prefecture_id,
            'years_of_experience' => $request->years_of_experience,
            'through' => $request->through,
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
