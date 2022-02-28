<?php
namespace App\Http\Controllers;
use App\API\CategoriesList;
use App\API\SubCategories;
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
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    /**
     * @var $host
     */
    public $host;

    /**
     * @var $token
     */
    public $token;

    /**
     * ShopController constructor.
     *
     */
    public function __construct()
    {
        $this->host  = config('product-list-api')['host'];
        $this->token = config('product-list-api')['access-token'];
    }

    public function CategoriesTemplate()
    {
        try {
            $endpoint = Http::get("$this->host/categories?$this->token");
            $categories = collect($endpoint->json())->whereIn('id', CategoriesList::IdArray());

            return view('categories',compact('categories'));
        }catch (\DomainException $exception) {
            throw new \DomainException($exception->getMessage());
        }

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

    /**
     * @param SubCategories $subCategories
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function CategoryShow(SubCategories $subCategories, $id = null)
    {
        try {
            $subCategoriesIds = $subCategories->getSubCategories($id);
            $endpoint         = Http::get("$this->host/categories?$this->token");
            $subCategories    = collect($endpoint->json())->whereIn('id', $subCategoriesIds);

            return view('category',compact('subCategories', 'id'));
        }catch (\DomainException $exception) {
            throw new \DomainException($exception->getMessage());
        }
    }

    /**
     * @param null $category
     * @param null $subCategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function elements($category = null, $subCategory = null)
    {
        try {
            $category = Http::get("$this->host/categories?$this->token&id=$subCategory")->json()[0];
            $endpoint = Http::get("$this->host/elements?$this->token&category=$subCategory");
            $elements = $endpoint->json();

            $elementsId = implode(",", array_map(function ($item): int {
                return $item['article'];
            }, $elements));

            $images = Http::get("$this->host/images?$this->token&article=$elementsId")->json();



            return view('elements', compact('elements', 'category', 'images'));
        }catch (\DomainException $exception) {
            throw new \DomainException($exception->getMessage());
        }
    }
    public function ChildCategoryShow($ParentParentCaategory=null,$ParentCategory=null,$childCategory=null)
    {
        $category = Category::where('code',$childCategory)->firstOrFail();
        return view('products',compact('category'));
    }

    /**
     * @param null $elementId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function elementDetail($elementId = null)
    {
        $additionally = 'description,detailtext,images';
        try {
            $element = Http::get("$this->host/element-info?$this->token&article=$elementId&additional_fields=$additionally")->json()[0];
            $category = Http::get("$this->host/categories?$this->token&id=" . $element['category'])->json()[0];

            return view('api.element', compact('element', 'category'));
        }catch (\DomainException $exception) {
            throw new \DomainException($exception->getMessage());
        }
    }


    public function SubscribtionForm(SubscriptionRequest $request, Product $product)
    {
        Subscribtion::query()->create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);
        return redirect()->back()->with('success','Спасибо за доверие, мы свяжемся с вами когда появится продукт в наличий');
    }
}
