<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Validator;
use App\ProductImage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
use DataTables;
use File;

class ProductController extends Controller
{
    //

    public function xyz()
    {
        return view('admin.pages.product_serverside');
    }

    public function show_serverside()
    {
        $product = Product::where('is_deleted', 0)->with('ProductImage')->with('categories')->orderBy('id', 'ASC')->get();
        return DataTables::of($product)->make(true);
    }

    public function show()
    {
        $product = Product::with('ProductImage')->with('categories')->orderBy('id', 'ASC')->paginate(8);
        $sub = SubCategory::get();
        $cat = Category::get();
        return view('admin.pages.product', ['product' => $product, 'sub' => $sub, 'cat' => $cat]);
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'products.csv');
    }

    public function addPopup()
    {
        $category = Category::get();
        return view('admin.popup.add-product', ['category' => $category]);
    }

    public function delete_product($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            $update = Product::where('id', $id)->update(['is_deleted' => 1]);
            session()->flash('success', 'Product Has Been Deleted');
            return redirect()->back();
        } else {
            session()->flash('error', 'Not Found!');
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required',
                'image' => 'mimes:jpeg,bmp,png|max:2000',
                'category_id' => 'required',
            ],
            [
                'image.max' => "Maximum file size to upload is 2MB (2024 KB). If you are uploading a photo, try to reduce its resolution to make it under 2MB",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }

        $catData = Category::find($request->category_id);
        if (empty($catData)) {
            session()->flash('error', 'Select Category First!');
            return redirect()->back()->withInput();
        }

        $subCat = SubCategory::where('id', $request->sub_category_id)->first();
        if (empty($subCat)) {
            session()->flash('error', 'Select Sub Category!');
            return redirect()->back()->withInput();
        }
        $featured_path = 'public/images/featured/';
        $featured_image = upload_image($request, $featured_path);
        if (isset($featured_image)) {
            $request['featured_image'] = $featured_path . $featured_image['data'];
        }
        $request['category_id'] = $catData->id;
        $request['category_name'] = $catData->name;
        $request['sub_category_id'] = $subCat->id;
        $request['sub_category_name'] = $subCat->name;
        $request['product_slug'] = str_slug($request->name, '-');
        $data = $request->except('_token');
        $product = Product::create($data);
        if ($product) {
            $type = '';
            $featured_path = 'public/images/product/';
            $images = $request->file('prouct_images');
            if ($images) {
                foreach ($images as $image) {
                    $type = ($image->getMimeType() == 'video/mp4') ? 'video' : 'image';
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/product'), $new_name);
                    $p_image['product_id'] = $product->id;
                    $p_image['type'] = $type;
                    $p_image['prouct_images'] = $featured_path . $new_name;
                    ProductImage::create($p_image);
                }
            }
            // $type = '';
            // $originalImage = $request->file('prouct_images');
            // $featured_path = 'public/images/product/';
            // $imageName = '';
            // if ($originalImage) {
            //     foreach ($originalImage as $image) {
            //         $type = ($image->getMimeType() == 'video/webm' || $image->getMimeType() == 'video/mp4' || $image->getMimeType() == 'video/mov' || $image->getMimeType() == 'video/3gp') ? 'video' : 'image';
            //         if ($type == 'video') {
            //             $new_name = time() . $image->getClientOriginalExtension();
            //             $image->move(public_path('/images/product'), $new_name);
            //             $imageName = $featured_path . $new_name;
            //         } else {
            //             $thumbnailImage = Image::make($image);
            //             $originalPath = 'public/images/product/';
            //             $thumbnailImage->save($originalPath . time() . $image->getClientOriginalName());
            //             $thumbnailImage->resize(150, 150);
            //             $imageName = $featured_path . time() . $image->getClientOriginalName();
            //         }
            //         $p_image['product_id'] = $product->id;
            //         $p_image['type'] = $type;
            //         $p_image['prouct_images'] = $imageName;
            //         ProductImage::create($p_image);
            //     }
        }
        session()->flash('success', 'Product Uploaded Successfulyy!');
        return redirect()->back();
        // $output = array(
        //     'success'  => 'Images uploaded successfully',
        //     'image'   => $image_code
        // );
        // return response()->json($output);
    }


    public function view_product($id)
    {
        $product = Product::where('id', $id)->with('categories')->with('productImages')->first();

        return view('admin.pages.view-product', ['product' => $product]);
    }

    public function edit_product($id)
    {
        $category = Category::get();
        $product = Product::where('id', $id)->with('categories')->with('productImages')->first();
        return view('admin.pages.edit_product', ['product' => $product, 'category' => $category]);
    }

    public function viewPaymentPopup()
    {
        return view('admin.popup.view-product');
    }
    public function editPaymentPopup()
    {
        return view('admin.popup.edit-product');
    }


    public function changeproductStatus($id, $status)
    {

        $user = Product::find($id);
        $user->is_featured = $status;
        if ($user->save()) {
            session()->flash('success', 'Status Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function changeSubStatus($product_id, $sub_cat_id)
    {

        $user = Product::find($product_id);
        $sub = SubCategory::find($sub_cat_id);
        $user->sub_category_id = $sub->id;
        $user->sub_category_name = $sub->name;
        if ($user->save()) {
            session()->flash('success', 'Sub Category Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data Not Found');
            return redirect()->back();
        }
    }
    public function changeCatStatus($product_id, $cat_id)
    {

        $user = Product::find($product_id);
        $cat = Category::find($cat_id);
        $user->category_id = $cat->id;
        $user->category_name = $cat->name;
        if ($user->save()) {
            session()->flash('success', 'Category Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function UpdateProduct(Request $request, $id)
    {


        $product_data = Product::find($id);
        if ($product_data) {
            if (!empty($request->image)) {
                $image_path = $product_data->featured_image;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $featured_path = 'public/images/featured/';
                $featured_image = upload_image($request, $featured_path);
                if (isset($featured_image)) {
                    $request['featured_image'] = $featured_path . $featured_image['data'];
                }
            }
            $cat = Category::find($request->category_id);
            if (!empty($request->sub_category_id)) {
                $subcate = SubCategory::find($request->sub_category_id);
                $request['sub_category_id'] = $subcate->id;
                $request['sub_category_name'] = $subcate->name;
            }
            $request['category_name'] = $cat->name;
            $data = $request->except('_token', 'image');
            $product = Product::where('id', $id)->update($data);
            if ($product) {
                session()->flash('success', 'Product Uploaded Successfulyy!');
                return redirect()->back();
            } else {
                session()->flash('error', 'Error Occured');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Not Found');
            return redirect()->back();
        }
    }

    public function deleteImages($id)
    {
        $image = ProductImage::findOrFail($id);

        $image_path = $image->prouct_images;  // Value is not URL but directory file path
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $image->delete();
        session()->flash('success', 'Deleted Succ');
        return redirect()->back();
    }

    public function addImageGaleryPopup($id)
    {

        $image = Product::find($id);
        if ($image) {
            return view('admin.popup.add-galery', ['product_image' => $image]);
        } else {
            echo "Not Found";
        }
    }

    public function addImage(Request $request)
    {

        $type = '';
        $featured_path = 'public/images/product/';
        $images = $request->file('prouct_images');
        if ($images) {
            foreach ($images as $image) {
                $type = ($image->getMimeType() == 'video/mp4') ? 'video' : 'image';
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/product'), $new_name);
                $p_image['product_id'] = $request->product_id;
                $p_image['type'] = $type;
                $p_image['prouct_images'] = $featured_path . $new_name;
                ProductImage::create($p_image);
            }
        }
        session()->flash('success', 'Galery Images Added');
        return redirect()->back();
    }


    public function ab($a, $b)
    {
        return $a;
    }

    // public function ab($a, $b, $c)
    // { }
}
