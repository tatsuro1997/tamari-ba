<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::orderBy('created_at', 'desc')->paginate(12);

        return view('user.boards.index', compact('boards'));
    }
}
