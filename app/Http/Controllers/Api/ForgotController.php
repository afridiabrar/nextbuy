<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Mail;
use App\Mail\Forgot;
use Hash;

class ForgotController extends Controller
{
    //

    public $successStatus  = 200;

    public function sendMail(Request $request)
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
                return response()->json(['status' => 'success', 'msg' => 'Password Reset Email Sent!'], $this->successStatus);
            } else {
                return response()->json(['status' => 'error', 'msg' => 'Something Went Wrong!'], $this->successStatus);
            }
        }
    }
    public function SendForgetMessage($code, User $user)
    {
        return Mail::to($user)->send(new Forgot($user));
    }

    // public function send_mail(Request $request)
    // {

    //     $user = User::where('email', $request->email)->first();
    //     $code = substr(md5(rand()), 0, 5);
    //     if (!$user) {
    //         return response()->json(['status' => 'error', 'msg' => "Email Doesn't Exists!"], $this->status);
    //     } else {
    //         $user->confirmation_code = $code;
    //         $user->save();
    //         $this->SendForgetMessage($code, $user);
    //         if ($user) {
    //             return response()->json(['status' => 'success', 'msg' => 'Password Reset Email Sent!', 'data' => $user], $this->status);
    //         } else {
    //             return response()->json(['status' => 'error', 'msg' => 'Something Went Wrong!'], $this->status);
    //         }
    //     }
    // }

    // public function SendForgetMessage($code, User $user)
    // {
    //     return Mail::to($user)->send(new Forgot($user));
    // }

    // public function UpdatePassword(Request $request)
    // {

    //     $user = User::where('email', $request->email)->where('confirmation_code', $request->confirmation_code)->first();
    //     if (!empty($user)) {
    //         $password = $request->password;
    //         $con_password = $request->confirm_password;
    //         if ($password == $con_password) {
    //             $user->password = Hash::make($password);
    //             $user->confirmation_code = Null;
    //             $user->save();
    //             $msg =  'Password Change Now You Can Login!';
    //             return response()->json(['status' => 'success', 'msg' => $msg, 'data' => $user], $this->status);
    //         } else {
    //             $msg = 'Please Check Password Is Matched & Verification is Correct!';
    //             return response()->json(['status' => 'error', 'msg' => $msg, 'data' => $request->email], $this->status);
    //         }
    //     } else {
    //         $msg = 'Please Check Password Is Matched & Verification is Correct!';
    //         return response()->json(['status' => 'error', 'msg' => $msg], $this->status);
    //     }
    // }
}
