<?php

namespace App\Http\Controllers\Api;

use App\Coupon;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Query;

class QueryController extends Controller
{
    //
    protected $successStatus = 200;


    public function page()
    {
        $page = Page::where('id', 1)->first();
        if ($page) {
            return response()->json(['status' => 'success', 'msg' => 'Pages Information file', 'data' => $page], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Not Found'], $this->successStatus);
        }
    }

    public function coupon_details()
    {
        $coupon =  Coupon::where('status','Active')->get();
        if ($coupon) {
            return response()->json(['status' => 'success', 'msg' => 'Coupon Detail Found', 'data' => $coupon], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Not Found'], $this->successStatus);
        }
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phone_no' => 'required',
                'subject' => 'required',
                'message' => 'required',

            ],
            [
                'name.required' => "Full Name is Required",
                'phone_no.required' => "Phone Number is Required",
                'email.required' => "Email is Required",
                'email.email' => "Email Is Badly Formated",
                'subject.email' => "Subject Is Required",
                'message.required' => "Message is Required",
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->errors()->all()], $this->successStatus);
        }

        $request['query_type'] = 'contact-us';
        $request['user_id'] = (!empty($user)) ? $user->id : NULL;
        $user = Query::create($request->all());
        if ($user) {
            return response()->json(['status' => 'success', 'msg' => 'Your Message Has Been Sent!'], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Some Error Occured'], $this->successStatus);
        }
    }
}
