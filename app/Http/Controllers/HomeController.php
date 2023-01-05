<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class HomeController extends Controller {

    public function index(Request $request) {

        $currency_codes = config('api.api_layer_allowed_currencies');

        $currencies = [];
        foreach($currency_codes as $currency_code) {
            $currency = Currency::where('currency_code', $currency_code)->orderBy('created_at', 'desc')->first();
            $currencies[] = $currency;
        }

        return view('list_currencies')->with(["currencies" => $currencies]);
    }
}