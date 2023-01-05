<div class="row d-flex align-items-center">
    <label class="col-sm-2 col-form-label font-weight-bold">Value:</label>
    <div class="col-sm-4">
        <span>{{$data["currency_value"]}} {{$data["currency_code"]}}</span>
    </div>
</div>
<div class="row d-flex align-items-center">
    <label class="col-sm-2 col-form-label font-weight-bold">Surcharge {{$data["currency_surcharge_percentage"]}}%:</label>
    <div class="col-sm-4">
        <span>{{$data["currency_surcharge_value"]}} USD</span>
    </div>
</div>
@if($data["total_discount"] != 0)
<div class="row d-flex align-items-center">
    <label class="col-sm-2 col-form-label font-weight-bold">Discount {{$data["discount_percentage"]}}%:</label>
    <div class="col-sm-4">
        <span>{{$data["total_discount"]}} USD</span>
    </div>
</div>
@endif
<div class="row d-flex align-items-center">
    <label class="col-sm-2 col-form-label font-weight-bold">Total:</label>
    <div class="col-sm-4">
        <span>{{$data["total"]}} USD</span>
    </div>
</div>
<div class="form-group row d-flex align-items-center">
    <div class="col-sm-4 offset-sm-2">
        <button class="btn btn-primary" id="buy">Buy</button>
    </div>
</div>