<title>Minty Media</title>
<link href="{{ asset('css/logintest.css') }}" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=0.8">
<br><br></br></br>
{{--<h3><a href="{{ route('login') }}" span id="minty" > MINTY</span><span id="media"> MEDIA</span></a><h3>--}}
{{--<h5><span id="dashboard">DASHBOARD</span></h5>--}}

<h3><img width="243" height="26" src="https://mintymedia.nl/wp-content/uploads/2021/08/minty-logo-1.svg"></h3>


<div class="formlogin">

  <form method="POST" action="{{ route('login_check') }}">
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
    <label>E-mail</label>
    <p><input type="email" name="userName" class="form_login" required autocomplete="email">
    <!-- Wachtwoord invoeren -->
    <label>Wachtwoord </label> <a id="resetpass" class="link" href="{{ route('resetpassword') }}">Wachtwoord vergeten?</a>

    <p><input type="password" name="password" class="form_login" required autocomplete="password">
    <!-- Button aanmelden -->
    <input type="submit" name="loginButton" class="buttonlogin" value="Aanmelden">



    <br/>
    <center>
      <a class="link" href="#registreren1">Account aanmaken</a>
    </center>
  </form>

</div>


<!-- Registreren popup box! -->
<div id="registreren1" class="overlay">
	<div class="registreren">
		<a class="close" href="#">&times;</a>
        <form method="POST" action="{{ route('create_user_check') }}" class="formRegister">
        @csrf
         <div class="userinput">
            <div class="links">
                <input type="email" id="userInput" name="email" placeholder='Email' required autocomplete="email"><br><br>

                <input type="text" id="userInput" name="userName" placeholder='Naam' required autocomplete="email"><br><br>

                <input type="number" id="userInput" name="Telefoonnummer" placeholder='Telefoonnummer' required><br><br>

                <input type="text" id="userInput" name="Bedijfsnaam" placeholder='Bedijfsnaam' required><br><br>

            </div>
            <div class="rechts">
                <input type="text" id="userInput" name="BTW-Nummer" placeholder='BTW-Nummer' required><br><br>

                <input type="text" id="userInput" name="Adres" placeholder='Adres+Huisnummer' required><br><br>

                <input type="text" id="userInput" name="Postcode" placeholder='Postcode' required><br><br>

                <input type="text" id="userInput" name="Plaats" placeholder='Plaats' required><br><br>



                <input type="radio" name="land" checked
                       <?php if (isset($land) && $land=="nl") echo "checked";?>
                       value="nl">Nederland
                <input type="radio" name="land"
                       <?php if (isset($land) && $land=="be") echo "checked";?>
                       value="be">Belgie


            </div>
         </div>
         <button id="buttonLogin" name="buttonregister" type="submit"  value="Registreren">{{ __('Registreren') }}</button><br><br>
        </form>

	</div>
</div>




