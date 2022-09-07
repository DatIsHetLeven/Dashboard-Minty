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

      <div class="divForm">
        <form class="formLogin" action="#">
          <h3>bol.com koppeling</h3>
          <input type="text" id="userInput" name="userName" placeholder='Gebruikersnaam of email'><br><br>
          <input type="text" id="userInput" name="password" placeholder='Wachtwoord'><br><br>
          <input  id="buttonLogin" type="submit" value="Inloggen"><br><br>

        Wachtwoord vergeten ?<br>
        <a href="">Wachtwoord opnieuw instellen</a><br><br>

        Nog niet geregistreerd?<br>
        <a href="{{url('register')}}">Maak een nieuw account aan</a>
        </form>
      </div>

    </body>
