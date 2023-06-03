<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AdminLoginRequest $request)
    {

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'success' => true,
                'message' => 'Welcome to Admin Panel'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is Incorrect'
            ]);
        }
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin_login');
    }

}
