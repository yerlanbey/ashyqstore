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
use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    /**
     * @var $host
     */
    public $host;

    /**
     * @var $token
     */
    public $token;

    /**
     * ShopController constructor.
     *
     */
    public function __construct()
    {
        $this->host  = config('product-list-api')['host'];
        $this->token = config('product-list-api')['access-token'];
    }

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

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getShops()
    {
        return redirect()->route('categories');
    }

    /**
     * @param null $code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexTheme($code=null)
    {
        $themes = Theme::where('code', $code)->firstOrFail();
        return view('theme', compact('themes'));
    }

}
