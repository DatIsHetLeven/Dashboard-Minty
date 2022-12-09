<title>2FA</title>
<link href="{{ asset('css/logintest.css') }}" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=0.8">

<div class="formlogin">
    <form method="POST" action="{{ route('check2FAInput') }}">
        @csrf
        @if(\Session::has('error'))
            <p class="error">
                {{\Session::get('error')}}
            </p>
        @endif

        @if(\Session::has('succes'))
            <p class="succes">
                {{\Session::get('succes')}}
            </p>
        @endif
        <!-- E-mail invoeren -->

        <label>2FA code:</label>
        <p><input type="number" name="authCodeInput" class="form_login" required autocomplete="email">

    </form>

</div>





