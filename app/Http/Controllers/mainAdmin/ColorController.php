<?php

namespace App\Http\Controllers\mainAdmin;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::get();
        return view('MainAdmin.colors.index', compact('colors'));
    }
    public function create()
    {
        return view('MainAdmin.colors.form');
    }
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
            'code' => 'required'
        ]);

        $success = Color::create($request->all());

        if($success){
            return redirect()->back()->with('success', 'Успешно добавлено!');
        }else {
            return redirect()->back()->with('warning', 'Повторите попытку!');
        }
    }
    public function edit($id)
    {

    }
    public function update($id)
    {

    }

    public function delete($color)
    {
        $color = Color::find($color);
        $success = $color->delete();
        if($success){
            return redirect()->back()->with('success', 'Успешно удалено!');
        }else {
            return redirect()->back()->with('warning', 'Повторите попытку!');
        }
    }
}
