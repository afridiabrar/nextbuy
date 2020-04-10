<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Order;
use App\Query;
use DB;
use App\Page;
use App\Payment;


class MainController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('admin')->except(['login', 'do_login']);
    }

    public function login()
    {
        return view('admin.auth.login');
    }


    public function category()
    {
        $cate = Category::orderBy('id','DESC')->get();
        return view('admin.pages.category', ['category' => $cate]);
    }



    public function payment()
    {
        $order = Payment::with(['orders', 'users', 'orders.order_product.product',])->orderBy('id', 'DESC')->paginate(10);

        return view('admin.pages.payment', ['payment' => $order]);
    }

    public function do_login(Request $request)
    {
        $remember_me = $request->has('remember') ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1], $remember_me)) {
            if (Auth::user()) {
                User::find(Auth::id());
                return redirect('admin/ ');
            } else {
                $user = User::find(Auth::id());
                session()->flash('success', 'Invalid Credentials!');
                return redirect()->back();
            }
        }
        session()->flash('error', 'Invalid Credentials!');
        return redirect()->back();
    }

    public function Alogout()
    {

        Auth::logout();
        session()->flash('success', 'Logout Successfully!');
        return redirect()->back();
    }


    public function users()
    {
        $user = User::paginate(10);
        return view('admin.pages.user', ['user' => $user]);
    }

    public function popup_edit_user($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.popup.view_user', ['user' => $user]);
    }

    public function changeuserstatus($id, $status)
    {

        $user = User::find($id);
        $user->status = $status;
        if ($user->save()) {
            session()->flash('success', 'Status Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data Not Found');
            return redirect()->back();
        }
    }
    public function changeOrderstatus($id, $status)
    {

        $user = Order::find($id);
        $user->status = $status;
        if ($user->save()) {
            session()->flash('success', 'Status Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function orders()
    {
        $driver = Driver::get();
        $order = Order::with(['address', 'order_product', 'order_product.product', 'user'])->orderBy('id', 'DESC')->paginate(10);
        // echo "<pre>";
        // print_r($order[0]->order_product[0]->product->name);
        // echo "</pre>";
        // die;
        return view('admin.pages.order', ['order' => $order, 'driver' => $driver]);
    }

    public function s_order($id)
    {
        $order = Order::where('id', $id)->with(['address', 'order_product', 'order_product.product'])->first();
        return view('admin.pages.view_order', ['order' => $order]);
    }

    public function query()
    {
        $query = Query::paginate(10);
        return view('admin.pages.query', ['query' => $query]);
    }

    public function view_query($id)
    {
        $query = Query::find($id);
        return view('admin.popup.view_query', ['query' => $query]);
    }

    public function privacy()
    {
        $data = DB::table('pages')->first();

        return view('admin.pages.privacy', ['data' => $data]);
    }

    public function terms()
    {
        $data = DB::table('pages')->first();
        return view('admin.pages.terms-of-services', ['data' => $data]);
    }

    public function about()
    {
        $data = DB::table('pages')->first();
        return view('admin.pages.about-us', ['data' => $data]);
    }

    public function edit_pages(Request $request)
    {
        if ($request->about_us) {
            $x['about'] = strip_tags($request->about_us);
        } elseif ($request->privacy) {
            $x['privacy']  = strip_tags($request->privacy);
        } elseif ($request->term_condition) {
            $x['term_condition']  = strip_tags($request->term_condition);
        }
        $user = Page::where('id', '1')->update($x);
        if ($user) {
            session()->flash('success', 'Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Error Occured');
            return redirect()->back();
        }
    }

    public function view_payment()
    {
        $order = Payment::with(['orders', 'users', 'orders.order_product.product',])->orderBy('id', 'DESC')->first();
        return view('admin.popup.view-payment', ['order' => $order]);
    }
}
