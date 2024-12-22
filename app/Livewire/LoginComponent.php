<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email, $password;
    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.login');
    }
    public function proses(Request $request)
    {
        $credentials = $this->validate([
            'email'=>'required',
            'password'=>'required'

        ],[
            'email.required'=>'Email Cannot Be Empty!',
            'password.required'=>'Password Must Be Filled!'
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
 
            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'Authentication failed!',
        ])->onlyInput('email');
    }

    public function keluar(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect()->route('login');
    }
}
