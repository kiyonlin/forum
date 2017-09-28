@component('mail::message')
# One Last step

We Just need you to confirm your email address to prove that you're a human. You get it, right? Coo.

@component('mail::button', ['url' => url('#')])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
