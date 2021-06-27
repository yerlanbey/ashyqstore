<?php
namespace App\Http\Controllers;
use App\Dish;
use App\Food;
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

      $categories = Category::orderBy('created_at','desc')->whereNull('category_id')->
          with('childCategories')->get();
      return view('categories',compact('categories'));

    }

    // Страница продукта
    public function ProductPage($category, $productSlug=null)
    {

        $category = Category::where('code', $category)->first();

        $product = Product::withTrashed()->where('slug',$productSlug)->first();
        $food = Food::withTrashed()->where('slug',$productSlug)->first();
        $dish = Dish::withTrashed()->where('slug', $productSlug)->first();


        if(isset($product)){
            $data = Product::all();
            $products = $data->shuffle();

            $comments = Comment::where('product_code',$product->slug)->get();
            $photos = Photo::with('products');

            return view('product',['products' => $products,'product' => $product,
                'comments'=>$comments,'photos'=>$photos, 'category' => $category]);
        }else if(isset($food)){
            $data = Food::all();
            $products = $data->shuffle();

            $comments = Comment::where('food_code',$food->slug)->get();

            $photos = Photo::with('foods');

            $product = $food;
            return view('product',['products' => $products,'product' => $product,
                'comments'=>$comments,'photos'=>$photos, 'category' => $category]);        }
        else if(isset($dish)){
            $data = Dish::all();
            $products = $data->shuffle();

            $comments = Comment::where('dish_code',$dish->slug)->get();

            $photos = Photo::with('dishes');

            $product = $dish;
            return view('product',['products' => $products,'product' => $product,
                'comments'=>$comments,'photos'=>$photos, 'category' => $category]);
        }


    }

    #Devide products by category
    public function CategoryShow($code=null){
      $category = Category::where('code',$code)->firstOrFail();
      return view('category',compact('category'));
    }

    public function ChildCategoryShow($ParentParentCaategory=null,$ParentCategory=null,$childCategory=null)
    {
        $category = Category::where('code',$childCategory)->firstOrFail();
        return view('products',compact('category'));
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
