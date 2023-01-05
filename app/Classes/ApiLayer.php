<?php

namespace App\Classes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;


class ApiLayer {

    public $headers;

    public function SetHeaders() {
        $this->headers = [
            'Content-Type'  => 'text/plain',
            'apikey'        => Config::get('services.apilayer.key'),
        ];
    }

    public function ListCurrenciesRates() {

        $this->SetHeaders();

        $allowed_currencies = config('api.api_layer_allowed_currencies');
        $currency_codes = implode(', ', $allowed_currencies);

        $response = Http::withHeaders($this->headers)->get('https://api.apilayer.com/currency_data/change', [
            'start_date'    => Carbon::parse('now')->format('Y-m-d'),
            'end_date'      => Carbon::parse('now')->format('Y-m-d'),
            'currencies'    => $currency_codes,
            'source'        => 'USD',
        ]);

        if($response->status() == 200) {
            return json_decode($response->body(), true);
        }
        else {
            return null;
        }
    }

}