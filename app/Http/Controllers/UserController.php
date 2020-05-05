<?php

namespace App\Http\Controllers;

use App\Http\services\UserService;
use App\RequestUser;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function goToPageAdmin()
    {
        $users = User::all();
        $sellers = DB::table('users')->where('role' == '2');
        $buyers = DB::table('users')->where('role' == '3');;
        if (Auth::user()->role == '1') {
            return view('admin.index', compact('users', 'sellers', 'buyers'));
        } else
            return view('layout.login');
    }

    public function goToPageSeller()
    {
        if (Auth::user()->role != '3') {
            return view('seller.index');
        } else
            return view('layout.login');
    }

    public function goToPageBuyer()
    {
        $buyer = Auth::user();
        return view('buyer.index', compact('buyer'));
    }


    public function create()
    {
        return view('buyer.register');
    }


    public function store(Request $request)
    {
        $this->userService->create($request);
        Session::flash('succes', 'Create account thành công');
        return redirect('/buyer');
    }


    public function requestBuyerToSeller()
    {
        $requestUser = new RequestUser();
        $requestUser->user_id = Auth::user()->id;
        $requestUser->status = '1';
        $requestUser->save();
        return redirect('buyer');
    }

    public function activeRequestUser($id) {
        $user = User::findOrFail($id);
        $user->role == '2';
        $this->destroyRequestUser($id);
        return redirect()->route('admin.index');
    }



    public function destroyRequestUser($id)
    {
        $requestUser = RequestUser::findOrFail($id);
        $requestUser->delete();
        return redirect('admin');
    }
}
