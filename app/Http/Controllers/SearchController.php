<?php

namespace App\Http\Controllers;
use App\Http\Requests\SearchRequest;
use App\Category;
use App\Comment;
use App\Order;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(SearchRequest $request)

    {
        $data = $request->all();
        if($data['select'] === 'По магазинам'){
            $shops = Shop::where('name','LIKE','%'.$data['searching'].'%')->get();
        }elseif ($data['select'] === 'По продуктам'){
            $products = Product::where('name','LIKE','%'.$data['searching'].'%')->get();
        }
        if(isset($products)) {
            return view('search.search_product', compact('products'));
        }elseif(isset($shops)){
            return view('search.search_product', compact('shops'));
        }
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
