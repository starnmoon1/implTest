<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showFormLogin(){
        return view('layout.login');
    }

    public function login(Request $request){
        $email = $request->email;
        $pass = $request->password;

        $data =[
            'email' => $email,
            'password'=>$pass
        ];
        if(Auth::attempt($data)){
            if(Auth::user()->role =='1')
            return redirect('admin');
            elseif (Auth::user()->role == '2')
                return redirect('seller');
            elseif (Auth::user()->role == '3')
                return redirect('buyer');
        };

        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

}
