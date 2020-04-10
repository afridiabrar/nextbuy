<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Mail;
use App\Mail\Forgot;
use Hash;

class ForgotController extends Controller
{
    //
    public function send_mail(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        $code = substr(md5(rand()), 0, 8);
        if (!$user) {
            session()->flash('error', "Email Doesn't Exists!");
            return redirect()->back();
        } else {
            $user->confirmation_code = $code;
            $user->save();
            $this->SendForgetMessage($code, $user);
            $update['password'] = Hash::make($code);
            $update['confirmation_code'] = Null;
            User::where('id', $user->id)->update($update);
            $user = User::where('id', $user->id)->first();
            if ($user) {
                session()->flash('success', 'Password Reset Email Sent!');
                return redirect()->back();
            } else {
                session()->flash('error', 'Something Went Wrong!');
                return redirect()->back();
            }
        }
    }
    public function SendForgetMessage($code, User $user)
    {
        return Mail::to($user)->send(new Forgot($user));
    }
}
