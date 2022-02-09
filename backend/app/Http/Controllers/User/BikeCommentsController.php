<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BikeComment;
use Illuminate\Support\Facades\Auth;


class BikeCommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function store(Request $request)
    {
        $comment = new BikeComment();
        $comment->comment = $request->comment;
        $comment->bike_id = $request->bike_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return redirect()
            ->route('user.bikes.show', ['bike' => $comment->bike_id])
            ->with(['message' => 'コメントをしました。', 'status' => 'info']);
    }

    public function destroy(Request $request)
    {
        // TODO
        // Policyで削除制限
        // 現在は投稿者のみ削除ボタン出現
        // $this->authorize('delete', $comment);

        BikeComment::findOrFail($request->comment_id)->delete();

        return redirect()
            ->route('user.bikes.show', ['bike' => $request->bike_id])
            ->with(['message' => 'コメントを削除しました。', 'status' => 'alert']);
    }
}
