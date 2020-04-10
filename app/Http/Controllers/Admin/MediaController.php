<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Media;
use Validator;

class MediaController extends Controller
{
    //

    public function index()
    {
        $order = Media::orderBy('id', 'DESC')->paginate(10);
        return view('admin.pages.media', ['media' => $order]);
    }

    public function addMedia()
    {
        return view('admin.popup.add-media');
    }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'mimes:jpeg,bmp,png|max:2000',
            ],
            [
                'image.max' => "Maximum file size to upload is 2MB (2024 KB). If you are uploading a photo, try to reduce its resolution to make it under 2MB",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }
        $icon = 'public/images/featured/';
        if ($request->image) {
            $image = upload_image($request, $icon);
            if (isset($image)) {
                $data['image'] = $icon . $image['data'];
                $data['link'] = $icon . $image['data'];
            }
        }
        $user = Media::create($data);
        if ($user) {
            session()->flash('success', 'Media Added!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Some Error Occured');
            return redirect()->back();
        }
    }

    public function deleteMedia($id)
    {
        $check = Media::find($id);
        if ($check) {
            $check->delete();
            session()->flash('error', 'Deleted!');
            return redirect()->back();
        }
    }
}
