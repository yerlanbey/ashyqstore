<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Market;
use App\Product;
use App\Theme;
use App\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function create(User $userId)
    {

        $themes = Theme::all();
        return view('auth.markets.create',compact('userId','themes'));
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Market::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
