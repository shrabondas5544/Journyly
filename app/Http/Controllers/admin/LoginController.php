<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //this methode will show admin login page/screen
    public function index() {
        return view('admin.login');
    }

    //this methode will authenticate admin
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->passes()){

            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

                if(Auth::guard('admin')->user()->role != "admin") {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')
                    ->with('error', 'You are not authorized to sccess this page.');
                }


                // Success message when login is successful
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back! You have successfully logged in.');
            } else {
                // Error message for incorrect credentials
                return redirect()->route('admin.login')
                    ->with('error', 'Either email or password is incorrect.');
            }
        } else {
            // Error message for validation failures
            return redirect()->route('admin.login')
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Please check your input and try again.');
        }
    }

    //this method will logout admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')
            ->with('success', 'You have been successfully logged out.');
    }
}
