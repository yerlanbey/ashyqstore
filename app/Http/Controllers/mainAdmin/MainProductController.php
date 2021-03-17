<?php

namespace App\Http\Controllers\mainAdmin;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MainProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(20);

        return view('MainAdmin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Главный админ не имеет права для создание товара
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mainproduct)
    {
        $product = Product::find($mainproduct);

        return view('MainAdmin.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($mainproduct)
    {
        $categories = Category::get();
        $product = Product::find($mainproduct);
        return view('MainAdmin.products.form',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $product = Product::find($product);
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
        $product->update($parametrs);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mainproduct)
    {
        $product = Product::find($mainproduct);
        $product->delete();
        return redirect()->back();
    }
}
