<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Road;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function profile(){
        $user = User::findOrFail(Auth::id());
        $roads = Road::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('user.users.profile', compact('user', 'roads'));
    }

}
