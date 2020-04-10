<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CouponController extends Controller
{
    //

    public function index()
    {
        $coupon = Coupon::paginate(10);
        return view('admin.pages.coupon', ['coupon' => $coupon]);
    }

    public function changeCoupon($id, $status)
    {

        $user = Coupon::find($id);
        $user->status = $status;
        if ($user->save()) {
            session()->flash('success', 'Status Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function AddCouponPopup()
    {
        return view('admin.popup.add-coupon');
    }

    public function EditCouponPopup($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.popup.edit-coupon', ['coupon' => $coupon]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'code' => 'required|unique:coupons',
                'coupon_value' => 'required',

                'type' => 'required',
            ],
            [
                'name.required' => "Name is requried ",
                'code.required' => "Code No is requried ",
                'coupon_value.required' => "Coupon Value is requried ",

                'type.required' => "City is requried ",

            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }

        $user = Coupon::create($request->all());
        if ($user) {
            session()->flash('success', 'Coupon Added!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }

    public function EditCoupon(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'code' => 'required',
                'coupon_value' => 'required',

                'type' => 'required',
            ],
            [
                'name.required' => "Name is requried ",
                'code.required' => "Code No is requried ",
                'coupon_value.required' => "Coupon Value is requried ",

                'type.required' => "City is requried ",

            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }

        $data = request()->except(['_token']);
        $user = Coupon::where('id', $id)->update($data);
        if ($user) {
            session()->flash('success', 'Coupon Update');
            return redirect()->back();
        } else {
            session()->flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }
}
