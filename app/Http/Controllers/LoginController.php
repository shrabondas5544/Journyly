<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->passes()){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Success message when login is successful
                return redirect()->route('account.dashboard')
                    ->with('success', 'Welcome back '. Auth::user()->name .'! You have successfully logged in.');
            } else {
                // Error message for incorrect credentials
                return redirect()->route('account.login')
                    ->with('error', 'Either email or password is incorrect.');
            }
        } else {
            // Error message for validation failures
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Please check your input and try again.');
        }
    }

    public function register(){
        return view('register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:11',
            'password' => 'required|confirmed',
        ]);
   
        if($validator->passes()){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'customer'
            ]);
           
            // Success message for registration
            return redirect()->route('account.login')
                ->with('success', 'Registration successful! Please login to continue.');
        } else {
            // Error message for validation failures
            return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator)
                ->with('error', 'Please fix the errors in your registration form.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Info message for logout
        return redirect()->route('account.login')
            ->with('info', 'You have been successfully logged out.');
    }

    // Example of using warning message (you could add this method if needed)
    public function checkAccountStatus()
    {
        if(Auth::user()->subscription === 'free') {
            return redirect()->back()
                ->with('warning', 'You are currently on the Free plan. Upgrade to access premium features.');
        }
    }
}