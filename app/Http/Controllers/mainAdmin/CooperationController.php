<?php

namespace App\Http\Controllers\mainAdmin;

use App\Cooperation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CooperationController extends Controller
{
    public function showCooperations()
    {
        $cooperations = Cooperation::orderBy('created_at', 'desc')->paginate(20);
        return view('MainAdmin.cooperations.index', compact('cooperations'));
    }
}
