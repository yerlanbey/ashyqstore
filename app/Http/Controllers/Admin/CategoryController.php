<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\CategoryRequest;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return view('auth.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.categories.form');
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
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('.auth.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
//        return view('auth.categories.form',compact('category'));
        return '<h1 style="text-align: center;">
            Для этой действий вам потребуется права Главного Администратора
            </h1>';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {

//        $parametrs = $request->all();//Получаем все данные из запроса
//        unset($parametrs['image']);//исключаем карттинку
//        if($request->has('image')){// проверяем если есть картинка
//            Storage::delete($category->image);//удаляем превед картинку
//            $parametrs['image']=$request->file('image')->store('categories');//сохр новую картинку в файл
//        }
//        $category->update($parametrs);//обновляем все данные
//        return redirect()->route('categories.index');//отправляем на индекс страницу
        return '<h1 style="text-align: center;">
            Для этой действий вам потребуется права Главного Администратора
            </h1>';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
//        $category->delete();
//        return redirect()->route('categories.index');
        return '<h1 style="text-align: center;">
            Для этой действий вам потребуется права Главного Администратора
            </h1>';
    }
}
