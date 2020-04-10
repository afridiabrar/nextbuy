<?php

namespace App\Http\Controllers\Admin;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;

class SubCategoryController extends Controller
{
    //

    public function subCategory()
    {
        $category = SubCategory::with('categories')->orderBy('id', 'DESC')->get();
        return view('admin.pages.sub-category', ['category' => $category]);
    }

    public function addSubCat()
    {
        $category = Category::paginate(30);
        return view('admin.popup.add-sub-category', ['category' => $category]);
    }

    public function editSubCat($id)
    {
        $check = SubCategory::find($id);
        if($check){
            $category = Category::paginate(30);
            return view('admin.popup.edit_sub_category', ['category' => $category,'data'=>$check]);
        }else{
            echo "Not Found";
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:sub_categories',
                'category_id' => 'required',
                'image' => 'mimes:jpeg,bmp,png|max:2000',
            ],
            [
                'name.required' => "Sub Category Already Exits",
                'category_id.required' => "Category Name is Required",
                'image.max' => "Maximum file size to upload is 2MB (2024 KB). If you are uploading a photo, try to reduce its resolution to make it under 2MB",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }
        $request['slug'] = str_slug($request->name, '-');

        $icon = 'public/images/banner/';
        if ($request->image) {
            $image = upload_image($request, $icon);
            if (isset($image)) {
                $request['banner_image'] = $icon . $image['data'];
            }
        }
        $user = SubCategory::create($request->all());
        if ($user) {
            session()->flash('success', 'Sub Category Added!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }

    public function getCategoryAjax(Request $request)
    {

        $category = SubCategory::where('category_id', $request->id)->get();
        foreach ($category as $k => $v) {
            echo "<option value='$v->id'>" . $v->name . "</option>";
        }
    }

    public function updateSubCategory(Request $request,$id)
    {
        $check = SubCategory::find($id);
        if (empty($check)) {
            session()->flash('error', 'Sub Category Not Found');
            return redirect()->back()->withInput();
        }
        $validator = Validator::make(
            $request->all(),
            [

                'category_id' => 'required',
                'image' => 'mimes:jpeg,bmp,png|max:2000',
            ],
            [
                'category_id.required' => "Category Name is Required",
                'image.max' => "Maximum file size to upload is 2MB (2024 KB). If you are uploading a photo, try to reduce its resolution to make it under 2MB",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }
        $request['slug'] = str_slug($request->name, '-');
        $icon = 'public/images/banner/';
        if ($request->image) {
            $image = upload_image($request, $icon);
            if (isset($image)) {
                $request['banner_image'] = $icon . $image['data'];
            }
        }
        $data = Request()->except(['_token','image']);
        $user = SubCategory::where('id',$id)->update($data);
        if ($user) {
            session()->flash('success', 'Sub Category Added!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Some Error Occurred');
            return redirect()->back();
        }
    }
}
