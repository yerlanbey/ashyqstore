<?php
namespace App\Http\Controllers;
use App\Http\Requests\ProductsFilterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;

use App\Like;
use App\Category;
use App\Product;
use App\Photo;
use App\Comment;
use App\Shop;
use App\Subscribtion;

class MainController extends Controller
{

    public function CategoriesTemplate()
    {
      $categories = Category::orderBy('created_at','desc')->get();
      return view('categories',compact('categories'));
    }

    #Страница продукта
    public function ProductChecking($category, $product=null)
    {
      $category = Category::where('code', $category)->first();
      $product = Product::withTrashed()->where('slug',$product)->firstOrFail();

      $data = Product::all();
      $products = $data->shuffle();

      $comments = Comment::where('product_code',$product->slug)->get();
      $photos = Photo::with('product');

      return view('product',['products' => $products,'product' => $product,
          'comments'=>$comments,'photos'=>$photos, 'category' => $category]);
    }

    #Devide products by category
    public function CategoryShow($code=null){
      $category = Category::where('code',$code)->firstOrFail();
      return view('category',compact('category'));
    }

    public function SubscribtionForm(SubscriptionRequest $request, Product $product)
    {
          Subscribtion::create([
            'email' => $request->email,
            'product_id' => $product->id,
          ]);
      return redirect()->back()->with('success','Спасибо за доверие, мы свяжемся с вами когда появится продукт в наличий');
    }
}
