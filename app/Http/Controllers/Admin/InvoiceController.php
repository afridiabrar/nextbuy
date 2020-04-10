<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use PDF;


class InvoiceController extends Controller
{
    //

    public function admin_invoice($id)
    {
        $order = Order::where('id', $id)->with(['user', 'address', 'order_product', 'order_product.product'])->first();
        if ($order) {
            $pdf = PDF::loadView('email.admin_invoice', ['order' => $order]);
            $name = "Customer CopyInvoice" . $order->receipt_no;
            return $pdf->download('Admin_Invoice#' . $order->receipt_no . '.pdf');
            session()->flash('success', 'Customer Invoice Downloaded!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Not Generated');
            return redirect()->back();
        }
    }

    public function customerInvoice($id)
    {
        $order = Order::where('id', $id)->with(['user', 'address', 'order_product', 'order_product.product'])->first();
        if ($order) {
            $pdf = PDF::loadView('email.user_invoice', ['order' => $order]);
            $name = "Customer CopyInvoice" . $order->receipt_no;
            return $pdf->download('Customer_Invoice#' . $order->receipt_no . '.pdf');
            session()->flash('success', 'Customer Invoice Downloaded!');
            return redirect()->back();
        } else {
            session()->flash('error', 'Not Generated');
            return redirect()->back();
        }
    }
}
