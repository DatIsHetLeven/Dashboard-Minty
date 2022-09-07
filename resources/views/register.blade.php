<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>

      <div class="divRegister">
        <form class="formRegister" action="#">
          <h3>bol.com koppeling</h3>
          <input type="text" id="userInput" name="email" placeholder='Email'><br><br>
          <input type="text" id="userInput" name="userName" placeholder='Naam'><br><br>
          <input type="text" id="userInput" name="Telefoonnummer" placeholder='Telefoonnummer'><br><br>
          <input type="text" id="userInput" name="Bedijfsnaam" placeholder='Bedijfsnaam'><br><br>
          <input type="text" id="userInput" name="BTW-Nummer" placeholder='BTW-Nummer'><br><br>
          <input type="text" id="userInput" name="Adres + Huisnummer" placeholder='Adres + Huisnummer'><br><br>
          <input type="text" id="userInput" name="Postcode" placeholder='Postcode'><br><br>
          <input type="text" id="userInput" name="Plaats" placeholder='Plaats'><br><br>

          <input type="button" id="buttonLogin" type="submit" onclick="location.href='{{url('home')}}'" value="Registreren"><br><br>

          Heb je al een account?<br>
          <a href="{{url('login')}}">Inloggen</a><br><br>
        </form>
      </div>



    </body>
