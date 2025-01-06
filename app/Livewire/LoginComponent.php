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
        // Validasi input
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email Cannot Be Empty!',
            'password.required' => 'Password Must Be Filled!',
        ]);

        // Proses login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan pengguna sesuai jenis
            if (Auth::user()->isAdmin()) {
                return redirect()->route('home'); // Pastikan route ini ada
            } elseif (Auth::user()->isMember()) {
                return redirect()->route('home'); // Pastikan route ini ada
            }
        }

        session()->flash('error', 'Authentication failed!');
        return back()->withErrors(['email' => 'Invalid credentials!']);
    }

    public function keluar(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
