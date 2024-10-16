<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        //return view('auth.register');
        $departments = Department::all(); // Ensure you import and use the Department model
        return view('auth.register', compact('departments'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::info($request->all()); 
        
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'email' => [
            // 'required',
            // 'string',
            // 'lowercase',
            // 'email',         
            // 'max:255',
            // 'unique:'.User::class,
            // 'regex:/@raigam\.lk$/'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // // 'dept_select' => ['required','nullable','exists:departments,id']
            // 'dept_select' => ['required', 'exists:departments,id']
        // ]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dept_select' => ['required', 'exists:departments,id'] // Ensure this is validated
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'department_id' => $request->dept_select,
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->dept_select, // Ensure this matches your input name
        ]);

        event(new Registered($user));

        Auth::login($user);

        //return redirect(route('dashboard', absolute: false));
        // return redirect(route('login', absolute: false));
        return redirect()->route('login');
        
    }
}
