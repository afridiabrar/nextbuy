<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Order;

class DriverController extends Controller
{
    //

    public function index()
    {
        $driver = Driver::paginate(10);
        return view('admin.pages.driver', ['driver' => $driver]);
    }

    public function AdddriverPopup()
    {
        return view('admin.popup.add-driver');
    }

    public function EditdriverPopup($id)
    {
        $driver = Driver::find($id);
        return view('admin.popup.edit-driver', ['driver' => $driver]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'name' => 'required|unique:categories',
                'name' => 'required',
                'phone_no' => 'required',
                'driving_lic' => 'required',
                'Address' => 'required',
                'city' => 'required',
                'phone_no_2' => 'required',
                'identity' => 'required'
            ],
            [
                'name.required' => "Name is requried ",
                'phone_no.required' => "Phone No is requried ",
                'driving_lic.required' => "Driving License is requried ",
                'Address.required' => "Address is requried ",
                'city.required' => "City is requried ",
                'phone_no_2.required' => "Phone No 2 is requried ",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));

            return redirect()->back()->withInput();
        }


        $user = Driver::create($request->all());
        if ($user) {
            session()->flash('success', 'Driver Added!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }

    public function changeDriver($driver_id, $order_id)
    {

        $user = Order::find($order_id);
        $user->driver_id = $driver_id;
        if ($user->save()) {
            session()->flash('success', 'Driver Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data Not Found');
            return redirect()->back();
        }
    }


    public function EditCouponPopup()
    { }
    public function EditCoupon(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'name' => 'required|unique:categories',
                'name' => 'required',
                'phone_no' => 'required',
                'driving_lic' => 'required',
                'Address' => 'required',
                'city' => 'required',
                'phone_no_2' => 'required',
                'identity' => 'required'
            ],
            [
                'name.required' => "Name is requried ",
                'phone_no.required' => "Phone No is requried ",
                'driving_lic.required' => "Driving License is requried ",
                'Address.required' => "Address is requried ",
                'city.required' => "City is requried ",
                'phone_no_2.required' => "Phone No 2 is requried ",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));

            return redirect()->back()->withInput();
        }
        unset($_POST['_token']);
        unset($request->_token);
        $data = request()->except(['_token']);
        $user = Driver::where('id', $id)->update($data);
        if ($user) {
            session()->flash('success', 'Driver Update');
            return redirect()->back();
        } else {
            session()->flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }
}
