@section('custom_css')
@endsection

<!DOCTYPE html>

<html>
@include('/include.header')
<body>
    @include('/include.navbar')
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                Dear valued customer,<br>
                Thank you for your recent purchase of {{$order["currency_purchased_amount"]}} {{$order["currency_purchased_code"]}} on our online exchange platform. <br>
                Your transaction has been completed successfully, and the funds have been transferred to your account.
            </div>
        </div>

        <div class="row">
            <div class="col-2">First name:</div>
            <div class="col-4">{{$order->first_name}}</div>
        </div>
        <div class="row">
            <div class="col-2">Last name:</div>
            <div class="col-4">{{$order->last_name}}</div>
        </div>
        <div class="row">
            <div class="col-2">Email:</div>
            <div class="col-4">{{$order->email}}</div>
        </div>
        <div class="row">
            <div class="col-2">Currency name:</div>
            <div class="col-4">{{$order->currency_purchased_name}}</div>
        </div>
        <div class="row">
            <div class="col-2">Currency code:</div>
            <div class="col-4">{{$order->currency_purchased_code}}</div>
        </div>
        <div class="row">
            <div class="col-2">Currency amount:</div>
            <div class="col-4">{{$order->currency_purchased_amount}} {{$order->currency_purchased_code}}</div>
        </div>
        <div class="row">
            <div class="col-2">Currency rate:</div>
            <div class="col-4">{{$order->currency_purchased_rate}}</div>
        </div>
        <div class="row">
            <div class="col-2">Surcharge percentage:</div>
            <div class="col-4">{{$order->surcharge_percentage}}%</div>
        </div>
        <div class="row">
            <div class="col-2">Surcharge amount:</div>
            <div class="col-4">{{$order->surcharge_amount}} USD</div>
        </div>
        <div class="row">
            <div class="col-2">Paid amount:</div>
            <div class="col-4">{{$order->paid_amount}} USD</div>
        </div>
        <div class="row">
            <div class="col-2">Discount percentage:</div>
            <div class="col-4">{{$order->discount_percentage}}%</div>
        </div>
        <div class="row">
            <div class="col-2">Discount amount:</div>
            <div class="col-4">{{$order->discount_amount}} USD</div>
        </div>
    </div>
    @include('/include.footer')
</body>

</html>