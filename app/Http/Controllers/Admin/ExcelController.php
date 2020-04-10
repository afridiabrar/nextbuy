<?php

namespace App\Http\Controllers\Admin;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use phpDocumentor\Reflection\Types\Null_;
use App\Product;
use Validator;

class ExcelController extends Controller
{
    //
    public function index()
    {
        return view('admin.pages.csv');
    }
    public  function import(Request $request)
    {
        set_time_limit(0);
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|mimes:csv,txt',
            ],
            [
                'file' => "Csv Format Required",
            ]
        );
        if ($validator->fails()) {
            session()->flash('error', implode("\n", $validator->errors()->all()));
            return redirect()->back()->withInput();
        }
        $path = $request->file('file')->getRealPath();
        $row = 1;
        $dataa = array();
        if (($handle = fopen($path, "r")) !== FALSE) {
            $i = 0;
            while (($data = fgetcsv($handle))) {

                if ($i != 0) {
                    $dataa[] = $data;
                    $product['category_id'] = (!empty($data[0])) ? $data[0] : NULL;
                    $product['category_name'] = (!empty($data[1])) ? $data[1] : NULL;
                    $product['sub_category_id'] = (!empty($data[2])) ? $data[2] : NULL;
                    $product['sub_category_name'] = (!empty($data[3])) ? $data[3] : NULL;
                    $product['is_featured'] = (!empty($data[4])) ? $data[4] : 0;
                    $product['type'] = (!empty($data[5])) ? $data[5] : NULL;
                    $product['sku'] = (!empty($data[6])) ? $data[6] : NULL;;
                    $product['name'] = (!empty($data[7])) ? $data[7] : NULL;;
                    $product['product_slug'] = (!empty($data[7])) ? str_slug($data[7], '-') : NULL;
                    $product['short_description'] = (!empty($data[8])) ? $data[8] : NULL;;
                    $product['description'] = (!empty($data[9])) ? $data[9] : 0;
                    $product['tax_status'] = (!empty($data[10])) ? $data[10] : NULL;;
                    $product['weight'] = (!empty($data[11])) ? $data[11] : NULL;;
                    $product['length'] = (!empty($data[12])) ? $data[12] : NULL;
                    $product['width'] = (!empty($data[13])) ? $data[13] : NULL;;
                    $product['height'] = (!empty($data[14])) ? $data[14] : NULL;
                    $product['price'] = (!empty($data[15])) ? $data[15] : NULL;
                    $product['featured_image'] = (!empty($data[16])) ? trim($data[16]) : NULL;;
                    $product['color'] = (!empty($data[17])) ? $data[17] : NULL;
                    $product['other_information'] = (!empty($data[18])) ? $data[18] : NULL;
                    $product['extra_discount'] = (!empty($data[19])) ? $data[19] : NULL;
                    $pro = Product::where('name', $data[7])->first();
                    if (empty($pro)) {
                        Product::create($product);
                    }
                }
                $i++;
            }
            session()->flash('success', 'Product Uploaded Successfulyy!');
            return redirect()->back();
        }
    }
}
