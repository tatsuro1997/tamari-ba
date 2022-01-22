<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoadComment;
use Illuminate\Support\Facades\Auth;


class RoadCommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('user:auth');
    }

    public function store(Request $request)
    {
        $comment = new RoadComment();
        $comment->comment = $request->comment;
        $comment->road_id = $request->road_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return redirect()
            ->route('user.roads.show', ['road' => $comment->road_id])
            ->with(['message' => 'コメントをしました。', 'status' => 'info']);
    }

    public function destroy(Request $request)
    {
        RoadComment::find($request->comment_id)->delete();

        return redirect()
            ->route('user.roads.index')
            ->with(['message' => '道の投稿を削除しました。', 'status' => 'alert']);
    }
}
