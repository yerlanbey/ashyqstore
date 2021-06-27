<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Dish;
use App\Food;
use App\Http\Controllers\Controller;
use App\Market;
use App\Restaurant;
use App\Theme;
use App\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function create(User $userId)
    {
        $themes = Theme::all();
        return view('auth.restaurants.create', compact('themes', 'userId'));
    }

    public function storeRestaurant(Request $request)
    {
        $parametrs = $request->all();
        unset($parametrs['image']);
        if($request->has('image')){
            $parametrs['image'] = $request->file('image')->store('markets');
        }
        $success = Restaurant::create($parametrs);
        if($success){
            return redirect()->back()->with('success', 'Вы успешно создали новый Торговый комлекс');
        }else{
            return redirect()->back()->with('warning', 'Упс! Что-то пошло не так повторите попытку');
        }
    }
    // Все продукты в Ресторане
    public function indexDish($marketSlug)
    {
        if(Auth::user()->isAdmin())
        {
            $restaurant = Restaurant::where('slug', $marketSlug)->first();
            $dishes = $restaurant->dishes;
        }
        return view('auth.restaurant_dishes.index', compact('restaurant','dishes'));
    }

    // Создать продукт
    public function createFood($marketSlug)
    {
        $restaurant = Restaurant::find($marketSlug);
        $categories = Category::all();
        return view('auth.restaurant_dishes.create', compact('categories', 'restaurant'));
    }
    //Сохранить продукт
    public function storeDish(Request $request)
    {
        $parametrs = $request->all();

        if(Auth::user()->isAdmin()){
            $parametrs['user_id'] = Auth::user()->id;
        }
        unset($parametrs['image']);
        if($request->has('image')){
            $parametrs['image'] = $request->file('image')->store('restaurants');
        }
        $success = Dish::create($parametrs);
        if($success){
            return redirect()->back()->with('success', 'Вы успешно создали Заведение');
        }else{
            return redirect()->back()->with('warning', 'Упс! Что-то пошло не так повторите попытку');
        }
    }
    public function dishEdit($dishSlug)
    {
        $dish = Dish::find($dishSlug);
        $categories = Category::all();
        $restaurants = Restaurant::all();
        return view('auth.restaurant_dishes.edit', compact('categories', 'dish', 'restaurants'));
    }

    public function dishUpdate(Request $request, $dishSlug)
    {
        $dish = Dish::find($dishSlug);
        $parametrs = $request->all();

        unset($parametrs['image']);
        if(Auth::user()->isAdmin())
        {
            $parametrs['user_id'] = Auth::user()->id;
        }

        if ($request->has('image'))
        {
            Storage::delete($dish->image);
            $parametrs['image'] = $request->file('image')->store('products');
        }
        if (!isset($parametrs['draft'])){
            $parametrs['draft'] = 0;
        }


        $success =  $dish->update($parametrs);
        if($success){
            return redirect()->back()->with('success', 'Вы успешно отредактировали '. $dish->name . '!');
        }else{
            return redirect()->back()->with('warning', 'Упс, что-то пошло не так, повторите попытку');
        }

    }
    //Удалить блюдо
    public function destroyDish($dishSlug)
    {
        $dish = Dish::find($dishSlug);

        $success = $dish->delete();

        if($success){
            return redirect()->back()->with('success', 'Вы удалили '.$dish->name);
        }else{
            return redirect()->back()->with('warning', 'Упс, что-то пошло не так повторите попытку!');
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Restaurant::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
