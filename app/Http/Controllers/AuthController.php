<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function create() 
    {
        return view('register');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nickname' => 'required|unique:users',
            'group' => 'required',
            'tg_username' => 'required|unique:users',
            'idcard' => 'required|mimes:jpg,jpeg,png',
            'password' => 'required|confirmed',
        ]);

        if($request->hasFile('idcard'))
        {
            $folder = date('Y-m-d');
            $path = $request->file('idcard')->store("userscard/{$folder}", 'public');
            $url = Storage::url($path);
            $cardfile = $url;
        }

        $user = User::create([
            'nickname' => $request->nickname,
            'tg_username' => $request->tg_username,
            'group' => $request->group,
            'idcard' => $cardfile,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('profile')->with('success', 'Ожидайте верификации');
    }

    public function loginForm() 
    {
        return view('login');
    }

    public function login(Request $request) 
    {
        $request->validate([
            'nickname' => 'required',
            'password' => 'required',
        ]);
        
        if(Auth::attempt([
            'nickname' => $request->nickname,
            'password' => $request->password,
        ])){
            $time = date('H:i:s');
            session()->flash('success', "Вы авторизовались под именем ". Auth::user()->nickname .", время: $time");
            
            // if(Auth::user()->is_admin)
            // {
            //     return redirect()->route('admin.index');
            // } 
            // else 
            // {
            //     return redirect()->route('home');
            // }
            return redirect()->route('home');
            
        }
        
        return redirect()->back()->withErrors('Неправильный логин или пароль');
    }

    public function logout(Request $request) 
    {
        Auth::logout();

        return redirect()->route('home')->withErrors('Вы вышли из системы');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
