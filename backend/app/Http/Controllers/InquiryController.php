<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Slack;

class InquiryController extends Controller
{
    public function inquiry()
    {
        $user = Auth::user();
        return view('user.inquiry', compact('user'));
    }

    public function send_inquiry(Request $request)
    {
        $poster = $request->name;
        $item = $request->item;
        $content = $request->content;

        $post_slack = "{$poster}さんから{$item}です。\n■{$item}内容\n{$content}";

        Slack::send($post_slack);

        return redirect()
            ->route('user.welcome')
            ->with(['message' => 'お問い合わせありがとうございます。', 'status' => 'info']);
    }
}
