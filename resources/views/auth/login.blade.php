


                <!-- <div class="card-header">{{ __('Login') }}</div> -->
                <link href="{{ asset('css/login.css') }}" rel="stylesheet"> 
                 
            <form class="formLogin" method="POST" action="{{ route('login_check') }}">
            @csrf
                <h3>bol.com koppeling</h3>
                <!-- Email -->
                <div>
                    <input type="text" id="userInput" name="userName" placeholder='Gebruikersnaam of email' required autocomplete="email" autofocus><br><br>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- Wachtwoord -->
                <div>
                    <input type="text" id="userInput" name="password" placeholder='Wachtwoord' required autocomplete="current-password"><br><br>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <!-- Login Button -->
                <button  id="buttonLogin" name="loginButton" type="submit" value="Inloggen">{{ __('Login') }}</button><br><br>
                <!-- links doorverwijzen 'wachtwoord vergeten' en 'registreren' nieuw gebruiker -->
                Wachtwoord vergeten ?<br>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Wachtword opnieuw instellen</a>
                    @endif<br>

                Nog niet geregistreerd?<br>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Maak een nieuw account aan</a>
                    @endif               
            </form>
      </div>


