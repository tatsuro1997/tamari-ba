<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\BoardImage;
use App\Models\BoardUser;
use App\Models\Prefecture;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;
use App\Http\Requests\BoardRequest;


class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::orderBy('created_at', 'desc')->paginate(12);

        return view('user.boards.index', compact('boards'));
    }

    public function create()
    {
        $board = new Board;
        $prefectures = Prefecture::all();

        return view('user.boards.create', compact('board', 'prefectures'));
    }

    public function store(BoardRequest $request)
    {
        try {
            $board = Board::create([
                'title' => $request->title,
                'date' => $request->date,
                'location' => $request->location,
                'destination' => $request->destination,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'prefecture_id' => $request->prefecture_id,
            ]);

            BoardUser::create([
                'board_id' => $board->id,
                'user_id' => Auth::id()
            ]);

            $imageFiles = $request->file('files');
            if ($imageFiles) {
                foreach ($imageFiles as $imageFile) {
                    $fileNameToStore = ImageService::upload($imageFile, 'boards');
                    BoardImage::create([
                        'board_id' => $board->id,
                        'filename' => $fileNameToStore,
                    ]);
                }
            }
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('user.boards.index')
            ->with(['message' => '募集を登録しました。', 'status' => 'info']);
    }


    public function edit(Board $board)
    {
        $board = Board::findOrFail($board->id);
        $prefectures = Prefecture::all();

        return view('user.boards.edit', compact('board', 'prefectures'));
    }


    public function update(Request $request, $id)
    {
        $board = Board::findOrFail($id);
        $board->title = $request->title;
        $board->date = $request->date;
        $board->location = $request->location;
        $board->destination = $request->destination;
        $board->description = $request->description;
        $board->prefecture_id = $request->prefecture_id;
        $board->deadline = $request->deadline;
        $board->save();

        $imageFiles = $request->file('files');

        if ($imageFiles) {
            foreach ($board->boardImages as $image) {
                Storage::delete('public/boards/' . $image->filename); //Storageから以前の画像を削除
            }
            BoardImage::where('board_id', $board->id)->delete(); //DBから以前の画像を削除
            foreach ($imageFiles as $imageFile) {
                $fileNameToStore = ImageService::upload($imageFile, 'boards');
                BoardImage::create([
                    'board_id' => $board->id,
                    'filename' => $fileNameToStore,
                ]);
            }
        }

        return redirect()
            ->route('user.boards.index')
            ->with(['message' => '募集を更新しました。', 'status' => 'info']);
    }
}
