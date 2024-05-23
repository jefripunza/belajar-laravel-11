@component('mail::message')
    # Activation Email

    Thank you for registering! Please click the button below to activate your account:

    @component('mail::button', ['url' => route('activation', ['code' => $user->activation_code])])
        Activate Account
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
