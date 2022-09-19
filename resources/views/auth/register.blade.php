
<link href="{{ asset('css/login.css') }}" rel="stylesheet"> 
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> 

<div class="divRegister">
    <form method="POST" action="{{ route('create_user_check') }}" class="formRegister">
    
          <h3>bol.com koppeling</h3>
            <input type="email" id="userInput" name="email" placeholder='Email' required autocomplete="email"><br><br>
          
            <input type="text" id="userInput" name="userName" placeholder='Naam' required autocomplete="email"><br><br>
          
            <input type="tel" id="userInput" name="Telefoonnummer" placeholder='Telefoonnummer' required><br><br>
          
            <input type="text" id="userInput" name="Bedijfsnaam" placeholder='Bedijfsnaam' required><br><br>
          
            <input type="text" id="userInput" name="BTW-Nummer" placeholder='BTW-Nummer' required><br><br>
          
            <input type="text" id="userInput" name="Adres + Huisnummer" placeholder='Adres + Huisnummer' required><br><br>
          
            <input type="text" id="userInput" name="Postcode" placeholder='Postcode' required><br><br>
          
            <input type="text" id="userInput" name="Plaats" placeholder='Plaats' required><br><br>
          
            <button id="buttonLogin" type="submit"  name="buttonregister" value="Registreren">{{ __('Register') }}</button><br><br>              
    </form>
</div>




