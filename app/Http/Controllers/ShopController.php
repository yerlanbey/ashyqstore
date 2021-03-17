<?php

namespace App\Http\Controllers;
use App\Category;
use App\Classes\Basket;
use App\Http\Requests\ProductsFilterRequest;
use App\Shop;
use App\Product;
use App\Theme;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getDataInShop(ProductsFilterRequest $request, $shop){
        //Фильтр на продукты
        $shop = Shop::where('slug', $shop)->firstOrFail();
        $productsQuery = Product::with('category');
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
        $products = $productsQuery->where('shop_id',$shop->id)->where('draft',0)->orderBy('created_at', 'desc')->get();

        $products = $productsQuery->paginate(6)->withPath("?".$request->getQueryString());
        return view('shop_index',compact('products','shop'));
    }

    public function getShops(){
        $shops = Shop::where('active', 1)->orderBy('created_at','desc')->paginate(15);
        $themes = Theme::all();
        return view('index',compact('shops','themes' ));
    }

    public function indexTheme($code=null)
    {
        $themes = Theme::where('code', $code)->firstOrFail();
        return view('theme', compact('themes'));
    }

}
