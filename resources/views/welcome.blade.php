<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
      <!-- Navigatie -->
        <div class="container">
          <div class="row">

              <ul class="nav justify-content-center">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/Accounts">Accounts</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/">Api</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/">Webshop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('login')}}">Uitloggen</a>
                </li>
              </ul>

            </div>
          </div>


          <!-- testing -->
          <div class="boxes">
            <div class="one box">
              <h1>Box 1</h1>
                <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
                <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
            </div> 
            <div class="two box">
              <h1>Box 2</h1>
              <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
              <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
            </div> 
            <div class="three box">
              <h1>Box 3</h1>
              <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
              <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
            </div>
            <div class="one box">
              <h1>Box 4</h1>
                <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
                <p>TestTEst Test TEST TestTEst Test TEST TestTEst Test TEST</p>
                <?php
                  try {
                    \DB::connection()->getPDO();
                    echo \DB::connection()->getDatabaseName();
                  } catch (\Exception $e) {
                    echo 'None';
                  }
                ?>
            </div>  
          </div>
          <strong>Database Connected: </strong>


            

          <!-- <div class="dashboard">
            <div class="box1">A</div>
            <div class="box2">rrrr</div>
            <div class="box3">Tessttt</div>
          </div> -->

    </body>
</html>
