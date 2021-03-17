<?php

namespace App\Http\Controllers;

use App\Cooperation;
use Illuminate\Http\Request;

class CooperationController extends Controller
{
    public function storeCooperations(Request $request)
    {
        $parametrs = $request->all();
        Cooperation::create($parametrs);
        return redirect()->route('index-html');
    }
}
