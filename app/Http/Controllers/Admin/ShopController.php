<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Color;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ShopRequest;
use App\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Faker\Provider\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Shop;
use App\Theme;
use App\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function create(User $userId)
    {
        $themes = Theme::all();
        return view('auth.create.index',compact('userId','themes'));
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
        if(Auth::user()->isAdmin()){
            $adminId = Auth::user()->id;
            $company = Shop::find($companyId);
            $products = $company->products;

        }
        return view('auth.more.index',compact('products','company'));
    }

    public function createProduct($companyId)
    {
        $company = Shop::find($companyId);
        $categories = Category::all();
        $colors = Color::all()->pluck('code','name');
        return view('auth.more.form', compact('company','categories','colors'));
    }

    public function storeProduct(ProductRequest $request)
    {
        $parametrs = $request->all();
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


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
