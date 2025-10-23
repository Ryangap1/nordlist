<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function index(){

        if(Auth::check()){
            return redirect()->route('panel');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request){
        
        //dd($request);

        //VALIDAR CREDENCIALES
        if(!Auth::validate($request->only('email','password'))){
            return redirect()->to('login')->withErrors('Credenciales incorrectas');
        }

        //CREAR UNA SESION
        $user = Auth::getProvider()->retrieveByCredentials($request->only('email','password'));
        Auth::login($user);

        return redirect()->route('panel')->with('success', 'Bienvenido '.$user->name);

    }
}
