<?php

namespace App\Http\Controllers\Admin;

use App\BannerImage;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BannerController extends Controller
{
    //

    public function store(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'image' => 'required',
                'slug' => 'required',
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }
        $banner['title'] = $request->title;
        $banner['slug'] = $request->slug;
        $featured_path = 'public/images/banner/';
        $image = upload_image($request, $featured_path);
        if (isset($image)) {
            $banner['banner_image'] = $featured_path . $image['data'];
        }
        $banner = BannerImage::create($banner);
        if ($banner) {
            session()->flash('success', 'Banner Data Uploaded Successfulyy!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Try Again Later');
            return redirect()->back();
        }

        // $output = array(
        //     'success'  => 'Images uploaded successfully',
        //     'image'   => $image_code
        // );
        // return response()->json($output);
    }

    public function banner()
    {
        $banner = BannerImage::orderBy('id', 'DESC')->paginate(10);
        $category = Category::get();
        return view('admin.pages.banner', ['banner' => $banner, 'category' => $category]);
    }

    public function AddBanner()
    {
        $category = Category::get();
        return view('admin.popup.add_banner', ['category' => $category]);
    }

    public function changeBannerImage($id, $status)
    {

        $user = BannerImage::find($id);
        $user->status = $status;
        if ($user->save()) {
            session()->flash('success', 'Status Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data Not Found');
            return redirect()->back();
        }
    }
}
