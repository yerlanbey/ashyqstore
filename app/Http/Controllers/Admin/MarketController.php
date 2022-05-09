<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Food;
use App\Http\Controllers\Controller;
use App\Market;
use App\Theme;
use App\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class MarketController extends Controller
{
    //Шаблон для создание Маркета
    public function createMarket(User $userId)
    {
        $themes = Theme::all();
        return view('auth.markets.create',compact('userId','themes'));
    }

    //Сохранить Маркет
    public function storeMarket(Request $request)
    {
        $parametrs = $request->all();
        unset($parametrs['image']);
        if($request->has('image')){
            $parametrs['image'] = $request->file('image')->store('markets');
        }
        $success = Market::create($parametrs);
        if($success){
            return redirect()->back()->with('success', 'Вы успешно создали новый Торговый комлекс');
        }else{
            return redirect()->back()->with('warning', 'Упс! Что-то пошло не так повторите попытку');
        }
    }

    // Все продукты в Маркете
    public function indexFood($marketSlug)
    {
        abort_if(Gate::denies('market_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $market = Market::where('slug', $marketSlug)->first();
        $foods = $market->foods;

        return view('auth.market_foods.index', compact('market','foods'));
    }

    /**
     * @param $marketSlug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createFood($marketSlug)
    {
        $market = Market::find($marketSlug);
        $categories = Category::query()->whereNull('category_id')->whereHas('childCategories')->get();
        return view('auth.market_foods.create', compact('categories', 'market'));
    }

    //Сохраняем продукт
    public function storeFood(Request $request)
    {
        $parametrs = $request->all();

        abort_if(Gate::denies('market_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parametrs['user_id'] = Auth::user()->id;
        unset($parametrs['image']);
        if($request->has('image')){
            $parametrs['image'] = $request->file('image')->store('foods');
        }
        $success = Food::create($parametrs);
        if($success){
            return redirect()->route('home')->with('success', 'Вы успешно добавили новый товар!');
        }else{
            return redirect()->route('home')->with('warning', 'Упс, что-то пошло не так, повторите попытку');
        }
    }

    public function foodEdit($foodSlug)
    {
        $food = Food::find($foodSlug);
        $categories = Category::all();
        $markets = Market::all();

        return view('auth.market_foods.edit', compact('categories', 'food', 'markets'));
    }

    public function foodUpdate(Request $request, $foodSlug)
    {
        $food = Food::find($foodSlug);
        $parametrs = $request->all();

        unset($parametrs['image']);
        if(Auth::user()->isAdmin())
        {
            $parametrs['user_id'] = Auth::user()->id;
        }

        if ($request->has('image'))
        {
            Storage::delete($food->image);
            $parametrs['image'] = $request->file('image')->store('products');
        }
        if (!isset($parametrs['draft'])){
            $parametrs['draft'] = 0;
        }
        $success =  $food->update($parametrs);
        if($success){
            return redirect()->back()->with('success', 'Вы успешно отредактировали товар!');
        }else{
            return redirect()->back()->with('warning', 'Упс, что-то пошло не так, повторите попытку');
        }

    }
    // Удалить продукт
    public function destroyFood($food)
    {
        $food = Food::find($food);

        $success = $food->delete();

        if($success){
            return redirect()->route('home')->with('success', 'Вы удалили товар '.$food->name);
        }else{
            return redirect()->route('home')->with('warning', 'Упс, что-то пошло не так повторите попытку!');
        }
    }

    //Проверяем слаг
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Market::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
