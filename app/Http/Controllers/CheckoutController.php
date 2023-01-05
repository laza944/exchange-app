<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function show(Request $request) {
        if(!Session::has('cart')) {
            return redirect()->route('index');
        }

        $data = Session::get('cart');

        return view('checkout')->with(["data" => $data]);
    }

    public function store(Request $request) {
        if(!Session::has('order')) {
            return redirect()->route('index');
        }

        Session::forget('cart');

        $order = Order::where('id', Session::get('order'))->first();

        return view('confirmation')->with(["order" => $order]);
    }
}
