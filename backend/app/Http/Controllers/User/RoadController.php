<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Road;

class RoadController extends Controller
{
    public function index()
    {
        $roads = Road::orderBy('created_at', 'desc')->paginate(12);

        return view('user.roads.index', compact('roads'));
    }


    public function create()
    {
        return view('user.roads.create');
    }


    public function store($request)
    {
    }


    public function show()
    {
        return view('user.roads.show');
    }


    public function edit()
    {

        return view('user.roads.edit');

    }


    public function update()
    {

    }


    public function destroy($id)
    {
        Road::findOrFail($id)->delete();

        return redirect()
            ->route('user.roads.index')
            ->with(['message' => '道の投稿を削除しました。', 'status' => 'alert']);
    }
}
