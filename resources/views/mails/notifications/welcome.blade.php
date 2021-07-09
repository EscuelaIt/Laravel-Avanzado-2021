@component('mail::message')
# Welcome, {{ $name }} to the application

Please visit us

@component('mail::button', ['url' => '/'])
Go to the website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
