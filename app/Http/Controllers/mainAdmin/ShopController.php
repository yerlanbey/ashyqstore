<?php

namespace App\Http\Controllers\mainAdmin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use App\Theme;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::orderBy('created_at', 'desc')->paginate(20);
        return view('MainAdmin.shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owners = User::where('is_admin',1)->get();
        $themes = Theme::all();
        return view('MainAdmin.shops.form',compact('owners','themes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parametrs = $request->all();

        unset($parametrs['image']);
        if($request->has('image')){
            $parametrs['image'] = $request->file('image')->store('shops');
        }
        Shop::create($parametrs);
        return redirect()->route('shops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return view('MainAdmin.shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $owners = User::where('is_admin',1)->get();
        $themes = Theme::all();

        return view('MainAdmin.shops.form',compact('shop','owners','themes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $shop)
    {
        $parametrs = $request->all();
        $shop = Shop::find($shop);
        $parametrs = $request->all();
        if(isset($parametrs['action'])){
            $parametrs['action'] = 1;
        }else {
            $parametrs['action'] = 0;
        }
        unset($parametrs['image']);
        if ($request->has('image')){
            Storage::delete($shop->image);
            $parametrs['image'] = $request->file('image')->store('shops');
        }

        $shop->update($parametrs);
        return redirect()->route('shops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->products()->delete();
        $shop->delete();
        return redirect()->back();
    }
}
