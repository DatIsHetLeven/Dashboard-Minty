
<link href="{{ asset('css/logintest.css') }}" rel="stylesheet"> 
<br><br></br></br>
<h3><span id="minty"> MINTY</span> MEDIA<h3>
<h5><span id="dashboard">DASHBOARD</span></h5>

<div class="formlogin">

  <form>
    <label>E-mail adres</label>
    <p><input type="text" name="username" class="form_login">

      

    <label>Wachtwoord </label> <a id="resetpass" class="link" href="{{ route('reset') }}">Wachtwoord vergeten?</a>

    <p><input type="password" name="password" class="form_login">

    <input type="submit" class="buttonlogin" value="Aanmelden">

    <br/>
    <br/>
    <center>
      <a class="link" href="#popup1">Account aanmaken</a>
    </center>
  </form>

</div>


<!-- Registreren popup box! -->
<div id="popup1" class="overlay">
	<div class="popup">
		<a class="close" href="#">&times;</a>
        <form method="POST" action="{{ route('create_user_check') }}" class="formRegister">
        @csrf
         <div class="userinput">
            <div class="links">
                <input type="text" id="userInput" name="email" placeholder='Email' required autocomplete="email"><br><br>
          
                <input type="text" id="userInput" name="userName" placeholder='Naam' required autocomplete="email"><br><br>
          
                <input type="tel" id="userInput" name="Telefoonnummer" placeholder='Telefoonnummer' required><br><br>
          
                <input type="text" id="userInput" name="Bedijfsnaam" placeholder='Bedijfsnaam' required><br><br>
            </div>
            <div class="rechts">
                <input type="text" id="userInput" name="BTW-Nummer" placeholder='BTW-Nummer' required><br><br>
          
                <input type="text" id="userInput" name="Adres + Huisnummer" placeholder='Adres + Huisnummer' required><br><br>
          
                <input type="text" id="userInput" name="Postcode" placeholder='Postcode' required><br><br>
          
                <input type="text" id="userInput" name="Plaats" placeholder='Plaats' required><br><br>
            </div>
         </div>   
         <button id="buttonLogin" name="buttonregister" type="submit"  value="Registreren">{{ __('Registreren') }}</button><br><br>           
        </form>

	</div>
</div>




      