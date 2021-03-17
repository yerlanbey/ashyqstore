<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Comment;
use App\Reply;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function PostingComment(Request $request, $productId){
        if (Auth::check()) {
            Comment::create([
                'product_code' => $productId,
                'name' => Auth::user()->name,
                'comment' => $request->input('comment'),
                'user_id' => Auth::user()->id

            ]);

            return redirect()->back()->with('success','Комментарий добавлено успешно..!');
        }else{
            return back()->back()->with('error','Something wrong');
        }
    }


    public function destroyComment($commentId)
    {

        if (Auth::check()) {

            $reply = Reply::where(['comment_id'=>$commentId]);

            $comment = Comment::where(['user_id'=>Auth::user()->id, 'id'=>$commentId]);
            if ($reply->count() > 0 && $comment->count() > 0) {
                $reply->delete();
                $comment->delete();
            }else if($comment->count() > 0){
                $comment->delete();
            }
                return redirect()->back()->with('success','Сообщение удалено');
        }else{
            return redirect()->back()->with('warning','Вы не можете удалять чужие сообщения!');
        }
    }
}
