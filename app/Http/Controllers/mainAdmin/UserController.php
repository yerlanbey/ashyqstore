<?php

namespace App\Http\Controllers\mainAdmin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Market;
use App\Reply;
use App\Restaurant;
use App\Role;
use App\Shop;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, 'У вас нет прав для этой траницы');
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
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, 'У вас нет прав для этой траницы');
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
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, 'У вас нет прав для этой траницы');
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
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, 'У вас нет прав для этой траницы');
        $shops = DB::table('shops')->where('user_id', $user->id);
        $markets = DB::table('markets')->where('user_id', $user->id);
        $companies = DB::table('restaurants')
        ->where('user_id', $user->id)
        ->union($shops)
        ->union($markets)
        ->get();
        $roles = Role::with('users')->get();

        return view('MainAdmin.users.form', compact(['user', 'companies','roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $parameters = $request->all();

        unset($parameters['image']);
        User::activateOrganization($parameters, $user);
        User::rolesChanges($request, $user);

        if(!is_null($request->password)){
            $parameters['password'] = Hash::make($request['password']);
        }else{
            unset($parameters['password']);
        }
        if($request->has('image')){
            Storage::delete($user->image);
            $parameters['image'] = $request->file('image')->store('photos');
        }
        $user->update($parameters);

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
            abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, 'У вас нет прав для этой действий');

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
