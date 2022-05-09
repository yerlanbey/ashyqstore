<?php

namespace App\Http\Controllers;
use App\Food;
use App\Http\Requests\SearchRequest;
use App\Category;
use App\Comment;
use App\Order;
use App\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * Поиск через Header
     * @param SearchRequest $request
     * @return Application|Factory|View
     */
    public function search(SearchRequest $request)
    {
        $products = Food::where('name','LIKE','%'.$request->searching.'%')->get();
        return view('search.search_product', compact('products'));
    }

    public function searchProduct(SearchRequest $request)
    {
        $search = $request->input('searching');
        $products = Product::where('name','LIKE','%'.$search.'%')->where('user_id', Auth::user()->id)->paginate(20);
        return view('search.data',compact('products'));
    }


    public function searchCategory(SearchRequest $request)
    {
        $search = $request->input('searching');
        $categories = Category::where('name','LIKE','%'.$search.'%')->paginate(20);
        return view('search.category', compact('categories'));
    }

    public function searchOrder(SearchRequest $request)
    {
        $search = $request->input('searching');
        $orders = Order::where('name','LIKE','%'.$search.'%')->where('status',1)->paginate(20);
        $uniques = [];
        foreach($orders as $order){
            foreach(DB::table('order_product')->where('order_id',$order->id)->get() as $otg){
                if($otg->admin_id == Auth::user()->id){
                    $uniques[] = $order->id;
                }
            }
        }
        $orders = Order::orderBy('created_at', 'desc')->whereIn('id', $uniques)->paginate(20);

        return view('auth.orders.index',compact('orders'));
    }

    public function searchComment(SearchRequest $request)
    {
        $search = $request->input('searching');
        $comments = Comment::where('name','LIKE','%'.$search.'%')->paginate(20);
        return view('auth.comments.index',compact('comments'));
    }
}
