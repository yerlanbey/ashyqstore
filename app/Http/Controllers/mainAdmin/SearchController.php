<?php

namespace App\Http\Controllers\mainAdmin;
use App\Color;
use App\Http\Requests\SearchRequest;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchUser(SearchRequest $request)
    {
        $query = $request['searching'];
        $users = User::where('name','LIKE','%'.$query.'%')->paginate(20);
        return view('MainAdmin.users.index', compact('users'));
    }
    public function searchCompany(SearchRequest $request)
    {
        $query = $request['searching'];
        $shops = Shop::where('name','LIKE','%'.$query.'%')->paginate(20);
        return view('MainAdmin.shops.index', compact('shops'));
    }
    public function searchProduct(SearchRequest $request)
    {
        $query = $request['searching'];
        $products = Product::where('name','LIKE','%'.$query.'%')->paginate(20);
        return view('MainAdmin.products.index', compact('products'));
    }

    public function searchCategory(SearchRequest $request)
    {
        $query = $request['searching'];
        $categories = Category::where('name','LIKE','%'.$query.'%')->paginate(20);
        return view('MainAdmin.categories.index', compact('categories'));
    }

    public function searchComment(SearchRequest $request)
    {
        $query = $request['searching'];
        $comments = Comment::where('name','LIKE','%'.$query.'%')->paginate(20);
        return view('MainAdmin.comments.index', compact('comments'));
    }

    public function searchColor(SearchRequest $request)
    {
        $query = $request['searching'];
        $colors = Color::where('name','LIKE','%'.$query.'%')->paginate(20);
        return view('MainAdmin.colors.index', compact('colors'));
    }
}
