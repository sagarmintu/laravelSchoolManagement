@component('mail::message')
Hello {{$user->name}}

<p>We understand it happen.</p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent

<p>In case you have any issue recovering your password, Please feel free to contact us.</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent