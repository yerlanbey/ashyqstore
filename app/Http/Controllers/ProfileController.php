<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile($userId)
    {
        $user = User::find($userId);

        return view('auth.profiles.profile', compact('user'));
    }

    public function editProfile($userId)
    {
        $user = User::find($userId);
        return view('auth.profiles.edit', compact('user'));
    }

    public function updateProfile(Request $request,$userId)
    {

        $user = User::find($userId);

        $parametrs = $request->all();
        if(is_null($parametrs['password'])){
            unset($parametrs['password']);
        }else{
            $parametrs['password'] = Hash::make($request['password']);
        }
        unset($parametrs['image']);
        if ($request->has('image')){
            Storage::delete($user->image);
            $parametrs['image'] = $request->file('image')->store('photos');
        }
        $user->update($parametrs);

        return redirect()->back();


    }
    public function chosen($userId){
        $likes = Like::where('user_id', $userId)->get();
        $array = array();
        foreach ($likes as $like){
            array_push($array,$like->likeable_id);
        }
        $products = Product::whereIn('id',$array)->get();
        return view('auth.profiles.chosen',compact('products'));
    }
}
