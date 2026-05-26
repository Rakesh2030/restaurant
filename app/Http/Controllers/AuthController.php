<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function registerform(){
        return view('admin.auth.register');
    }
    public function registerstore(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 1,
        ]);

        Auth::login($user);

        return redirect()->route('frontend.home')->with('success','Registration successful');

    }
    public function loginform(){
        return view('admin.auth.login');
    }
    public function loginpost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email','password');
        $remember = $request->has('remember');

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();

            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.page')->with('success', 'Login successful');
            }

            return redirect()->route('frontend.home')->with('success', 'Login successful');
        }

        return redirect()->back()->withInput()->with('error','Invalid email or password');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.home')->with('success', 'Logout successful');
    }
}
