<?php

namespace App\Http\Controllers\mainAdmin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Market;
use App\ProductCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->whereNull('category_id')->paginate(20);
        return view('MainAdmin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('category_id')
            ->with('childCategories')
            ->get();
        return view('MainAdmin.categories.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $parametrs = $request->all();//все данные из запроса
        unset($parametrs['image']);//исключение картинки
        if($request->has('image')) {
            $parametrs['image'] = $request->file('image')->store('categories');
        }
        Category::create($parametrs);
        return redirect()->route('maincategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        $category = Category::find($category);
        return view('MainAdmin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $category = Category::find($category);

        return view('MainAdmin.categories.form',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {

        $category = Category::find($category);
        $request->validate([
            'name' => 'required',
            'code' => 'required',

        ]);
        $parametrs = $request->all();
        unset($parametrs['image']);
        if($request->has('image')){
            Storage::delete($category->image);
            $parametrs['image']=$request->file('image')->store('categories');
        }
        $category->update($parametrs);
        return redirect()->route('maincategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $category = Category::find($category);
        $category->delete();
        return redirect()->route('maincategory.index');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'code', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
