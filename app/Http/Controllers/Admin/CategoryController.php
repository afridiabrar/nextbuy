<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;

class CategoryController extends Controller
{
    //

    public function addPopup(Request $request)
    {
        return view('admin.popup.add-category');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories',
            ],
            [
                'name.required' => "Category Name is Already Exits",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            session()->flash('tab', 'lg2');
            return redirect()->back()->withInput();
        }
        $request['slug'] = str_slug($request->name, '-');
        $icon = 'public/images/icon/';
        if($request->image)
        {
            $image = upload_image($request, $icon);
            if (isset($image)) {
                $request['icon'] = $icon . $image['data'];
            }
        }

        $user = Category::create($request->all());
        if ($user) {
            session()->flash('success', 'Category Added!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }

    public function UpdateCate(Request $request,$id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories',
            ],
            [
                'name.required' => "Category Name is Already Exits",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            session()->flash('tab', 'lg2');
            return redirect()->back()->withInput();
        }
        $request['slug'] = str_slug($request->name, '-');
        $icon = 'public/images/icon/';
        if($request->image)
        {
            $image = upload_image($request, $icon);
            if (isset($image)) {
                $request['icon'] = $icon . $image['data'];
            }
        }
        $data = Request()->except('_token');
        $user = Category::where('id',$id)->update($data);
        if ($user) {
            session()->flash('success', 'Updated!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }

    public function changeCategorystatus($id, $status)
    {

        $user = Category::find($id);
        $user->status = $status;
        if ($user->save()) {
            session()->flash('success', 'Status Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function edit_category($id)
    {
        $cat = Category::find($id);
        return view('admin.popup.edit-category',['cat'=>$cat]);
    }
}
