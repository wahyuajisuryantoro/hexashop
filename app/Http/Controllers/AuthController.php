<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                Auth::logout();
                return back()->with('error', 'Access denied. Use the admin portal for login.');
            } else {
                $request->session()->forget('is_admin');
                return redirect()->route('pages.profile');
            }
        } else {
            return back()->withInput($request->only('email'))->with('error', 'Invalid Credentials');
        }
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin.login');
    }


    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            if (Auth::guard('admin')->user()->role === 'admin') {
                Alert::success('Login Successful', 'Welcome to the dashboard.');
                return redirect()->route('dashboard');
            } else {
                Auth::guard('admin')->logout();
                Alert::error('Access Restricted', 'Access restricted to administrators only.');
                return redirect()->route('admin.login');
            }
        } else {
            Alert::error('Login Failed', 'Invalid credentials. Please try again.');
            return redirect()->route('admin.login');
        }
    }



    public function loginUser()
    {
        $title = 'Login';
        return view('auth.user.login', compact('title'));
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been successfully logged out!');
    }

    public function showRegisterForm()
    {
        $title = "Register";
        return view('auth.user.register', compact('title'));
    }

    public function register(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            UserProfile::create([
                'user_id' => $user->id,
                'shipping_address' => $request->shipping_address,
                'phone_number' => $request->phone_number,
            ]);

            DB::commit();
            return redirect()->route('login.user')->with('success', 'Registration successful. Please login.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Registration failed, please try again.');
        }
    }
}
