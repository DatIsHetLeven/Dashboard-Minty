
<link href="{{ asset('css/logintest.css') }}" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=0.8">
<br><br></br></br>
<h3><span id="minty"> MINTY</span> MEDIA<h3>
<h5><span id="dashboard">DASHBOARD</span></h5>

<div class="formlogin">

  <form method="POST" action="{{ route('login_check') }}">
  @csrf
    <!-- E-mail invoeren -->
    <label>E-mail adres</label>
    <p><input type="email" name="userName" class="form_login" required autocomplete="email">
    <!-- Wachtwoord invoeren -->
    <label>Wachtwoord </label> <a id="resetpass" class="link" href="{{ route('resetpassword') }}">Wachtwoord vergeten?</a>

    <p><input type="password" name="password" class="form_login" required autocomplete="password">
    <!-- Button aanmelden -->
    <input type="submit" name="loginButton" class="buttonlogin" value="Aanmelden">

    @if(\Session::has('error'))
      <p class="error">
        {{\Session::get('error')}}
      </p>
    @endif

    <br/>
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
                <input type="text" id="userInput" name="email" placeholder='Email' required autocomplete="email"><br><br>
          
                <input type="text" id="userInput" name="userName" placeholder='Naam' required autocomplete="email"><br><br>
          
                <input type="number" id="userInput" name="Telefoonnummer" placeholder='Telefoonnummer (alleen getallen)' required><br><br>
          
                <input type="text" id="userInput" name="Bedijfsnaam" placeholder='Bedijfsnaam' required><br><br>
            </div>
            <div class="rechts">
                <input type="text" id="userInput" name="BTW-Nummer" placeholder='BTW-Nummer' required><br><br>
          
                <input type="text" id="userInput" name="Adres" placeholder='Adres+Huisnummer' required><br><br>
          
                <input type="text" id="userInput" name="Postcode" placeholder='Postcode' required><br><br>
          
                <input type="text" id="userInput" name="Plaats" placeholder='Plaats' required><br><br>
            </div>
         </div>   
         <button id="buttonLogin" name="buttonregister" type="submit"  value="Registreren">{{ __('Registreren') }}</button><br><br>           
        </form>

	</div>
</div>




      