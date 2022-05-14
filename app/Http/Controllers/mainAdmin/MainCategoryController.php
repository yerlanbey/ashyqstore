<?php

namespace App\Http\Controllers\mainAdmin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Market;
use App\ProductCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
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
     * @param $category
     * @return Application|Factory|View
     */
    public function show($category)
    {
        $category = Category::find($category);

        return view('MainAdmin.categories.show',compact('category'));
    }

    /**
     * @param $category
     * @return Application|Factory|View
     */
    public function edit($category)
    {
        $category = Category::find($category);

        return view('MainAdmin.categories.form',compact('category'));
    }

    /**
     * @param Request $request
     * @param $category
     * @return RedirectResponse
     */
    public function update(Request $request, $category): RedirectResponse
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
     * @param $category
     * @return RedirectResponse
     */
    public function destroy($category)
    {
        $category = Category::find($category);
        $category->delete();
        return redirect()->route('maincategory.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkSlug(Request $request): JsonResponse
    {
        $slug = SlugService::createSlug(Category::class, 'code', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
