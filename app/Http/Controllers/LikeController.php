<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function getLikes($productId){
        $product = Product::find($productId);

        if (!$product){
            return redirect()->route('index-html');
        }
        if(Auth::user()->hasLikedProduct($product)){
            return redirect()->back();
        }
        $product->likes()->create(['user_id' => Auth::user()->id]);
        return redirect()->back();
    }

    public function getDislike($productId)
    {
        $product = Product::find($productId);
        if (!$product){
            return redirect()->route('index-html');
        }
        if(Auth::user()->hasLikedProduct($product)){
            $product->likes()
                ->where('likeable_id', $product->id)
                ->where('likeable_type', get_class($product))
                ->where('user_id', Auth::user()->id)->delete();
            return redirect()->back();
        }
    }
}
