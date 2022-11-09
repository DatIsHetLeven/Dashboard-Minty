
<link href="{{ asset('css/logintest.css') }}" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=0.8">
<br><br></br></br>
<h3><a href="{{ route('login') }}" span id="minty" > MINTY</span><span id="media"> MEDIA</span></a><h3>
<h5><span id="dashboard">DASHBOARD</span></h5>

<div class="formlogin">

  <form method="POST" action="{{ route('reset_password') }}">
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

    <label>E-mail adres</label>
    <p><input type="email" name="username" class="form_login" required autocomplete="email">

    <br><br><br>

    <input type="submit" class="buttonlogin" name="resetpassword" value="Stuur nieuw wachtwoord">

  </form>

</div>





