<?php

namespace App\Http\Controllers\mainAdmin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Reply;
use App\Shop;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('MainAdmin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('MainAdmin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $parametrs = $request->all();
        $parametrs['password'] = Hash::make($request['password']);
        if (isset($parametrs['is_admin'])) {
            $parametrs['is_admin'] = 1;
        } else {
            $parametrs['is_admin'] = 0;
        }
        unset($parametrs['image']);
        if ($request->has('image')) {
            $parametrs['image'] = $request->file('image')->store('users');
        }
        User::create($parametrs);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('MainAdmin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $companies = Shop::where('user_id', $user->id)->get();

        return view('MainAdmin.users.form', compact('user', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $parametrs = $request->all();
        $adminCompanies = Shop::where('user_id', $user->id);
        if(isset($parametrs['action'])) {
            $keys = array_keys($parametrs['action']);
            $companies = Shop::where('user_id', $user->id)->whereIn('id', $keys)->get();
            $notCompanies = Shop::where('user_id', $user->id)->whereNotIn('id', $keys)->get();
            foreach ($companies as $company){
                if($company->action != 1){
                    $company->update(['action' => 1]);
                }
            }
            foreach ($notCompanies as $notCompany){
                if($notCompany->action = 1){
                    $notCompany->update(['action' => 0]);
                }
            }
        }else{
            $adminCompanies->update(['action' => 0]);
        }

        if(is_null($parametrs['password'])) {
            unset($parametrs['password']);
        } else {
            $parametrs['password'] = Hash::make($request['password']);
        }

        if (isset($parametrs['is_admin'])) {
            $parametrs['is_admin'] = 1;
        } else {
            $parametrs['is_admin'] = 0;
        }

        unset($parametrs['image']);
        if ($request->has('image')) {
            Storage::delete($user->image);
            $parametrs['image'] = $request->file('image')->store('photos');
        }
        $user->update($parametrs);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::check() && Auth::user()->MainAdmin()) {
            $products = Product::where('user_id', $user->id);
            $companies = Shop::where('user_id', $user->id);
            $comments = Comment::where('user_id', $user->id);
            $replies = Reply::where('user_id', $user->id);
            $comments->delete();
            $replies->delete();
            $products->delete();
            $companies->delete();
            $user->delete();
            return redirect()->back();
        }
    }
}
