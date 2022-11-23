<title>2FA</title>
<link href="{{ asset('css/logintest.css') }}" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=0.8">
<br><br></br></br>
{{--<h3><a href="{{ route('login') }}" span id="minty" > MINTY</span><span id="media"> MEDIA</span></a><h3>--}}
{{--<h5><span id="dashboard">DASHBOARD</span></h5>--}}

<h3><img width="243" height="26" src="https://mintymedia.nl/wp-content/uploads/2021/08/minty-logo-1.svg"></h3>

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
        <h3><img width="243" height="100" src="https://bol.mintyconnect.nl/images/logo_white.svg"></h3>
        <label>2FA code:</label>
        <p><input type="number" name="authCodeInput" class="form_login" required autocomplete="email">

    </form>

</div>





