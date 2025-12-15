<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Title('Login')]

    #[Validate('required')]
    public $email;

    #[Validate('required|min:2')]
    public $password;

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();

            // Redirect berdasarkan role user
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'operator') {
                return redirect()->route('operator.dashboard');
            } else {
                Auth::logout();
                session()->flash('error', 'Role tidak dikenali.');
            }
        } else {
            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->error('Email atau Password yang anda masukan salah!.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}