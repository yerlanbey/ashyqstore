<?php

namespace App\Http\Controllers\mainAdmin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
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
        $categories = Category::orderBy('created_at', 'desc')->paginate(20);
        return view('MainAdmin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('MainAdmin.categories.form');
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
    public function update(CategoryRequest $request, $category)
    {

        $category = Category::find($category);
        $parametrs = $request->all();//Получаем все данные из запроса
        unset($parametrs['image']);//исключаем карттинку
        if($request->has('image')){// проверяем если есть картинка
            Storage::delete($category->image);//удаляем превед картинку
            $parametrs['image']=$request->file('image')->store('categories');//сохр новую картинку в файл
        }
        $category->update($parametrs);//обновляем все данные
        return redirect()->route('maincategory.index');//отправляем на индекс страницу
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
}
