<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Hash;

class AuthController extends Controller
{

    private $successStatus = 200;

    public function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'f_name' => 'required|string|max:255',
                'l_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
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
            return response()->json(['status' => 'error', 'msg' =>  implode("\n", $validator->errors()->all())], $this->successStatus);
        }
        $request['password'] = Hash::make($request['password']);
        $request['account_type'] = 'local';
        $request['is_admin'] = 0;
        $user = User::create($request->all());
        // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        // $response['token'] = $token;
        $response['user'] = $user;
        return response()->json(['status' => 'success', 'data' => $response, 'msg' => 'Registered Successfully'], $this->successStatus);
    }


    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->status != 'deactivate') {
                    $update_user_things['lat']  = $request->lat;
                    $update_user_things['lng']  = $request->lng;
                    $update_user_things['device_id']  = $request->device_id;
                    User::where('email', $request->email)->update($update_user_things);
                    $token = $user->createToken('Conventional Login')->accessToken;
                    $response = ['token' => $token, 'user' => $user];
                    return response()->json(['status' => 'success', 'data' => $response], $this->successStatus);
                } else {
                    $response = "Your Account is Deactivate Please Contact Admin";
                    return response()->json(['status' => 'error', 'msg' => $response], $this->successStatus);
                }
            } else {
                $response = "Email Or Password Is Incorrect";
                return response()->json(['status' => 'error', 'msg' => $response], $this->successStatus);
            }
        } else {
            $response = "User doesn't exists";
            return response()->json(['status' => 'error', 'msg' => $response], $this->successStatus);
        }
    }
}
