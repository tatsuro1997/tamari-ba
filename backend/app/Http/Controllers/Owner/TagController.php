<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Log;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::pluck('name', 'id')->toArray();

        return view('owner.tags.index', compact('tags'));
    }


    public function store(Request $request)
    {
        try {
            Tag::create([
                'slug' => $request->slug,
                'name' => $request->name,
            ]);

        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('owner.tags.index')
            ->with(['message' => 'タグを登録しました。', 'status' => 'info']);
    }

    public function destroy($id)
    {
        Tag::findOrFail($id)->delete();

        return redirect()
            ->route('owner.tags.index')
            ->with(['message' => 'タグを削除しました。', 'status' => 'alert']);
    }

}
