<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function FormLogin()
    {
        if(Auth::check()){
            return redirect()->route('admin.dashboard');
        }
        $title = 'Login';
        return view('admin.login.login', compact('title'));
    }

    public function StoreLogin(Request $request)
    {
        // Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'

        ], [
                'email.required' => 'The field is required',
                'email.email' => 'Email is format is invalid',
                'password.required' => 'The field is required'
            ]
        );

        // check đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            //remember me
            $remember = $request->remember;
            if ($remember) {
                setcookie('login_email', $request->email, time() + (86400 * 365));
                setcookie('login_password', $request->password, time() + (86400 * 365));
            } else {
                setcookie('login_email', $request->email, time() - 3600);
                setcookie('login_password', $request->password, time() - 3600);
            }
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin-login')->with('fail', 'Your email or password is incorrect. Please try enter!');
        }
    }

    public function FormForgot()
    {
        $title = 'ForgotPassword';
        return view('admin.login.forgotPassword', compact('title'));
    }

    public function ShowResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'The field is required',
            'email.email' => 'Email is format is invalid',
        ]);
        $email = DB::table('users')->where('email', $request->email)->first();
        if (!$email) {
            return redirect()->route('form-forgot')->with('fail', 'Your login email is incorrect. Please try enter');
        } else {

            $token = Str::random(32);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            $action_link = route('reset-password-form', ['token' => $token, 'email' => $request->email]);
            $body = "
            We have sent you a password reset link for $request->email ,Click the link below to reset your password
                 ";
            Mail::send('admin.login.email-forgot', ['action_link' => $action_link, 'body' => $body], function ($email) use ($request) {
                $email->from('noreply@exam.com', 'Admin');
                $email->to($request->email, 'Your Name')->subject('Reset Password');

            });
            return redirect()->route('form-forgot')->with('success', 'Email sent. Please check your email to receive new password');
        }
    }

    public function ShowResetForm(Request $request, $token = null)
    {
        return view('admin.login.reset-password', ['title' => 'Reset Password'])->with(['token' => $token, 'email' => $request->email]);
    }
    public function ResetPassword(Request $request){
        // validate
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|max:12',
            'confirm' => 'required|same:password'
        ]);
      $check_email = DB::table('password_resets')->where(
        ['email' => $request->email, 'token' => $request->token,]
      )->first();
      if($check_email){
          User::where('email', $request->email)->update([
              'password' => bcrypt($request->password)
          ]);
          DB::table('password_resets')->where([
                  'email' => $request->email,
              ]
          )->delete();
          return redirect()->route('admin-login')->with('success','Reset password success');
      }
    }

    public function Logout()
    {
        Session::flush();
        return redirect()->route('admin-login')->with('success', 'Logout success');
    }


}
