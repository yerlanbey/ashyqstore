<?php

namespace App\Http\Controllers;
use App\Dish;
use App\Food;
use Illuminate\Http\Request;
use App\Product;
use App\Comment;
use App\Reply;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function PostingComment(Request $request, $slug){
        $product = Product::where('slug',$slug)->first();
        $food = Food::where('slug', $slug)->first();
        $dish = Dish::where('slug', $slug)->first();


        if (Auth::check() && isset($product)) {
            Comment::create([
                'product_code' => $slug,
                'name' => Auth::user()->name,
                'comment' => $request->input('comment'),
                'user_id' => Auth::user()->id

            ]);

            return redirect()->back()->with('success','Комментарий добавлено успешно..!');
        }else if(Auth::check() && isset($food)) {

            Comment::create([
                'food_code' => $slug,
                'name' => Auth::user()->name,
                'comment' => $request->input('comment'),
                'user_id' => Auth::user()->id

            ]);

            return redirect()->back()->with('success', 'Комментарий добавлено успешно..!');
        }else if(Auth::check() && isset($dish)){

            Comment::create([
                'dish_code' => $slug,
                'name' => Auth::user()->name,
                'comment' => $request->input('comment'),
                'user_id' => Auth::user()->id

            ]);

            return redirect()->back()->with('success', 'Комментарий добавлено успешно..!');
        }else{
            return back()->back()->with('error','Чтоөто пошло не так, повторите попытку!');
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
