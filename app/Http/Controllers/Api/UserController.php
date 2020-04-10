<?php

namespace App\Http\Controllers\Api;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validator;
use Hash;

class UserController extends Controller
{
    //
    protected $successStatus = 200;
    public function logOut(Request $request)
    {
        $user = $request->user();
        $update['device_id'] = NULL;
        User::where('id', $user->id)->update($update);
        $token = $request->user()->token();
        $token->revoke();
        $response = 'You have been succesfully logged out!';
        return response()->json(['status' => 'error', 'msg' => $response], $this->successStatus);
    }

    public function userInfo(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user = Auth::user();
            return response()->json(['status' => 'success', 'msg' => 'User Information', 'data' => $user], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Not Found'], $this->successStatus);
        }
    }


    public function changePassword(Request $request)
    {

        $user = $request->user();
        if (empty($user)) {
            return response()->json(['status' => 'error', 'msg' => 'Please Login First!'], $this->successStatus);
        }
        $validator = Validator::make(
            $request->all(),
            [
                'old_password' => 'min:6',
                'password' => 'min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:6'
            ],
            [
                'password.required' => "Password is Required",
            ]
        );
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->errors()->all()], $this->successStatus);
        }
        $user = User::where('id', $user->id)->first();
        if ($user) {
            $CheckPass = Hash::check($request->old_password, $user->password);
            if ($CheckPass) {
                $new_password = $request->password;
                $user->password = Hash::make($new_password);
                $user->save();

                return response()->json(['status' => 'success', 'msg' => 'Password Changed'], $this->successStatus);
            } else {
                return response()->json(['status' => 'success', 'msg' => "old Password Doesn't Match"], $this->successStatus);
            }
        } else {
            return response()->json(['status' => 'success', 'msg' => 'User Not Found!'], $this->successStatus);
        }
    }

    public function update(Request $request)
    {
        $user = $request->user();
        if (isset($request->image)) {
            $image_path = 'public/images/profile/';
            $image = upload_image($request, $image_path);
            $update['picture_type'] = 'Local';
            $update['profile_pic'] = $image_path . $image['data'];
        }
        $update['f_name'] = $request->f_name;
        $update['l_name'] = $request->l_name;
        $update['phone_no'] = $request->phone_no;
        $update['gender'] = $request->gender;
        $user = User::where('id', $user->id)->update($update);
        if ($user) {
            return response()->json(['status' => 'success', 'msg' => 'User Information Updated!'], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'User Not Found!'], $this->successStatus);
        }
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $updatee['default_address'] = 0;
        $update = Address::where('user_id', $user->id)->update($updatee);
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'address1' => 'required',
                'phone' => 'required'
            ],
            [
                'first_name.required' => "First Name is Required",
                'last_name.required' => "Last Name is Required",
                'address1.required' => "Address is Required",
                'phone.required' => "Phone No is Required",
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => implode("\n", $validator->errors()->all())], $this->successStatus);

        }

        $request['user_id'] = $user->id;
        $request['default_address'] = 1;
        unset($request['_token']);
        $address = Address::create($request->all());
        if ($address) {

            return response()->json(['status' => 'success', 'msg' => 'Address Has Been Added!'], $this->successStatus);

        } else {

            return response()->json(['status' => 'error', 'msg' => 'Please Try Again Later!'], $this->successStatus);

        }
    }
}
