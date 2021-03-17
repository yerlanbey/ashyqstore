<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\PhotoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Photo;
use App\Product;
class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::paginate(20);
        return view('auth.photos.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        $array = array();
        foreach ($products as $product)
        {
            if($product->user_id === Auth::user()->id){
                array_push($array, $product->user_id);
            }
        }
        $products = Product::whereIn('user_id',$array)->get();

        return view('auth.photos.form', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        $parametrs = $request->all();
        $parametrs['image'] = $request->file('image')->store('photos');
        Photo::create($parametrs);
        return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
      $products = Product::get();
      return view('auth.photos.form', compact('products','photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoRequest $request,Photo $photo)
    {
      $parametrs = $request->all();
      unset($parametrs['image']);
      if ($request->has('image')){
        Storage::delete($photo->image);
        $parametrs['image'] = $request->file('image')->store('photos');
      }
      $photo->update($parametrs);
      return redirect()->route('photos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {

        $photo->delete();
        return redirect()->route('photos.index');
    }
}
