<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AuthForm extends Form
{
    #[Validate("required|max:255")]
    public string $username;
    #[Validate("required|max:255")]
    public string $password;

    public function login(): bool
    {
        $validated = $this->validate();
        if (Auth::attempt($validated)) {
            $user = Auth::user();
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
