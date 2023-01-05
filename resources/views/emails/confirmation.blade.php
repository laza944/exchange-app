@component('mail::message')
# Order confirmation

Dear {{$order->first_name}},<br>
Thank you for your recent purchase of {{$order->currency_purchased_amount}} {{$order->currency_purchased_code}} on our online exchange platform. <br>
Your transaction has been completed successfully, and the funds have been transferred to your account.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
