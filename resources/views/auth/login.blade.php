<title>Minty Media</title>
<link href="{{ asset('css/logintest.css') }}" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=0.8">


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
      {{\Session::get('succes')}}\

  @endif
      @if(\Session::has('errorVoorwaarden'))
          <p class="error">
              {{\Session::get('errorVoorwaarden')}}
          </p>
      @endif
    <!-- E-mail invoeren -->
      <h3><img width="243" height="100" src="https://bol.mintyconnect.nl/images/logo_white.svg"></h3>
    <label><span class="label-span">E-mail</span>
    <input type="email" name="userName" class="form_login" required autocomplete="email"></label>
    <!-- Wachtwoord invoeren -->
    <label><span class="label-span">Wachtwoord</span>
    <input type="password" name="password" class="form_login" required autocomplete="password"></label>
    <!-- Button aanmelden -->
    <a id="resetpass" class="link" href="{{ route('resetpassword') }}">Wachtwoord vergeten?</a>
    <input type="submit" name="loginButton" class="buttonlogin" value="Aanmelden">

    <div class="account-aanmaken-link">
      <a class="link" href="#registreren1">Account aanmaken</a>
    </div>
  </form>

</div>

<img class="minty-logo" width="243" height="26" src="https://mintymedia.nl/wp-content/uploads/2021/08/minty-logo-1.svg">


<!-- Registreren popup box! -->
<div id="registreren1" class="overlay">
	<div class="registreren">
		<a class="close" href="#">&times;</a>
        <form method="POST" action="{{ route('create_user_check') }}" class="formRegister">
        @csrf
         <div class="userinput">
         <h1>Registreren</h1>
            <div class="links">
                <input type="email" id="userInput" name="email" placeholder='Email' required autocomplete="email"><br><br>

                <input type="text" id="userInput" name="userName" placeholder='Naam' required autocomplete="email"><br><br>

                <input type="tel" id="userInput" name="Telefoonnummer" placeholder='Telefoonnummer' required><br><br>

                <input type="text" id="userInput" name="Bedijfsnaam" placeholder='Bedijfsnaam' required><br><br>

            </div>
            <div class="rechts">
                <input type="text" id="userInput" name="BTW-Nummer" placeholder='BTW-Nummer' required><br><br>
                <input type="text" id="userInput" name="Adres" placeholder='Adres+Huisnummer' required><br><br>
                <input type="text" id="userInput" name="Postcode" placeholder='Postcode' required><br><br>
                <input type="text" id="userInput" name="Plaats" placeholder='Plaats' required><br><br>
            </div>



          <div class="last-fields">
             <label><input type="radio" name="land" checked <?php if (isset($land) && $land=="nl") echo "checked";?> value="nl">Nederland</label>
              <label><input type="radio" name="land" <?php if (isset($land) && $land=="be") echo "checked";?> value="be">Belgie</label>


              <div class="algemene-voorwaarden"><input type="checkbox" name="checkbox_algemenevoorwaarden" value="checkox_value">Ik heb de <a target="_blank" href="https://mintymedia.nl/algemene-voorwaarden/"> algemene voorwaarden </a> van de website gelezen en ga hiermee akkoord.</div>


            <div class="footer-buttons">
            <button  id="buttonLogin" name="buttonregister" type="submit"  value="Registreren">{{ __('Registreren') }}</button>
            </div>
         </div>
         </div>



        </form>

	</div>
</div>




