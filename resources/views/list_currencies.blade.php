@section('custom_css')
@endsection

<!DOCTYPE html>

<html>
@include('/include.header')
<body>
    @include('/include.navbar')
    <div class="container mt-5">
        <form>
            <!-- Input field for the amount in USD -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label font-weight-bold">USD</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="usd" value="1">
                </div>
            </div>
            <!-- Dropdown menu for selecting the target currency -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label font-weight-bold">To</label>
                <div class="col-sm-4">
                    <select class="form-control" name="currency">
                        @foreach($currencies as $currency)
                            <option value="{{$currency->currency_code}}">{{$currency->currency_code}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Button for triggering the conversion -->
            <div class="form-group row">
                <div class="col-sm-4 offset-sm-2">
                    <button class="btn btn-primary" type="submit" id="convert">Convert</button>
                </div>
            </div>
        </form>
        <!-- Display the result of the conversion -->
        <div class="result font-weight-bold mt-5" id="result">
            
        </div>
    </div>

    @include('/include.footer')
</body>

</html>


<script>
$(document).ready(function() {

    function currencyConverter() {
        var value = $('input[name="usd"]').val();
        var currency = $('select[name="currency"]').val();
        $.get( '/currency_converter/?value=' + value + '&to_currency=' + currency , function( data ) {
            $("#result").html(data);
        });
    }

    $(document).on("click","#convert",function(event) {
        event.preventDefault();
        currencyConverter();
    });

    $(document).on("focusout",'input[name="usd"]',function(event) {
        event.preventDefault();
        currencyConverter();
    });

    $(document).on("change",'select[name="currency"]',function(event) {
        event.preventDefault();
        currencyConverter();
    });

    $(document).on("click","#buy",function(event) {
        event.preventDefault();
        
        var value = $('input[name="usd"]').val();
        var currency = $('select[name="currency"]').val();

        $.get( '/checkout_currency/?value=' + value + '&to_currency=' + currency , function( data ) {
            window.location.href = "/checkout";
        });
    });
});
</script>