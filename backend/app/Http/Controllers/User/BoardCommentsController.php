<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BoardComment;
use Illuminate\Support\Facades\Auth;


class BoardCommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function store(Request $request)
    {
        $comment = new BoardComment();
        $comment->comment = $request->comment;
        $comment->board_id = $request->board_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return redirect()
            ->route('user.boards.show', ['board' => $comment->board_id])
            ->with(['message' => 'コメントをしました。', 'status' => 'info']);
    }

    public function destroy(Request $request)
    {
        // TODO
        // Policyで削除制限
        // 現在は投稿者のみ削除ボタン出現
        // $this->authorize('delete', $comment);

        BoardComment::findOrFail($request->comment_id)->delete();

        return redirect()
            ->route('user.boards.show', ['board' => $request->board_id])
            ->with(['message' => 'コメントを削除しました。', 'status' => 'alert']);
    }
}
