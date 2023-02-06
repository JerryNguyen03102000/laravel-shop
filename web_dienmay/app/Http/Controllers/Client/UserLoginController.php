<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Session;

class UserLoginController extends Controller
{
    public function login()
    {
        return view('client.login');
    }

    public function register(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]
        );
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->save();
        $request->session()->put('LoggedUser',  $customer->id);
        return redirect()->route('user-checkout');


    }

    public function CheckloginUser(Request $request)
    {

        $request->validate([
                'email_login' => 'required|email',
                'password_login' => 'required|min:6',
            ]
        );
        $userInfor = Customer::where('email', '=', $request->email_login)->first();
        if (!$userInfor) {
            return back()->with('fail', 'We do not recognize your email address');
        } else {
            if (Hash::check($request->password_login, $userInfor->password)) {
                $request->session()->put('LoggedUser', $userInfor->id);
                return redirect()->route('user-checkout');
            } else {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }

    public function userLogout()
    {
        if (session()->has('LoggedUser')) {
            session()->forget('LoggedUser');
            return redirect()->route('view-user-login')->with('success', ' Logout Success');
        }

    }
}
