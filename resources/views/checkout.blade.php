@section('custom_css')
@endsection

<!DOCTYPE html>

<html>
@include('/include.header')
<body>
    @include('/include.navbar')

    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label font-weight-bold">First Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="first_name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Last Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="last_name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Email:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email" required>
                        </div>
                    </div>
                    <!-- Button for triggering the conversion -->
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4">
                            <button class="btn btn-primary" type="submit" id="buy">Buy</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <div class="row d-flex align-items-center">
                    <label class="col-sm-4 col-form-label font-weight-bold">Value:</label>
                    <div class="col-sm-8">
                        <span>{{$data["currency_value"]}} {{$data["currency_code"]}}</span>
                    </div>
                </div>
                <div class="row d-flex align-items-center">
                    <label class="col-sm-4 col-form-label font-weight-bold">Surcharge {{$data["currency_surcharge_percentage"]}}%:</label>
                    <div class="col-sm-8">
                        <span>{{$data["currency_surcharge_value"]}} USD</span>
                    </div>
                </div>
                @if($data["total_discount"] != 0)
                <div class="row d-flex align-items-center">
                    <label class="col-sm-4 col-form-label font-weight-bold">Discount {{$data["discount_percentage"]}}%:</label>
                    <div class="col-sm-8">
                        <span>{{$data["total_discount"]}} USD</span>
                    </div>
                </div>
                @endif
                <div class="row d-flex align-items-center">
                    <label class="col-sm-4 col-form-label font-weight-bold">Total:</label>
                    <div class="col-sm-8">
                        <span>{{$data["total"]}} USD</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('/include.footer')
</body>

</html>

<script>
    $(document).ready(function() {    
        $(document).on("click","#buy",function(event) {
            event.preventDefault();
            
            // var first_name = $('input[name="first_name"]').val();
            // var last_name = $('input[name="last_name"]').val();
            // var email = $('input[name="email"]').val();
            // var value = $('input[name="usd"]').val();
            // var currency = $('select[name="currency"]').val();

            var data = {};
            data._token = $('meta[name="csrf-token"]').attr('content');
            data.first_name = $('input[name="first_name"]').val();
            data.last_name = $('input[name="last_name"]').val();
            data.email = $('input[name="email"]').val();
            data.value = $('input[name="usd"]').val();
            data.currency = $('select[name="currency"]').val();
    
            $.post( "/confirmation_currency",  data , function(res) {
                window.location.href = "/confirmation";
            });
        });
    });
    </script>