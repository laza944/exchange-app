<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Mail\ConfirmationMail;
use Illuminate\Support\Facades\Mail;

class CurrencyController extends Controller {

    public function currencyConverter(Request $request) {

        //query validation
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',
            'to_currency' => 'required|string',
        ]);

        $data = $this->convertCurrencies($request);

        return view('parts.currency_result')->with(["data" => $data]);
    }

    public function checkoutCurrency(Request $request) {
        //query validation
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric',
            'to_currency' => 'required|string',
        ]);

        $data = $this->convertCurrencies($request);

        Session::put('cart', $data);

        return response()->json(['success'=>'Data is successfully added to the cart']);
    }

    public function confirmationCurrency(Request $request) {
        //query validation
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email'  => 'required|email'
        ]);

        $cart = Session::get('cart');

        $order = new Order();
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->currency_purchased_name = $cart["currency_name"];
        $order->currency_purchased_code = $cart["currency_code"];
        $order->currency_purchased_amount = $cart["currency_value"];
        $order->currency_purchased_rate = $cart["currency_rate"];
        $order->surcharge_percentage = $cart["currency_surcharge_percentage"];
        $order->surcharge_amount = $cart["currency_surcharge_value"];
        $order->paid_amount = $cart["total"];
        $order->discount_percentage = $cart["discount_percentage"];
        $order->discount_amount = $cart["total_discount"];
        $order->save();

        if($cart["send_email"] == 1) {
            $data = Order::where('id', $order->id)->first();
            Mail::to($request->email)->send(new ConfirmationMail($data));
        }

        Session::put('order', $order->id);

        return response()->json(['success'=>'Data is successfully purchased!']);
    }

    private function convertCurrencies($request) {
        $currency = Currency::where('currency_code', $request->to_currency)->orderBy('created_at', 'desc')->first();

        $currency_value = $request->value * $currency["rate"];
        $currency_surcharge_value = $request->value * $currency["surcharge_percentage"]/100;
        $sub_total = $request->value + $currency_surcharge_value;
        if($currency["discount_percentage"] != 0) {
            $total_discount = $sub_total * $currency["discount_percentage"]/100;
        }
        else {
            $total_discount = 0;
        }
        $total = $sub_total - $total_discount;

        $data = [
            "usd_value" => (float)$request->value,
            "currency_value" => $currency_value,
            "currency_code" => $request->to_currency,
            "currency_name" => $currency["name"],
            "currency_rate" => $currency["rate"],
            "currency_surcharge_percentage" => $currency["surcharge_percentage"],
            "currency_surcharge_value" => $currency_surcharge_value,
            "sub_total" => $sub_total,
            "discount_percentage" => $currency["discount_percentage"],
            "total_discount" => $total_discount,
            "total" => $total,
            "send_email" => $currency["send_email"],
        ];

        return $data;
    }
}