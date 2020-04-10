<?php

namespace App\Http\Controllers\Api;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    //
    protected $successStatus = 200;

    public function getAllProduct()
    {
        //$product = Product::with('categories')->with('productImages')->get();
        $product = Product::where('is_deleted', 0)->with(['ProductImage', 'categories', 'sub_category'])->paginate(20);
        if ($product) {
            return response()->json(['status' => 'success', 'data' => $product, 'msg' => 'Data Found'], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Not Found'], $this->successStatus);
        }
    }
    public function getProductBySubCate($id)
    {
        //$product = Product::with('categories')->with('productImages')->get();
        $product = Product::where('is_deleted', 0)->where('sub_category_id', $id)->with(['ProductImage'])->get();

        if ($product) {
            return response()->json(['status' => 'success', 'data' => $product, 'msg' => 'Data Found'], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Not Found'], $this->successStatus);
        }
    }

    public function featuredProducts()
    {
        //$product = Product::with('categories')->with('productImages')->get();
        $product = Product::where('is_deleted', 0)->where('is_featured', 1)->with(['ProductImage', 'categories', 'sub_category'])->get();
        if ($product) {
            return response()->json(['status' => 'success', 'data' => $product, 'msg' => 'Data Found'], $this->successStatus);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Not Found'], $this->successStatus);
        }
    }
}
