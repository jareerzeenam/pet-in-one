@component('mail::message')


# Thak you for your message
<strong>Name</strong> : {{ $data['name'] }}
<br>
<strong>Email</strong> : {{ $data['email'] }}
<br>
<strong>Message</strong>

{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
