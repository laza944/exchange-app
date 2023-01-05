<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\ApiLayer;
use App\Models\Currency;

class ListCurrenciesRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list:currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List currencies rates from third-party api apilayer and store in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api_layer = new ApiLayer();

        $currencies = $api_layer->ListCurrenciesRates();

        foreach($currencies["quotes"] as $key => $quote)  {

            if(substr($key, 0, strlen('USD')) === 'USD') {
                $currency_code = substr($key, strlen('USD'));
            }
            else {
                $currency_code = $key;
            }

            if($currency_code == 'EUR') {
                $name = 'Euro';
                $surcharge_percentage = 5;
                $discount_percentage = 2;
                $send_email = 0;
            }
            elseif($currency_code == 'GBP') {
                $name = 'British pound sterling';
                $surcharge_percentage = 5;
                $discount_percentage = 0;
                $send_email = 1;
            }
            elseif($currency_code == 'JPY') {
                $name = 'Japanese yen';
                $surcharge_percentage = 7.5;
                $discount_percentage = 0;
                $send_email = 0;
            }
            else {
                $name = 'Undefined';
                $surcharge_percentage = null;
                $discount_percentage = null;
                $send_email = 0;
            }

            $currency = new Currency();
            $currency->name = $name;
            $currency->currency_code = $currency_code;
            $currency->date = $currencies["start_date"];
            $currency->rate = $quote["start_rate"];
            $currency->surcharge_percentage = $surcharge_percentage;
            $currency->discount_percentage = $discount_percentage;
            $currency->send_email = $send_email;
            $currency->save();

        }
    }
}
