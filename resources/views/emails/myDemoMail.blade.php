@component('mail::message')
# {{ $details['title'] }}

  
Your account has been successfully approved. Use the phone number {{ $details['phone'] }} and access code <b> {{ $details['access'] }}</b> to login to the TerraMoni Apps

Login to the Dashboard portal using your default password <b>123456</b>
   
@component('mail::button', ['url' => config('app.url')])
Access Portal
@endcomponent
   
Thanks,<br>
{{ config('app.name') }}
@endcomponent
