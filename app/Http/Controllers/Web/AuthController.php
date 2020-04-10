<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use App\User;
use Auth;

class AuthController extends Controller
{
    //
    public function authentication()
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        return view('web.auth.auth');
    }


    public function registerUser(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'f_name' => 'required|string|max:255',
                'l_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:6'
            ],
            [
                'f_name.required' => "First Name is Required",
                'l_name.required' => "Last Name is Required",
                'email.required' => "Email is Required",
                'email.email' => "Email Is Badly Formated",
                'password.required' => "Password is Required",
            ]
        );

        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            session()->flash('tab', 'lg2');
            return redirect()->back()->withInput();
        }

        $request['password'] = Hash::make($request['password']);
        $request['account_type'] = 'local';
        $request['is_admin'] = 0;
        $user = User::create($request->all());
        if ($user) {
            session()->flash('success', 'Now You Can Login!');
            return redirect()->back();
        } else {
            session()->flash('success', 'Some Error Occured');
            return redirect()->back();
        }
    }

    public function doLogin(Request $request)
    {

        $remember_me = $request->has('remember_me') ? true : false;
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'min:6|required'
            ],
            [
                'email.required' => "Email is Required",
                'email.email' => "Email Is Badly Formated",
                'password.required' => "Password is Required",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }

        $remember_me = $request->has('remember') ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 0], $remember_me)) {
            if (Auth::user()) {
                User::find(Auth::id());
                return redirect('/index');
            } else {
                $user = User::find(Auth::id());
                session()->flash('success', 'Invalid Credentials!');
                return redirect()->back();
            }
        }
        session()->flash('error', 'Invalid Credentials!');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        session()->flash('success', 'Logout Successfully!');
        return redirect()->back();
    }
}
