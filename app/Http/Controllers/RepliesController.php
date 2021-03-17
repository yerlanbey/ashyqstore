<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function storeReply(Request $request, $commentId = null){
        if (Auth::check()) {
            Reply::create([
                'comment_id' => $request->input('comment_id'),
                'name' => $request->input('name'),
                'reply' => $request->input('reply'),
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('product-more')->with('success','Вы успешно ответили на сообщение');
        }

        return back()->withInput()->with('error','Что-то пошло не так, повторите!');
    }


    public function destroyReply($replyId)
    {
        $reply = Reply::find($replyId);
        if (Auth::check()) {
            $reply = Reply::where(['id'=>$reply->id,'user_id'=>Auth::user()->id]);
            if ($reply->delete()) {
                return 1;
            }else{
                return 2;
            }
        }else{
        }
        return 3;
    }
}
