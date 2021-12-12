<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Color;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ShopRequest;
use App\Market;
use App\Product;
use App\Restaurant;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Faker\Provider\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Shop;
use App\Theme;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends Controller
{
    public function create(User $userId)
    {
        abort_if(Gate::denies('shop_create'), Response::HTTP_FORBIDDEN, 403);
        $themes = Theme::all();
        return view('auth.shops.index',compact('userId','themes'));
    }
    public function storeData(ShopRequest $request)
    {
        $parametrs = $request->all();

        unset($parametrs['image']);
        if($request->has('image')){
            $parametrs['image'] = $request->file('image')->store('shops');
        }
        $success = Shop::create($parametrs);
        if($success){
            return redirect()->back()->with('success', 'Вы успешно создали новый Торговый комлекс');
        }else{
            return redirect()->back()->with('warning', 'Упс! Что-то пошло не так повторите попытку');
        }
    }

    public function getProduct($companyId)
    {

        abort_if(Gate::denies('shop_access'), Response::HTTP_FORBIDDEN,403);
        $shop = Shop::where('slug',$companyId)->firstOrFail();
        $products = $shop->products;
        return view('auth.shop_products.index',compact('products','shop'));
    }

    public function createProduct($companyId)
    {

        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, 403);
        $company = Shop::find($companyId);
        $categories = Category::all();
        $colors = Color::all()->pluck('code','name');
        return view('auth.shop_products.form', compact('company','categories','colors'));
    }

    public function storeProduct(ProductRequest $request)
    {

        $parametrs = $request->all();
        if (strpos($parametrs['price'], ' ') !== false ){
            $parametrs['price'] = str_replace(' ', '', $parametrs['price']);
        }
        if(Auth::user()->isAdmin()){
            $parametrs['user_id'] = Auth::user()->id;
        }
        unset($parametrs['image']);
        if($request->has('image')){
            $parametrs['image'] = $request->file('image')->store('products');
        }
        $success = Product::create($parametrs);
        if($success){
            return redirect()->route('home')->with('success', 'Вы успешно добавили новый товар!');
        }else{
            return redirect()->route('home')->with('warning', 'Упс, что-то пошло не так, повторите попытку');
        }
    }
    public function destroyProduct(Product $product)
    {
        $success = $product->delete();

        if($success){
            return redirect()->route('home')->with('success', 'Вы удалили товар '.$product->name);
        }else{
            return redirect()->route('home')->with('warning', 'Упс, что-то пошло не так повторите попытку!');
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
