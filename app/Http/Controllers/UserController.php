<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registerUser(Request $request) {
        \Log::info('Registering user', $request->all());
        $incomingFields = $request->validate([
            'name' => ['required', 'min:1', Rule::unique('users', 'name')],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8']
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $incomingFields['role'] = 'student';
        $registeredUser = User::create($incomingFields);
        return redirect('/login');
    }

    public function loginUser(Request $request) {
        $creds = $request;
        $creds->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/');
        };

        return back()->withErrors([
            'error' => 'Invalid email or password!',
        ]);
    }

    public function logoutUser (Request $request)
    {
        auth()->logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
}
