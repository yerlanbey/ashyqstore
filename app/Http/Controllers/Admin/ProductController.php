<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\ProductRequest;
use App\Shop;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        $products = Auth::user()->products()->paginate(30);

        return view('auth.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('auth.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('auth.products.form',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {

        $parametrs = $request->all();
        unset($parametrs['image']);
        if ($request->has('image')){
            Storage::delete($product->image);
            $parametrs['image'] = $request->file('image')->store('products');
        }
        foreach (['new','hit','recommend','draft'] as $fieldQuery){
            if (!isset($parametrs[$fieldQuery])){
                $parametrs[$fieldQuery] = 0;
            }
        }
        $success =  $product->update($parametrs);
        if($success){
            return redirect()->route('home')->with('success', 'Вы успешно отредактировали товар!');
        }else{
            return redirect()->route('home')->with('warning', 'Упс, что-то пошло не так, повторите попытку');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $success = $product->delete();

        if($success){
            return redirect()->route('home')->with('success', 'Вы удалили товар '.$product->name);
        }else{
            return redirect()->route('home')->with('warning', 'Упс, что-то пошло не так повторите попытку!');
        }
    }
}
