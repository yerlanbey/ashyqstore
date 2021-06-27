<?php

namespace App\Http\Controllers;
use App\Category;
use App\Classes\Basket;
use App\Dish;
use App\Food;
use App\Http\Requests\ProductsFilterRequest;
use App\Market;
use App\Restaurant;
use App\Shop;
use App\Product;
use App\Theme;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getDataInShop(ProductsFilterRequest $request, $slug){
        //Фильтр на продукты
        $shop = Shop::where('slug', $slug)->first();
        $market = Market::where('slug', $slug)->first();
        $restaurant = Restaurant::where('slug', $slug)->first();

        $productsQuery = Product::with('category');
        $foodsQuery = Food::with('category');
        $dishesQuery = Dish::with('category');


        if ($request->filled('price_from')){
            $productsQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')){
            $productsQuery->where('price', '<=',$request->price_to);
        }

        foreach(['hit','new','recommend'] as $field){
            if($request->has($field)){
                $productsQuery->where($field, 1);
            }
        }

        if(isset($shop))
        {
            $products = $productsQuery->where('shop_id',$shop->id)->where('draft',0)->orderBy('created_at', 'desc')->get();
            $products = $productsQuery->paginate(6)->withPath("?".$request->getQueryString());
            return view('shop_index',compact('products','shop'));
        }else if(isset($market)){
            $products = $foodsQuery->where('market_id',$market->id)->where('draft',0)->orderBy('created_at', 'desc')->get();
            $products = $foodsQuery->paginate(6)->withPath("?".$request->getQueryString());
            $shop = $market;
            return view('market_index',compact('products','shop'));
        }else if(isset($restaurant)){
            $products = $dishesQuery->where('restaurant_id',$restaurant->id)->where('draft',0)->orderBy('created_at', 'desc')->get();
            $products = $dishesQuery->paginate(6)->withPath("?".$request->getQueryString());
            $shop = $restaurant;
            return view('restaurant_index',compact('products','shop'));
        }



    }

    public function getShops(){
        $restaurants = Restaurant::where('active',1);
        $markets = Market::where('active',1);
        $shops = Shop::where('active', 1)->union($restaurants)->union($markets)->orderBy('created_at','desc')->paginate(15);
        $themes = Theme::all();
        return view('index',compact('shops','themes' ));
    }

    public function indexTheme($code=null)
    {
        $themes = Theme::where('code', $code)->firstOrFail();
        return view('theme', compact('themes'));
    }

}
