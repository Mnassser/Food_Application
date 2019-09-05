@component('mail::message')
# Introduction

Blood Bank Reset Password.

@component('mail::button', ['url' => 'http::/ipda3.com'])
Button Text
@endcomponent


	{{$code}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
